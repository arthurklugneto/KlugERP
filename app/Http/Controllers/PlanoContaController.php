<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanoContaService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PlanoContaController extends Controller
{
 
    protected $planoContaService;
    
	public function __construct(PlanoContaService $planoContaService)
	{
        $this->middleware('auth');
        $this->planoContaService = $planoContaService;
	}
	
	public function index()
	{
		$planos = $this->planoContaService->getAll();
	
		return View::make('planoContas.index')
		->with('planos', $planos);
	}
	
	public function create()
	{
		return View::make('planoContas.create');
	}
	
	public function store()
	{
		$rules = array(
				'nome'  => 'required',
				'tipo'  => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('planoContas/create')
			->withErrors($validator);
		} else {
	
			$this->planoContaService->save(Input::all());
	
			Session::flash('message', 'Plano de Contas adicionada com sucesso!');
			return Redirect::to('planoContas');
		}
	}
	
	public function show($id)
	{
		$plano = $this->planoContaService->findById($id);
	
		return View::make('planoContas.show')
		->with('plano', $plano);
	}
	
	public function edit($id)
	{
		$plano = $this->planoContaService->findById($id);
	
		return View::make('planoContas.edit')
		->with('plano', $plano);
	}
	
	public function update($id)
	{
		$rules = array(
				'nome'  => 'required',
				'tipo'  => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('planoContas/create')
			->withErrors($validator);
		} else {
	
			$this->planoContaService->update(Input::all(),$id);
	
			Session::flash('message', 'Plano de Contas alterado com sucesso!');
			return Redirect::to('planoContas');
		}
	}
	
	public function destroy($id)
	{
		$this->planoContaService->remove($id);
	
		Session::flash('message', 'Plano de Contas apagada com sucesso!');
		return Redirect::to('planoContas');
	}	
	
}
