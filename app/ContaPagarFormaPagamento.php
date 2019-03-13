<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaPagarFormaPagamento extends Model
{
	protected $table = 'contas_pagar_formas_pagamentos';
	
	public function contaPagar()
	{
		return $this->hasOne('App\ContaPagar', 'id', 'conta_pagar_id');
	}
	
	public function formaPagamento()
	{
		return $this->hasOne('App\FormaPAgamento', 'id', 'forma_pagamentos_id');
	}
}
