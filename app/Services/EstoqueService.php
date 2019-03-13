<?php

namespace App\Services;

use App\Estoque;
use App\Produto;

class EstoqueService{

    public function getAll(){
        return Estoque::all();
    }

    public function save($inputs){
        $quantidade = $inputs['quantidade'];
        $produto = $inputs['produtos'];
        $tipo = $inputs['tipo'];
        
        if($tipo == 'entrada')
        {
            $estoque = Estoque::all()->where('produto_id',$produto)->first();
            $estoqueAtual = $estoque->quantidade;
            $estoque->quantidade = $estoqueAtual + $quantidade;
            $estoque->save();
        }
        else
        {
            $estoque = Estoque::all()->where('produto_id',$produto)->first();
            $estoqueAtual = $estoque->quantidade;
            $estoque->quantidade = $estoqueAtual - $quantidade;
            $estoque->save();
        }
    }

    public function getProdutos(){
        return Produto::orderBy('nome')->get()->pluck('nome','id');
    }

}