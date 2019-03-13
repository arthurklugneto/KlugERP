<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
	protected $table = 'saidas';
	
	public function cliente()
	{
		return $this->hasOne('App\Cliente', 'id', 'cliente_id');
	}
	
}
