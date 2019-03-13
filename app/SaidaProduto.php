<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaidaProduto extends Model
{
	protected $table = 'saidas_produtos';
	
	public function produto()
	{
		return $this->hasOne('App\Produto', 'id', 'produto_id');
	}
	
}
