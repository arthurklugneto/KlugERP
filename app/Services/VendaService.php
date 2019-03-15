<?php

namespace App\Services;

use App\Saida;
use App\SaidaProduto;
use App\Produto;
use App\FormaPagamento;
use App\SaidaFormaPagamento;
use App\Cliente;
use App\Estoque;

class VendaService{

    public function getAll(){
        return Saida::all();
    }

    public function findById($id){
        return Saida::find($id);
    }

    public function findBySaidaProdutoId($id){
        $registro = SaidaProduto::find($id);
        return Saida::find($registro->saida_id);
    }

    public function remove($id){

		$recebimentosProdutos = SaidaFormaPagamento::all()->where('saida_id', $id);
		foreach ($recebimentosProdutos as $key => $value)
		{
			$value->delete();
		}
		
		$vendasProdutos = SaidaProduto::all()->where('saida_id', $id);
		foreach ($vendasProdutos as $key => $value)
		{
			
			$estoque = Estoque::all()->where('produto_id',$value->produto_id)->first();
			$estoqueAtual = $estoque->quantidade;
			$estoque->quantidade = $estoqueAtual + $value->quantidade;
			$estoque->save();
			
			$value->delete();
		}
		
		$registro = Saida::find($id);
        $registro->delete();
    }

    public function save($inputs){
        $registro = new Saida;
		$registro->cliente_id = $inputs['cliente_id'];
		$registro->valor = 0;
		$registro->valorRecebido = 0;
		$registro->observacoes = $inputs['observacoes'];
		
		if( empty($inputs['dataVenda']) )
		{
			$registro->dataVenda = null;
		}
		else
		{
			$registro->dataVenda = $inputs['dataVenda'];
		}
		
        $registro->save();
        return $registro->id;
    }

    public function update($inputs,$id){
        $entry = $this->findById($id);
		$entry->nome = $inputs['nome'];
        $entry->save();
    }

    public function getClientes(){
        return Cliente::orderBy('nome')->pluck('nome','id');
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

    public function getSaidaProdutos($id){
        return SaidaProduto::all()->where('saida_id', $id);
    }

    public function getSaidaPagamentos($id){
        return SaidaFormaPagamento::all()->where('saida_id', $id);;
    }

    public function addItem($inputs,$id){
        $quantidade = $inputs['quantidade'];
		$valor = $inputs['valor'];
		$produto = $inputs['produtos'];
		
		$produtoVenda = Produto::find($produto);
		
		if( empty($quantidade) )
		{
			$quantidade = 1;
		}
		
		if( empty($valor) )
		{
			$valor = $produtoVenda->precoVenda;
		}
		
		$venda = Saida::find($id);
				
		$registro = new SaidaProduto;
		$registro->saida_id = $venda->id;
		$registro->valor = $valor;
		$registro->quantidade = $quantidade;
		$registro->produto_id = $produto;
		$registro->save();
		
		$estoque = Estoque::all()->where('produto_id',$produto)->first();
		
		$estoqueAtual = $estoque->quantidade;
		
		$estoque->quantidade = $estoqueAtual - $quantidade;
        $estoque->save();
    }

    public function removeItem($id){
        $registro = SaidaProduto::find($id);
				
		$estoque = Estoque::all()->where('produto_id',$registro->produto_id)->first();
		$estoqueAtual = $estoque->quantidade;
		$estoque->quantidade = $estoqueAtual + $registro->quantidade;
		$estoque->save();
		
        $registro->delete();
    }

    public function adicionarPagamento($inputs,$id){
        $pagamento = new SaidaFormaPagamento;
		$pagamento->valor = $inputs['valorPagamento'];
		$pagamento->forma_pagamentos_id = $inputs['formasPagamento']; 
		$pagamento->saida_id = $id;
		
		$pagamento->save();
		
		$venda = Saida::find($id);
		
		$valorPago = $venda->valorRecebido;
		$valorPago += $inputs['valorPagamento'];
		
		$venda->valorRecebido = $valorPago;
		
		$venda->situacao = $this->adjustSitucao($venda->valor,$venda->valorRecebido);
		
        $venda->save();
    }

    public function removePagamento($id){
        $idRetornar = $this->findContaIdByPagamentoId($id);

        $pagamento = SaidaFormaPagamento::find($id);
        $venda = Saida::find($idRetornar);
        $venda->valorRecebido -= $pagamento->valor;
        $venda->situacao = $this->adjustSitucao($venda->valor,$venda->valorRecebido);
        $venda->save();
        $pagamento->delete();

        return $idRetornar;
    }

    private function findContaIdByPagamentoId($id){
        return SaidaFormaPagamento::find($id)->saida_id;
    }

    private function adjustSitucao($valor,$valorPago){
        $situacao = 1;
        if( $valorPago >= $valor ){
			$situacao = 2;
		}elseif( $valorPago > 0 && $valorPago != 0 ){
			$situacao = 3;
		}else{
			$situacao = 1;
        }
        return $situacao;
    }

}