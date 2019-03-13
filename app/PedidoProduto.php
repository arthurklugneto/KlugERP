<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'pedidos_produtos';
	
	public function produto()
	{
		return $this->hasOne('App\Produto', 'id', 'produto_id');
	}
}
