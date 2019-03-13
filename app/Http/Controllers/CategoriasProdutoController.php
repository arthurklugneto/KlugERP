<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoriasService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CategoriasProdutoController extends Controller
{

    protected $categoriasService;
    
	public function __construct(CategoriasService $categoriasService)
	{
        $this->middleware('auth');
        $this->categoriasService = $categoriasService;
	}
	
	public function index()
	{
		$categorias = $this->categoriasService->getAll();
		
		return View::make('categoriasProduto.index')
		->with('categoriasProdutos', $categorias);
	}
	
	public function create()
	{
		return View::make('categoriasProduto.create');
	}
	
	public function store()
	{
		$rules = array(
				'nome'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('categoriasProduto/create')
			->withErrors($validator);
		} else {
		
			$this->categoriasService->save(Input::all());
		
			Session::flash('message', 'Categoria adicionada com sucesso!');
			return Redirect::to('categoriasProduto');
		}
	}
	
	public function show($id)
	{
		$categoria = $this->categoriasService->findById($id);
		
		return View::make('categoriasProduto.show')
		->with('categoria', $categoria);
	}
	
	public function edit($id)
	{
		$categoria = $this->categoriasService->findById($id);
		
		return View::make('categoriasProduto.edit')
		->with('categoria', $categoria);
	}
	
	public function update($id)
	{
		$rules = array(
				'nome'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('categoriasProduto/' . $id . '/edit')
			->withErrors($validator);
		} else {
			
			$this->categoriasService->update(Input::all(),$id);
			
			Session::flash('message', 'Categoria atualizada com sucesso!');
			return Redirect::to('categoriasProduto');
			
		}
	}
	
	public function destroy($id)
	{
		$this->categoriasService->remove($id);
		
		Session::flash('message', 'Categoria apagada com sucesso!');
		return Redirect::to('categoriasProduto');
	}
	
}
