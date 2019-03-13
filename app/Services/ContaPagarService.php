<?php

namespace App\Services;

use App\ContaPagar;

class ContaPagarService{

    public function __construct(){}

    public function getAll(){
        return ContaPagar::all();
    }

    public function findById($id){
        return ContaPagar::find($id);
    }

    public function remove($registro){
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

}