<?php

namespace App\Services;

use App\Produto;
use App\Estoque;
use App\CategoriasProduto;
use App\SaidaProduto;
use App\EntradaProduto;
use DB;

class ProdutoService{

    public function getAll(){
        return Produto::all();
    }

    public function getAllByEstoque(){
        return Estoque::all();
    }

    public function findById($id){
        return Produto::find($id);
    }

    public function remove($id){
        $estoque = Estoque::all()->where('produto_id',$id)->first();
        $estoque->delete();
            
        $registro = Produto::find($id);
        $registro->delete();
    }

    public function save($inputs){
        $custo = str_replace(",", ".", $inputs['precoCusto']);
		$venda = str_replace(",", ".", $inputs['precoVenda']);
		$margem = str_replace(",", ".", $inputs['margem']);
			
		$registro = new Produto;
		$registro->codigo = $inputs['codigo'];
		$registro->codigoEan = $inputs['codigoEan'];
		$registro->nome = $inputs['nome'];
		$registro->precoCusto = $custo;
		$registro->precoVenda = $venda;
		$registro->margem = 0;
		if(!empty($inputs['margem']) ) $registro->margem = $margem;
		$registro->categoria_id = $inputs['categoria_id'];
		$registro->save();
			
		$estoque = new Estoque;
		$estoque->produto_id = $registro->id;
		$estoque->quantidade = 0;
		$estoque->save();
    }

    public function update($inputs,$id){
        $custo = str_replace(",", ".", $inputs['precoCusto']);
        $venda = str_replace(",", ".", $inputs['precoVenda']);
        $margem = str_replace(",", ".", $inputs['margem']);
        
        $registro = Produto::find($id);
        $registro->codigo = $inputs['codigo'];
        $registro->codigoEan = $inputs['codigoEan'];
        $registro->nome = $inputs['nome'];
        $registro->precoCusto = $custo;
        $registro->precoVenda = $venda;
        $registro->margem = 0;
        if(!empty($inputs['margem']) ) $registro->margem = $margem;
        $registro->categoria_id = $inputs['categoria_id'];
        $registro->save();
    }

    public function getCategorias(){
        return CategoriasProduto::pluck('nome','id');
    }

    public function getProximoCodigo(){
        return DB::table('produtos')->max('codigo') + 1;
    }

    public function produtoTemMovimento($id){
        $qtdSaidas = SaidaProduto::all()->where('produto_id', $id)->count();
        $qtdEntradas = EntradaProduto::all()->where('produto_id', $id)->count();
        
        return $qtdSaidas != 0 || $qtdEntradas != 0;
    }

}
