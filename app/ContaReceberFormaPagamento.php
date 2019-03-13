<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaReceberFormaPagamento extends Model
{
	protected $table = 'contas_receber_formas_pagamentos';
	
	public function contaReceber()
	{
		return $this->hasOne('App\ContaReceber', 'id', 'conta_receber_id');
	}
	
	public function formaPagamento()
	{
		return $this->hasOne('App\FormaPAgamento', 'id', 'forma_pagamentos_id');
	}
}
