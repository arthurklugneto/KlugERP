<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompraService;
use Validator;
use View;
use Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\EntradaProduto;

class CompraController extends Controller
{

    protected $compraService;
    
	public function __construct(CompraService $compraService)
	{
        $this->middleware('auth');        
        $this->compraService = $compraService;
	}
	
	public function index()
	{
		$registros = $this->compraService->getAll();
		return View::make('compra.index')
		->with('compras', $registros);
	}
	
	public function create()
	{
		$fornecedores = $this->compraService->getFornecedores();
		$produtos = $this->compraService->getProdutos();
		
		return View::make('compra.create')
		->with('fornecedores', $fornecedores)
		->with('produtos', $produtos);
	}
	
	public function store()
	{
        $rules = array(
            'dataCompra'       => 'required',
            'fornecedor_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('compra/create')
			->withErrors($validator);
		} else {
            $id = $this->compraService->save(Input::all());
            return Redirect::to('compra/'.$id.'/edit');
        }
        
	}
	
	public function edit($id)
	{
		$produtos = $this->compraService->getProdutos();
		$compra = $this->compraService->findById($id);
		$comprasProdutos = $this->compraService->getEntradaProdutos($id);
		
		return View::make('compra.edit')
		->with('produtos', $produtos)
		->with('compra', $compra)
		->with('comprasProdutos', $comprasProdutos);
	}
	
	public function addItem($id)
	{
        $rules = array(
            'produtos'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()){
            $this->compraService->addItem(Input::all(),$id);

            $produtos = $this->compraService->getProdutos();
            $comprasProdutos = $this->compraService->getEntradaProdutos($id);
            $compra = $this->compraService->findById($id);
            $produtoCompra = $this->compraService->getProduto(Input::get('produtos'));
            
            return View::make('compra.edit')
            ->with('produtos', $produtos)
            ->with('compra', $compra)
            ->with('comprasProdutos', $comprasProdutos)
            ->with('produtoAtual', $produtoCompra);
        }else{
            return Redirect::to('compra/'.$id.'/edit'); 
        }
	}
	
	public function removeItem($id)
	{
        $compra = $this->compraService->findByEntradaProdutoId($id);
        $produtos = $this->compraService->getProdutos();
		
        $this->compraService->removeItem($id);		
        $comprasProdutos = $this->compraService->getEntradaProdutos($compra->id);
            
		return View::make('compra.edit')
		->with('produtos', $produtos)
		->with('compra', $compra)
		->with('comprasProdutos', $comprasProdutos);
	}
	
	public function finalizarCompra($id)
	{
		$compra = $this->compraService->findById($id);
		$comprasProdutos = $this->compraService->getEntradaProdutos($id);
		
		$pagamentos = $this->compraService->getEntradaPagamentos($id);
		$formasPagamento = $this->compraService->getFormaPagamentos();
		$valorTotal = 0;
		
		foreach ($comprasProdutos as $key => $value)
		{
			$valorTotal += $value->quantidade * $value->valor;
		}
		
		$compra->valor = $valorTotal;
		$compra->save();
		
		$dadosArray = array(
				'total' => $valorTotal
		);
		
		return View::make('compra.finalizar')
		->with('compra', $compra)
		->with('produtos', $comprasProdutos)
		->with('dados', $dadosArray)
		->with('formasPagamento', $formasPagamento)
		->with('pagamentos', $pagamentos);
	}
	
	public function addPagamento($id)
	{
        if(!empty(Input::get('valorPagamento')))
        {
            $this->compraService->adicionarPagamento(Input::all(),$id);            
        }

        $compra = $this->compraService->findById($id);
                    
        $pagamentos = $this->compraService->getEntradaPagamentos($id);
        $formasPagamento = $this->compraService->getFormaPagamentos();
        
        return View::make('compra.finalizar')
        ->with('compra', $compra)
        ->with('formasPagamento', $formasPagamento)
        ->with('pagamentos', $pagamentos);
    }
    
    public function removePagamento($id)
    {
        $idCompra = $this->compraService->removePagamento($id);
        $compra = $this->compraService->findById($idCompra);                    
        $pagamentos = $this->compraService->getEntradaPagamentos($idCompra);
        $formasPagamento = $this->compraService->getFormaPagamentos();
        
        return View::make('compra.finalizar')
        ->with('compra', $compra)
        ->with('formasPagamento', $formasPagamento)
        ->with('pagamentos', $pagamentos);
    }
	
	public function destroy($id)
	{
		$this->compraService->remove($id);

		Session::flash('message', 'Compra apagada com sucesso!');
		return Redirect::to('compra');		
	}
	
}