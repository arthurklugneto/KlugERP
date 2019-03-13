<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    
	protected $table = 'contas_receber';
	
	public function cliente()
	{
		return $this->hasOne('App\Cliente', 'id', 'cliente_id');
	}
	
	public function planoConta()
	{
		return $this->hasOne('App\PlanoConta', 'id', 'plano_contas_id');
	}
	
}
