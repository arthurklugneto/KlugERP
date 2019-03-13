<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
	protected $table = 'entradas';
	
	public function fornecedor()
	{
		return $this->hasOne('App\Fornecedor', 'id', 'fornecedor_id');
	}
}
