<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClienteService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    
    protected $clienteService;

	public function __construct(ClienteService $clienteService)
	{
        $this->middleware('auth');
        $this->clienteService = $clienteService;
	}
	
	public function index()
	{
		$registros = $this->clienteService->getAll();
	
		return View::make('cliente.index')
		->with('clientes', $registros);
	}
	
	public function create()
	{
		return View::make('cliente.create');
	}
	
	public function store()
	{
	
		$rules = array(
				'nome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('cliente/create')
			->withErrors($validator);
		} else {
	
			$this->clienteService->save(Input::all());
	
			Session::flash('message', 'Cliente adicionado com sucesso!');
			return Redirect::to('cliente');
		}
	}
	
	public function show($id)
	{
		$registro = $this->clienteService->findById($id);
	
		return View::make('cliente.show')
		->with('cliente', $registro);
	}
	
	public function edit($id)
	{
		$registro = $this->clienteService->findById($id);
	
		return View::make('cliente.edit')
		->with('cliente', $registro);
	}
	
	public function update($id)
	{
		$rules = array(
				'nome' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('cliente/create')
			->withErrors($validator);
		} else {
		
			$this->clienteService->update(Input::all(),$id);
		
			Session::flash('message', 'Cliente alterado com sucesso!');
			return Redirect::to('cliente');
		}
	}
	
	public function destroy($id)
	{
		$this->clienteService->remove($id);
	
		Session::flash('message', 'Cliente apagado com sucesso!');
		return Redirect::to('cliente');
	}
	
}
