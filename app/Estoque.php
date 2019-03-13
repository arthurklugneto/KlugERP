<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
	protected $table = 'estoque';
	
	public function produto()
	{
		return $this->hasOne('App\Produto', 'id', 'produto_id');
	}
}
