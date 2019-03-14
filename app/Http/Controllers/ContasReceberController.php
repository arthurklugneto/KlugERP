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
    	$id = $this->contaReceberService->store(Input::all());
    	return Redirect::to('contasReceber/'.$id.'/edit');
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
        $this->contaReceberService->addRecebimento(Input::all(),$id);
        $conta = $this->contaReceberService->findById($id);
    	
    	$pagamentos = $this->contaReceberService->getContaRecebimentos($id);
    	$formasPagamento = $this->contaReceberService->getFormasPagamento();
    	
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('recebimentos', $pagamentos);
    }
    
}
