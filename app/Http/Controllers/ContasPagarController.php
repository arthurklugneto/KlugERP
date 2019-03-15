<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContaPagarService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ContasPagarController extends Controller
{

    protected $contaPagarService;

	public function __construct(ContaPagarService $contaPagarService)
	{
        $this->middleware('auth');
        $this->contaPagarService = $contaPagarService;
	}
	
    public function index()
    {
    	$registros = $this->contaPagarService->getAll();
    	return View::make('contasPagar.index')
    	->with('contasPagar', $registros);
    }

    public function create()
    {
    	$fornecedores = $this->contaPagarService->getFornecedores();
    	$planoContas = $this->contaPagarService->getPlanoContas();
    	$formaPagamento = $this->contaPagarService->getFormasPagamento();
    	 
    	return View::make('contasPagar.create')
    	->with('fornecedores', $fornecedores)
    	->with('planoContas', $planoContas)
    	->with('formaPagamento', $formaPagamento);
    }

    public function store(Request $request)
    {
        $rules = array(
            'dataEmissao'  => 'required',
            'dataVencimento' => 'required',
            'fornecedor_id' => 'required',
            'valorOriginal' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('contasPagar/create')
			->withErrors($validator);
		} else {
            if( Input::get('valorOriginal') != 0 )
            {
                $id = $this->contaPagarService->save(Input::all());
                return Redirect::to('contasPagar/'.$id.'/edit');
            }else{
                return Redirect::to('contasPagar/create');
            }         
        }	

    }

    public function edit($id)
    {
    	$contaPagar = $this->contaPagarService->findById($id);
    	$contaPagarPagamentos = $this->contaPagarService->getContaPagamentos($id);
    	$formasPagamento = $this->contaPagarService->getFormasPagamento();
    	return View::make('contasPagar.edit')
    	->with('contaPagar', $contaPagar)
    	->with('pagamentos', $contaPagarPagamentos)
    	->with('formasPagamento', $formasPagamento);    	 
    }

    public function destroy($id)
    {
    	$this->contaPagarService->remove($id);
    	Session::flash('message', 'Conta a pagar apagada com sucesso!');
    	return Redirect::to('contasPagar');
    }
    
    public function addPagamento($id)
    {
        if( !empty(Input::get('valorPagamento')) && Input::get('valorPagamento') != 0 )
        {
            $this->contaPagarService->addPagamento(Input::all(),$id); 
        }
    	 
    	$pagamentos = $this->contaPagarService->getContaPagamentos($id);
        $formasPagamento = $this->contaPagarService->getFormasPagamento();
        $conta = $this->contaPagarService->findById($id);
    	 
    	return View::make('contasPagar.edit')
    	->with('contaPagar', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('pagamentos', $pagamentos);
    }

    public function removePagamento($id)
    {
        $idConta = $this->contaPagarService->removePagamento($id);
        $pagamentos = $this->contaPagarService->getContaPagamentos($idConta);
        $formasPagamento = $this->contaPagarService->getFormasPagamento();
        $conta = $this->contaPagarService->findById($idConta);
    	 
    	return View::make('contasPagar.edit')
    	->with('contaPagar', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('pagamentos', $pagamentos);
    }
    
}
