<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
	
	public function cliente()
	{
		return $this->hasOne('App\Cliente', 'id', 'cliente_id');
	}
}
