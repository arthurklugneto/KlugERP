<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EstoqueService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class EstoqueController extends Controller
{

    protected $estoqueService;

	public function __construct(EstoqueService $estoqueService)
	{
        $this->middleware('auth');
        $this->estoqueService = $estoqueService;
	}
	
    public function index()
    {
    	$registros = $this->estoqueService->getAll();
    	$produtos = $this->estoqueService->getProdutos();
    	
    	return View::make('estoque.index')
    	->with('estoque', $registros)
    	->with('produtos', $produtos);
    }

    public function create()
    {
    	$registros = $this->estoqueService->getAll();
    	$produtos = $this->estoqueService->getProdutos();
    	 
    	return View::make('estoque.create')
    	->with('estoque', $registros)
    	->with('produtos', $produtos);
    }

    public function store(Request $request)
    {
    	
    	$registros = $this->estoqueService->getAll();
    	$produtos = $this->estoqueService->getProdutos();
    	
    	if(empty(Input::get('quantidade')))
    	{
    		Session::flash('messageErro', 'Quantidade é necessária para movimentar o estoque.');
    		return View::make('estoque.index')
    		->with('estoque', $registros)
    		->with('produtos', $produtos);    		
    	}
    	else
    	{
    		$this->estoqueService->save(Input::all());
    		
    		Session::flash('message', 'Estoque Movimentado com sucesso.');
    		return Redirect::to('estoque');
    	}
    	
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
    
}
