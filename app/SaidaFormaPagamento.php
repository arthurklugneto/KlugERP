<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaidaFormaPagamento extends Model
{
	protected $table = 'saidas_formas_pagamentos';
	
	public function formaPagamento()
	{
		return $this->hasOne('App\FormaPagamento', 'id', 'forma_pagamentos_id');
	}
	
}
