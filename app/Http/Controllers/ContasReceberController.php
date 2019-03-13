<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContaReceber;
use App\ContaReceberFormaPagamento;
use App\Cliente;
use App\FormaPagamento;
use App\PlanoConta;
use Validator;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class ContasReceberController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function index()
    {
    	$registros = ContaReceber::all();
    	return View::make('contasReceber.index')
    	->with('contasReceber', $registros);
    }

    public function create()
    {
    	$clientes = Cliente::pluck('nome','id');
    	//$planoContas = PlanoConta::pluck('nome','id');    	
    	$planoContas = DB::table('plano_contas')->where('tipo', 'receita')->pluck('nome','id');
    	
    	$formaPagamento = FormaPagamento::pluck('nome','id'); 
    	
    	return View::make('contasReceber.create')
    	->with('clientes', $clientes)
    	->with('planoContas', $planoContas)
    	->with('formaPagamento', $formaPagamento);
    }

    public function store(Request $request)
    {
    	    	
    	$registro = new ContaReceber;
    	
    	$registro->cliente_id = Input::get('cliente_id');
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
    	
    	if( empty(Input::get('dataRecebimento')) )
    	{
    		$registro->dataRecebimento = null;
    	}
    	else
    	{
    		$registro->dataRecebimento = Input::get('dataRecebimento');
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
    	
    	return Redirect::to('contasReceber/'.$id.'/edit');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$contaReceber = ContaReceber::find($id);
    	$contaReceberRecebimentos = ContaReceberFormaPagamento::all()->where('conta_receber_id', $id);
    	$formasPagamento = FormaPagamento::pluck('nome','id');
    	/*
    	
    	$saidasProdutos = SaidaProduto::all()->where('saida_id', $id);
    	$valorTotal = 0;
    	
    	foreach ($saidasProdutos as $key => $value)
    	{
    		$valorTotal += $value->quantidade * $value->valor;
    	}
    	
    	$venda->valor = $valorTotal;
    	$venda->save();
    	
    	$dadosArray = array(
    			'total' => $valorTotal
    	);
    	*/
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $contaReceber)
    	->with('recebimentos', $contaReceberRecebimentos)
    	->with('formasPagamento', $formasPagamento);
    	
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    	$recebimentos = ContaReceberFormaPagamento::all()->where('conta_receber_id', $id);
    	foreach ($recebimentos as $key => $value)
    	{
    		$value->delete();
    	}
    	
    	$registro = ContaReceber::find($id);
    	$registro->delete();
    	
    	Session::flash('message', 'Conta a receber apagada com sucesso!');
    	return Redirect::to('contasReceber');
    }

    public function addRecebimento($id)
    {
    	$pagamento = new ContaReceberFormaPagamento;
    	$pagamento->valor = Input::get('valorPagamento');
    	$pagamento->forma_pagamentos_id = Input::get('formasPagamento');
    	$pagamento->conta_receber_id = $id;
    	
    	$pagamento->save();
    	
    	$conta = ContaReceber::find($id);
    	
    	$valorRecebido = $conta->valorRecebido;
    	$valorRecebido += Input::get('valorPagamento');
    	
    	$conta->valorRecebido = $valorRecebido;
    	$conta->dataRecebimento = Carbon::now();
    	
    	if( $conta->valorRecebido >= $conta->valorLiquido )
    	{
    		$conta->situacao = 2;
    	}
    	elseif( $conta->valorRecebido > 0 && $conta->valorRecebido != 0 )
    	{
    		$conta->situacao = 3;
    	}
    	else
    	{
    		$conta->situacao = 1;
    	}
    	
    	$conta->save();
    	
    	$pagamentos = ContaReceberFormaPagamento::all()->where('conta_receber_id', $id);
    	$formasPagamento = FormaPagamento::pluck('nome','id');
    	
    	return View::make('contasReceber.edit')
    	->with('contaReceber', $conta)
    	->with('formasPagamento', $formasPagamento)
    	->with('recebimentos', $pagamentos);
    }
    
}
