<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaFormaPagamento extends Model
{
	protected $table = 'entradas_formas_pagamentos';
	
	public function formaPagamento()
	{
		return $this->hasOne('App\FormaPagamento', 'id', 'forma_pagamentos_id');
	}
}
