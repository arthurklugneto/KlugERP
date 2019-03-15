<?php

namespace App\Services;

use App\ContaPagar;
use App\ContaPagarFormaPagamento;
use App\Fornecedor;
use App\FormaPagamento;
use App\PlanoConta;
use Carbon\Carbon;
use DB;

class ContaPagarService{

    public function __construct(){}

    public function getAll(){
        return ContaPagar::all();
    }

    public function findById($id){
        return ContaPagar::find($id);
    }

    public function remove($id){
        $pagamentos = ContaPagarFormaPagamento::all()->where('conta_pagar_id', $id);
    	foreach ($pagamentos as $key => $value)
    	{
    		$value->delete();
    	}
    	 
    	$registro = ContaPagar::find($id);
    	$registro->delete();
    }

    public function save($inputs){
        $registro = new ContaPagar;
    	 
    	$registro->fornecedor_id = $inputs['fornecedor_id'];
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
    	 
    	if( empty($inputs['dataPagamento']) )
    	{
    		$registro->dataPagamento = null;
    	}
    	else
    	{
    		$registro->dataPagamento = $inputs['dataPagamento'];
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

    public function update($inputs,$id){
    }
    
    public function getFornecedores(){
        return Fornecedor::pluck('nome','id');
    }

    public function getPlanoContas(){
        return DB::table('plano_contas')->where('tipo', 'despesa')->pluck('nome','id');
    }

    public function getFormasPagamento(){
        return FormaPagamento::pluck('nome','id');
    }

    public function getContaPagamentos($id){
        return ContaPagarFormaPagamento::all()->where('conta_pagar_id', $id);
    }

    public function addPagamento($inputs,$id){
        $pagamento = new ContaPagarFormaPagamento;
    	$pagamento->valor = $inputs['valorPagamento'];
    	$pagamento->forma_pagamentos_id = $inputs['formasPagamento'];
    	$pagamento->conta_pagar_id = $id;
    	 
    	$pagamento->save();
    	 
    	$conta = ContaPagar::find($id);
    	 
    	$valorPago = $conta->valorPago;
    	$valorPago += $inputs['valorPagamento'];
    	 
    	$conta->valorPago = $valorPago;
    	$conta->dataPagamento = Carbon::now();	 
    	$conta->situacao = $this->adjustSitucao($conta->valorLiquido,$conta->valorPago);
    	 
    	$conta->save();
    }

    public function removePagamento($id){
        $idRetornar = $this->findContaIdByPagamentoId($id);

        $pagamento = ContaPagarFormaPagamento::find($id);
        $conta = ContaPagar::find($idRetornar);
        $conta->valorPago -= $pagamento->valor;
        $conta->situacao = $this->adjustSitucao($conta->valorLiquido,$conta->valorPago);
        $conta->save();
        $pagamento->delete();
        return $idRetornar;
    }

    private function findContaIdByPagamentoId($id){
        return ContaPagarFormaPagamento::find($id)->conta_pagar_id;
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