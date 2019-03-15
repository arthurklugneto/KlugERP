<?php

namespace App\Services;

use App\ContaReceber;
use App\ContaReceberFormaPagamento;
use App\Cliente;
use App\FormaPagamento;
use App\PlanoConta;
use Carbon\Carbon;
use DB;

class ContaReceberService{

    public function __construct(){}

    public function getAll(){
        return ContaReceber::all();
    }

    public function findById($id){
        return ContaReceber::find($id);
    }

    public function store($inputs){
        $registro = new ContaReceber;
    	
    	$registro->cliente_id = $inputs['cliente_id'];
    	$registro->plano_contas_id = $inputs['planoContas'];
    	$registro->valorOriginal = $inputs['valorOriginal'];
    	
    	if(!empty($inputs['valorLiquido'])) $registro->valorLiquido = $inputs['valorLiquido'];
    	if(!empty($inputs['valorRecebido'])) $registro->valorRecebido = $inputs['valorRecebido'];
    
    	if( empty($inputs['dataEmissao']) )
    	{
    		$registro->dataEmissao = null;
    	}
    	else
    	{
    		$registro->dataEmissao = $inputs['dataEmissao'];
    	}
    	
    	if( empty($inputs['dataVencimento']) )
    	{
    		$registro->dataVencimento = null;
    	}
    	else
    	{
    		$registro->dataVencimento = $inputs['dataVencimento'];
    	}
    	
    	if( empty($inputs['dataRecebimento']) )
    	{
    		$registro->dataRecebimento = null;
    	}
    	else
    	{
    		$registro->dataRecebimento = $inputs['dataRecebimento'];
    	}
    	
    	//calcula valor liquido
    	if( empty($inputs['valorLiquido'] ))
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
    		$registro->valorLiquido = $inputs['valorLiquido'];
    	}
   	    	
    	$registro->descricao = $inputs['descricao'];
        $registro->save();
        return $registro->id;
    }

    public function remove($id){
        $recebimentos = ContaReceberFormaPagamento::all()->where('conta_receber_id', $id);
    	foreach ($recebimentos as $key => $value)
    	{
    		$value->delete();
    	}
    	
    	$registro = ContaReceber::find($id);
    	$registro->delete();
    }

    public function getContaRecebimentos($id){
        return ContaReceberFormaPagamento::all()->where('conta_receber_id', $id);
    }

    public function getClientes(){
        return Cliente::pluck('nome','id');
    }

    public function getPlanoContas(){
        return DB::table('plano_contas')->where('tipo', 'receita')->pluck('nome','id');
    }

    public function getFormasPagamento(){
        return FormaPagamento::pluck('nome','id');
    }

    public function addRecebimento($inputs,$id){
        $pagamento = new ContaReceberFormaPagamento;
    	$pagamento->valor = $inputs['valorPagamento'];
    	$pagamento->forma_pagamentos_id = $inputs['formasPagamento'];
    	$pagamento->conta_receber_id = $id;
    	
    	$pagamento->save();
    	
    	$conta = ContaReceber::find($id);
    	
    	$valorRecebido = $conta->valorRecebido;
    	$valorRecebido += $inputs['valorPagamento'];
    	
    	$conta->valorRecebido = $valorRecebido;
        $conta->dataRecebimento = Carbon::now();
        $conta->situacao = $this->adjustSitucao($conta->valorLiquido,$conta->valorRecebido);
    	
    	$conta->save();
    }

    public function removeRecebimento($id){
        $idRetornar = $this->findContaIdByPagamentoId($id);

        $pagamento = ContaReceberFormaPagamento::find($id);
        $conta = ContaReceber::find($idRetornar);
        $conta->valorRecebido -= $pagamento->valor;
        $conta->situacao = $this->adjustSitucao($conta->valorLiquido,$conta->valorRecebido);
        $conta->save();
        $pagamento->delete();

        return $idRetornar;
    }

    private function findContaIdByPagamentoId($id){
        return ContaReceberFormaPagamento::find($id)->conta_receber_id;
    }

    private function adjustSitucao($valorLiquido,$valorPago){
        if( $valorPago >= $valorLiquido )
    	{
    		return 2;
    	}
    	elseif( $valorPago > 0 && $valorPago != 0 )
    	{
    		return 3;
    	}
    	else
    	{
    		return 1;
    	}
    }
    
}