<?php

namespace App\Services;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use App\Cliente;
use App\Saida;
use App\SaidaProduto;
use Carbon\Carbon;

class PedidoService{

    public function getAll(){
        return Pedido::all();
    }

    public function findById($id){
        return Pedido::find($id);
    }

    public function findByPedidoProdutoId($id){
        $registro = PedidoProduto::find($id);
        return Pedido::find($registro->pedido_id);
    }

    public function getPedidoProdutos($id){
        return PedidoProduto::all()->where('pedido_id', $id);
    }

    public function save($inputs){
        $registro = new Pedido;
		$registro->cliente_id = $inputs['cliente_id'];
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

    public function remove($id){

		$pedidosProdutos = PedidoProduto::all()->where('pedido_id', $id);
		foreach ($pedidosProdutos as $key => $value)
		{
			$value->delete();
		}
		
		$registro = Pedido::find($id);
        $registro->delete();
        
    }

    public function finalizarPedido($id){
        $pedido = Pedido::find($id);
        $pedido->situacao = 2;
        $pedido->save();
    }

    public function venderPedido($id){
        $pedido = Pedido::find($id);
        $pedidoProdutos = PedidoProduto::all()->where('pedido_id', $id);

        $registro = new Saida;
		$registro->cliente_id = $pedido->cliente_id;
		$registro->valor = 0;
		$registro->valorRecebido = 0;
		$registro->observacoes = $pedido->observacoes;
		$registro->dataVenda = Carbon::now();
		$registro->save();

        foreach ($pedidoProdutos as $key => $value)
		{

            $produtoVenda = Produto::find($value->produto_id);

            $registroProduto = new SaidaProduto;
            $registroProduto->saida_id = $registro->id;
            $registroProduto->valor = $produtoVenda->precoVenda;
            $registroProduto->quantidade = $value->quantidade;
            $registroProduto->produto_id = $produtoVenda->id;
            $registroProduto->save();            
            
		}

        $pedido->situacao = 3;
        $pedido->save();
        return $registro->id;
    }

    public function addItem($inputs,$id){
        $quantidade = $inputs['quantidade'];
		$produto = $inputs['produtos'];
		
		$produtoPedido = Produto::find($produto);
		
		if( empty($quantidade) )
		{
			$quantidade = 1;
		}
		
		$pedido = Pedido::find($id);
				
		$registro = new PedidoProduto;
		$registro->pedido_id = $pedido->id;
		$registro->quantidade = $quantidade;
		$registro->produto_id = $produto;
		$registro->save();
    }

    public function removeItem($id){
        $registro = PedidoProduto::find($id);
		$registro->delete();
    }

    public function getProduto($id){
        return Produto::find($id);
    }

    public function getClientes(){
        return Cliente::orderBy('nome')->pluck('nome','id');
    }

    public function getProdutos(){
        return Produto::orderBy('nome')->get()->pluck('nome','id');
    }

}