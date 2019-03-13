<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FornecedorService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class FornecedorController extends Controller
{
    protected $fornecedorService;

	public function __construct(FornecedorService $fornecedorService)
	{
        $this->middleware('auth');
        $this->fornecedorService = $fornecedorService;
	}
	
	public function index()
	{
		$registros = $this->fornecedorService->getAll();
	
		return View::make('fornecedor.index')
		->with('fornecedor', $registros);
	}
	
	public function create()
	{
		return View::make('fornecedor.create');
	}
	
	public function store()
	{
	
		$rules = array(
				'nome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('fornecedor/create')
			->withErrors($validator);
		} else {
	
			$this->fornecedorService->save(Input::all());
	
			Session::flash('message', 'Fornecedor adicionado com sucesso!');
			return Redirect::to('fornecedor');
		}
	}
	
	public function show($id)
	{
		$registro = $this->fornecedorService->findById($id);
	
		return View::make('fornecedor.show')
		->with('fornecedor', $registro);
	}
	
	public function edit($id)
	{
		$registro = $this->fornecedorService->findById($id);
	
		return View::make('fornecedor.edit')
		->with('fornecedor', $registro);
	}
	
	public function update($id)
	{
		$rules = array(
				'nome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('fornecedor/create')
			->withErrors($validator);
		} else {
	
			$this->fornecedorService->update(Input::all(),$id);
	
			Session::flash('message', 'Fornecedor alterado com sucesso!');
			return Redirect::to('fornecedor');
		}
	}
	
	public function destroy($id)
	{
		$this->fornecedorService->remove($id);
	
		Session::flash('message', 'Fornecedor apagado com sucesso!');
		return Redirect::to('fornecedor');
	}
	
}
