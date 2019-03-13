<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaProduto extends Model
{
	protected $table = 'entradas_produtos';
	
	public function produto()
	{
		return $this->hasOne('App\Produto', 'id', 'produto_id');
	}
}
