<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VendaService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class VendaController extends Controller
{
    
    protected $vendaService;

	public function __construct(VendaService $vendaService)
	{
        $this->middleware('auth');
        $this->vendaService = $vendaService;
	}
	
	public function index()
	{
		$registros = $this->vendaService->getAll();
		return View::make('venda.index')
		->with('vendas', $registros);
	}
	
	public function create()
	{
		$clientes = $this->vendaService->getClientes();
		$produtos = $this->vendaService->getProdutos();
		
		return View::make('venda.create')
		->with('clientes', $clientes)
		->with('produtos', $produtos);
	}
	
	public function store()
	{
        $rules = array(
            'dataVenda'       => 'required',
            'cliente_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('venda/create')
			->withErrors($validator);
		} else {
            $id = $this->vendaService->save(Input::all());
		return Redirect::to('venda/'.$id.'/edit');
        }		
	}
	
	public function edit($id)
	{
		$produtos = $this->vendaService->getProdutos();
		$venda = $this->vendaService->findById($id);
		$vendasProdutos = $this->vendaService->getSaidaProdutos($id);
		
		return View::make('venda.edit')
		->with('produtos', $produtos)
		->with('venda', $venda)
		->with('vendasProdutos', $vendasProdutos);
		
	}
	
	public function addItem($id)
	{
		$rules = array(
            'produtos'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()){
            $this->vendaService->addItem(Input::all(),$id);
        }
		
		$produtos = $this->vendaService->getProdutos();
        $vendasProdutos = $this->vendaService->getSaidaProdutos($id);
        $venda = $this->vendaService->findById($id);
        $produtoVenda = $this->vendaService->getProduto(Input::get('produtos'));
				
		return View::make('venda.edit')
		->with('produtos', $produtos)
		->with('venda', $venda)
		->with('vendasProdutos', $vendasProdutos)
		->with('produtoAtual', $produtoVenda);		
	}

	public function removeItem($id)
	{
        $venda = $this->vendaService->findBySaidaProdutoId($id);
        $produtos = $this->vendaService->getProdutos();
        $this->vendaService->removeItem($id);
		
		$vendasProdutos = $this->vendaService->getSaidaProdutos($id);		
		
		return View::make('venda.edit')
		->with('produtos', $produtos)
		->with('venda', $venda)
		->with('vendasProdutos', $vendasProdutos);
	}
	
	public function finalizarVenda($id)
	{
		
		$venda = $this->vendaService->findById($id);
		$vendasProdutos = $this->vendaService->getSaidaProdutos($id);
		
		$pagamentos = $this->vendaService->getSaidaPagamentos($id);
		$formasPagamento = $this->vendaService->getFormaPagamentos();
		$valorTotal = 0;
		
		foreach ($vendasProdutos as $key => $value)
		{
			$valorTotal += $value->quantidade * $value->valor;
		}
		
		$venda->valor = $valorTotal;
		$venda->save();
		
		$dadosArray = array(
				'total' => $valorTotal
		);
		
		return View::make('venda.finalizar')
		->with('venda', $venda)
		->with('produtos', $vendasProdutos)
		->with('dados', $dadosArray)
		->with('formasPagamento', $formasPagamento)
		->with('pagamentos', $pagamentos);
		
	}
	
	public function addPagamento($id)
	{
		if(!empty(Input::get('valorPagamento')))
        {
            $this->vendaService->adicionarPagamento(Input::all(),$id);            
        }
        
		$pagamentos = $this->vendaService->getSaidaPagamentos($id);
        $formasPagamento = $this->vendaService->getFormaPagamentos();
        $venda = $this->vendaService->findById($id);
		
		return View::make('venda.finalizar')
		->with('venda', $venda)
		->with('formasPagamento', $formasPagamento)
		->with('pagamentos', $pagamentos);
    }
    
    public function removePagamento($id)
    {
        $idConta = $this->vendaService->removePagamento($id);
        $pagamentos = $this->vendaService->getSaidaPagamentos($idConta);
        $formasPagamento = $this->vendaService->getFormaPagamentos();
        $venda = $this->vendaService->findById($idConta);
		
		return View::make('venda.finalizar')
		->with('venda', $venda)
		->with('formasPagamento', $formasPagamento)
		->with('pagamentos', $pagamentos);
    }
	
	public function destroy($id)
	{
		$this->vendaService->remove($id);
	
		Session::flash('message', 'Venda apagada com sucesso!');
		return Redirect::to('venda');
	}
	
}
