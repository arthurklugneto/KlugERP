<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PedidoService;
use Carbon\Carbon;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\PedidoProduto;
use App\Saida;
use App\SaidaProduto;

class PedidoController extends Controller
{

    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
	{
        $this->middleware('auth');
        $this->pedidoService = $pedidoService;
	}

    public function index()
    {
        $registros = Pedido::all();
		return View::make('pedido.index')
		->with('pedidos', $registros);
    }

    public function create()
    {
        $clientes = Cliente::pluck('nome','id');
		$produtos = Produto::all();
		
		return View::make('pedido.create')
		->with('clientes', $clientes)
		->with('produtos', $produtos);
    }

    public function store(Request $request)
    {
        $registro = new Pedido;
		$registro->cliente_id = Input::get('cliente_id');
		$registro->observacoes = Input::get('observacoes');
		
		if( empty(Input::get('dataVenda')) )
		{
			$registro->dataVenda = null;
		}
		else
		{
			$registro->dataVenda = Input::get('dataVenda');
		}
		
		$registro->save();

		$id = $registro->id;
		
		return Redirect::to('pedido/'.$id.'/edit');
    }

    public function edit($id)
    {
        $produtos = Produto::pluck('nome','id');
		$pedido = Pedido::find($id);
		$pedidoProdutos = PedidoProduto::all()->where('pedido_id', $id);
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
		->with('pedidoProdutos', $pedidoProdutos);
    }

    public function destroy($id)
    {
        
		$pedidosProdutos = PedidoProduto::all()->where('pedido_id', $id);
		foreach ($pedidosProdutos as $key => $value)
		{
			$value->delete();
		}
		
		$registro = Pedido::find($id);
		$registro->delete();
	
		Session::flash('message', 'Pedido apagado com sucesso!');
		return Redirect::to('pedido');
    }

    public function finalizarPedido($id)
	{
		
        $pedido = Pedido::find($id);
        $pedido->situacao = 2;
        $pedido->save();

		$registros = Pedido::all();
		return View::make('pedido.index')
		->with('pedidos', $registros);		
	}

    public function addItem($id)
	{
		
		$quantidade = Input::get('quantidade');
		$produto = Input::get('produtos');
		
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
		
		$produtos = Produto::pluck('nome','id');
		$pedidoProdutos = PedidoProduto::all()->where('pedido_id', $id);
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
		->with('pedidoProdutos', $pedidoProdutos)
		->with('produtoAtual', $produtoPedido);
		
	}

	public function removeItem($id)
	{
		$registro = PedidoProduto::find($id);
		$registro->delete();
		
		$produtos = Produto::pluck('nome','id');
		$pedidoProdutos = PedidoProduto::all()->where('pedido_id', $registro->pedido_id);
		$pedido = Pedido::find($registro->pedido_id);
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
		->with('pedidoProdutos', $pedidoProdutos);
	}

    public function venderPedido($id)
    {
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

		$id = $registro->id;
        $pedido->situacao = 3;
        $pedido->save();
		
		return Redirect::to('venda/'.$id.'/edit');
    }

}
