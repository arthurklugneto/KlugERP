<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CategoriasProduto;

class Produto extends Model
{

	public function categoria()
	{
		return $this->hasOne('App\CategoriasProduto', 'id', 'categoria_id');
	}
	
}
