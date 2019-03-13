<?php

namespace App\Services;

use App\Entrada;
use App\EntradaProduto;
use App\Produto;
use App\FormaPagamento;
use App\EntradaFormaPagamento;
use App\Fornecedor;
use App\Estoque;

class CompraService{

    public function getAll(){
        return Entrada::all();
    }

    public function findById($id){
        return Entrada::find($id);
    }

    public function findByEntradaProdutoId($id){
        $registro = EntradaProduto::find($id);
        return Entrada::find($registro->entrada_id);
    }

    public function remove($id){
        $pagamentosProdutos = EntradaFormaPagamento::all()->where('entrada_id', $id);
		foreach ($pagamentosProdutos as $key => $value)
		{
			$value->delete();
		}
		
		$compraProdutos = EntradaProduto::all()->where('entrada_id', $id);
		
		foreach ($compraProdutos as $key => $value)
		{
			
			$estoque = Estoque::all()->where('produto_id',$value->produto_id)->first();
			$estoqueAtual = $estoque->quantidade;
			$estoque->quantidade = $estoqueAtual - $value->quantidade;
			$estoque->save();
						
			$value->delete();
		}
		
		$registro = Entrada::find($id);
		$registro->delete();
    }

    public function save($inputs){
        $registro = new Entrada;
		$registro->fornecedor_id = $inputs['fornecedor_id'];
		$registro->valor = 0;
		$registro->valorPago = 0;
		$registro->observacoes = $inputs['observacoes'];

		if( empty($inputs['dataCompra']) )
		{
			$registro->dataCompra = null;
		}
		else
		{
			$registro->dataCompra = $inputs['dataCompra'];
		}
		
		$registro->save();
		return $registro->id;
    }

    public function update($inputs,$id){
        $entry = $this->findById($id);
		$entry->nome = $inputs['nome'];
        $entry->save();
    }

    public function getFornecedores(){
        return Fornecedor::orderBy('nome')->pluck('nome','id');
    }

    public function getProdutos(){
        return Produto::orderBy('nome')->get()->pluck('nome','id');
    }

    public function getProduto($id){
        return Produto::find($id);
    }

    public function getFormaPagamentos(){
        return FormaPagamento::pluck('nome','id');
    }

    public function getEntradaProdutos($id){
        return EntradaProduto::all()->where('entrada_id', $id);
    }

    public function getEntradaPagamentos($id){
        return EntradaFormaPagamento::all()->where('entrada_id', $id);;
    }

    public function addItem($inputs,$id){
        $quantidade = $inputs['quantidade'];
		$valor = $inputs['valor'];
		$produto = $inputs['produtos'];
		
		$produtoCompra = Produto::find($produto);
		
		if( empty($quantidade) )
		{
			$quantidade = 1;
		}
		
		if( empty($valor) )
		{
			$valor = $produtoCompra->precoCusto;
		}
		
		$compra = Entrada::find($id);
		
		$registro = new EntradaProduto;
		$registro->entrada_id = $compra->id;
		$registro->valor = $valor;
		$registro->quantidade = $quantidade;
		$registro->produto_id = $produto;
		$registro->save();
		
		$estoque = Estoque::all()->where('produto_id',$produto)->first();
		
		$estoqueAtual = $estoque->quantidade;
		
		$estoque->quantidade = $estoqueAtual + $quantidade;
		$estoque->save();
    }

    public function removeItem($id){
        
        $registro = EntradaProduto::find($id);
		
		$estoque = Estoque::all()->where('produto_id',$registro->produto_id)->first();
		$estoqueAtual = $estoque->quantidade;
		$estoque->quantidade = $estoqueAtual - $registro->quantidade;
		$estoque->save();
		
		$registro->delete();
    }

    public function adicionarPagamento($inputs,$id){
        $pagamento = new EntradaFormaPagamento;
		$pagamento->valor = $inputs['valorPagamento'];
		$pagamento->forma_pagamentos_id = $inputs['formasPagamento'];
		$pagamento->entrada_id = $id;
		
        $pagamento->save();
        
        $compra = Entrada::find($id);
		$valorPago = $compra->valorPago;
		$valorPago += $inputs['valorPagamento'];
		
		$compra->valorPago = $valorPago;
		
		if( $compra->valorPago >= $compra->valor ){
			$compra->situacao = 2;
		}elseif( $compra->valorPago > 0 && $compra->valorPago != 0 ){
			$compra->situacao = 3;
		}else{
			$compra->situacao = 1;
		}
				
		$compra->save();
    }

}