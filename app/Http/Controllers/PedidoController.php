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
        $registros = $this->pedidoService->getAll();
		return View::make('pedido.index')
		->with('pedidos', $registros);
    }

    public function create()
    {
        $clientes = $this->pedidoService->getClientes();
		$produtos = $this->pedidoService->getProdutos();
		
		return View::make('pedido.create')
		->with('clientes', $clientes)
		->with('produtos', $produtos);
    }

    public function store(Request $request)
    {
        $rules = array(
            'dataVenda'  => 'required',
            'cliente_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('pedido/create')
			->withErrors($validator);
		} else {
            $id = $this->pedidoService->save(Input::all());
		    return Redirect::to('pedido/'.$id.'/edit');
        }

    }

    public function edit($id)
    {
        $produtos = $this->pedidoService->getProdutos();
		$pedido = $this->pedidoService->findById($id);
		$pedidoProdutos = $this->pedidoService->getPedidoProdutos($id);
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
		->with('pedidoProdutos', $pedidoProdutos);
    }

    public function destroy($id)
    {
        $this->pedidoService->remove($id);		
	
		Session::flash('message', 'Pedido apagado com sucesso!');
		return Redirect::to('pedido');
    }

    public function finalizarPedido($id)
	{
        $pedido = $this->pedidoService->finalizarPedido($id);
        $registros = $this->pedidoService->getAll();
        
		return View::make('pedido.index')
		->with('pedidos', $registros);		
	}

    public function addItem($id)
	{
        $this->pedidoService->addItem(Input::all(),$id);
		
		$produtos = $this->pedidoService->getProdutos();
        $pedidoProdutos = $this->pedidoService->getPedidoProdutos($id);
        $pedido = $this->pedidoService->findById($id);
        $produtoPedido = $this->pedidoService->getProduto(Input::get('produtos'));
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
		->with('pedidoProdutos', $pedidoProdutos)
		->with('produtoAtual', $produtoPedido);		
	}

	public function removeItem($id)
	{
        $produtos = $this->pedidoService->getProdutos();
        $pedido = $this->pedidoService->findByPedidoProdutoId($id);

        $this->pedidoService->removeItem($id);
				        
		$pedidoProdutos = $this->pedidoService->getPedidoProdutos($pedido->id);		
		
		return View::make('pedido.edit')
		->with('produtos', $produtos)
		->with('pedido', $pedido)
        ->with('pedidoProdutos', $pedidoProdutos);
	}

    public function venderPedido($id)
    {
        $idVenda = $this->pedidoService->venderPedido($id);
		
		return Redirect::to('venda/'.$idVenda.'/edit');
    }

}
