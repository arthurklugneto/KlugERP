<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContaPagar;
use App\ContaPagarFormaPagamento;
use App\Fornecedor;
use App\FormaPagamento;
use App\PlanoConta;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class ContasPagarController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function index()
    {
    	$registros = ContaPagar::all();
    	return View::make('contasPagar.index')
    	->with('contasPagar', $registros);
    }

    public function create()
    {
    	$fornecedores = Fornecedor::pluck('nome','id');
    	//$planoContas = PlanoConta::pluck('nome','id');
    	$planoContas = DB::table('plano_contas')->where('tipo', 'despesa')->pluck('nome','id');
    	$formaPagamento = FormaPagamento::pluck('nome','id');
    	 
    	return View::make('contasPagar.create')
    	->with('fornecedores', $fornecedores)
    	->with('planoContas', $planoContas)
    	->with('formaPagamento', $formaPagamento);
    }

    public function store(Request $request)
    {
    	$registro = new ContaPagar;
    	 
    	$registro->fornecedor_id = Input::get('fornecedor_id');
    	$registro->plano_contas_id = Input::get('planoContas');
    	$registro->valorOriginal = Input::get('valorOriginal');
    	 
    	if(!empty(Input::get('valorLiquido'))) $registro->valorLiquido = Input::get('valorLiquido');
    	if(!empty(Input::get('valorRecebido'))) $registro->valorRecebido = Input::get('valorRecebido');
    	
    	if( empty(Input::get('dataEmissao')) )
    	{
    		$registro->dataEmissao = null;
    	}
    	else
    	{
    		$registro->dataEmissao = Input::get('dataEmissao');
    	}
    	 
    	if( empty(Input::get('dataVencimento')) )
    	{
    		$registro->dataVencimento = null;
    	}
    	else
    	{
    		$registro->dataVencimento = Input::get('dataVencimento');
    	}
    	 
    	if( empty(Input::get('dataPagamento')) )
    	{
    		$registro->dataPagamento = null;
    	}
    	else
    	{
    		$registro->dataPagamento = Input::get('dataPagamento');
    	}
    	 
    	//calcula valor liquido
    	if( empty(Input::get('valorLiquido') ))
    	{
    		if( $registro->planoConta->margem != 0 )
    		{
    			$margem = $registro->planoConta->margem;
    			$registro->valorLiquido = $registro->valorOriginal - ( $registro->valorOriginal * ($margem/100) );
    		}
    		else
    		{
    			$registro->valorLiquido = $registro->valorOriginal;
    		}
    	}
    	else
    	{
    		$registro->valorLiquido = Input::get('valorLiquido');
    	}
    	 
    	$registro->descricao = Input::get('descricao');
    	 
    	$registro->save();
    	 
    	$id = $registro->id;
    	 
    	return Redirect::to('contasPagar/'.$id.'/edit');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$contaPagar = ContaPagar::find($id);
    	$contaPagarPagamentos = ContaPagarFormaPagamento::all()->where('conta_pagar_id', $id);
    	$formasPagamento = FormaPagamento::pluck('nome','id');
    	return View::make('contasPagar.edit')
    	->with('contaPagar', $contaPagar)
    	->with('pagamentos', $contaPagarPagamentos)
    	->with('formasPagamento', $formasPagamento);
    	 
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    	$pagamentos = ContaPagarFormaPagamento::all()->where('conta_pagar_id', $id);
    	foreach ($pagamentos as $key => $value)
    	{
    		$value->delete();
    	}
    	 
    	$registro = ContaPagar::find($id);
    	$registro->delete();
    	
    	Session::flash('message', 'Conta a pagar apagada com sucesso!');
    	return Redirect::to('contasPagar');
    }
    
    public function addPagamento($id)
    {
    	$pagamento = new ContaPagarFormaPagamento;
    	$pagamento->valor = Input::get('valorPagamento');
    	$pagamento->forma_pagamentos_id = Input::get('formasPagamento');
    	$pagamento->conta_pagar_id = $id;
    	 
    	$pagamento->save();
    	 
    	$conta = ContaPagar::find($id);
    	 
    	$valorPago = $conta->valorPago;
    	$valorPago += Input::get('valorPagamento');
    	 
    	$conta->valorPago = $valorPago;
    	$conta->dataPagamento = Carbon::now();
    	 
    	if( $conta->valorPago >= $conta->valorLiquido )
    	{
    		$conta->situacao = 2;
    	}
    	elseif( $conta->valorPago > 0 && $conta->valorPago != 0 )
    	{
    		$conta->situacao = 3;
    	}
    	else
    	{
    		$conta->situacao = 1;
    	}
    	 
    	$conta->save();
    	 
    	$pagamentos = ContaPagarFormaPagamento::all()->where('conta_pagar_id', $id);
    	$formasPagamento = FormaPagamento::pluck('nome','id');
    	 
    	return View::make('contasPagar.edit')
    	->with('contaPagar', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('pagamentos', $pagamentos);
    }
    
}
