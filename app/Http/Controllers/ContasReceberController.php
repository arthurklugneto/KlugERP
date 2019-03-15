<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContaReceberService;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ContasReceberController extends Controller
{
    
    protected $contaReceberService;

	public function __construct(ContaReceberService $contaReceberService)
	{
        $this->middleware('auth');
        $this->contaReceberService = $contaReceberService;
	}
	
    public function index()
    {
    	$registros = $this->contaReceberService->getAll();
    	return View::make('contasReceber.index')
    	->with('contasReceber', $registros);
    }

    public function create()
    {
    	$clientes = $this->contaReceberService->getClientes();
    	$planoContas = $this->contaReceberService->getPlanoContas();
    	$formaPagamento = $this->contaReceberService->getFormasPagamento(); 
    	
    	return View::make('contasReceber.create')
    	->with('clientes', $clientes)
    	->with('planoContas', $planoContas)
    	->with('formaPagamento', $formaPagamento);
    }

    public function store(Request $request)
    {
        $rules = array(
            'dataEmissao'  => 'required',
            'dataVencimento' => 'required',
            'cliente_id' => 'required',
            'valorOriginal' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('contasReceber/create')
			->withErrors($validator);
		} else {
            if( Input::get('valorOriginal') != 0 )
            {
                $id = $this->contaReceberService->store(Input::all());
    	        return Redirect::to('contasReceber/'.$id.'/edit'); 
            }else{
                return Redirect::to('contasReceber/create');
            }         
        }	      	
    }

    public function edit($id)
    {
    	$contaReceber = $this->contaReceberService->findById($id);
    	$contaReceberRecebimentos = $this->contaReceberService->getContaRecebimentos($id);
    	$formasPagamento = $this->contaReceberService->getFormasPagamento();
    	
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $contaReceber)
    	->with('recebimentos', $contaReceberRecebimentos)
    	->with('formasPagamento', $formasPagamento);    	
    }

    public function destroy($id)
    {
    	$this->contaReceberService->remove($id);
    	
    	Session::flash('message', 'Conta a receber apagada com sucesso!');
    	return Redirect::to('contasReceber');
    }

    public function addRecebimento($id)
    {
        if( !empty(Input::get('valorPagamento')) && Input::get('valorPagamento') != 0 )
        {
            $this->contaReceberService->addRecebimento(Input::all(),$id);
        }

        $conta = $this->contaReceberService->findById($id);
    	
    	$pagamentos = $this->contaReceberService->getContaRecebimentos($id);
    	$formasPagamento = $this->contaReceberService->getFormasPagamento();
    	
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('recebimentos', $pagamentos);
    }

    public function removeRecebimento($id)
    {
        $idConta =  $this->contaReceberService->removeRecebimento($id);
        $conta = $this->contaReceberService->findById($idConta);    	
    	$pagamentos = $this->contaReceberService->getContaRecebimentos($idConta);
    	$formasPagamento = $this->contaReceberService->getFormasPagamento();
    	
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('recebimentos', $pagamentos);
    }
    
}
