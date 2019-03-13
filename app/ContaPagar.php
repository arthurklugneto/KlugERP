<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
	protected $table = 'contas_pagar';
	
	public function fornecedor()
	{
		return $this->hasOne('App\Fornecedor', 'id', 'fornecedor_id');
	}
	
	public function planoConta()
	{
		return $this->hasOne('App\PlanoConta', 'id', 'plano_contas_id');
	}
}
