<?php

namespace App\Services;

use App\CategoriasProduto;

class CategoriasService{

    public function __construct(){}

    public function getAll(){
        return CategoriasProduto::all();
    }

    public function findById($id){
        return CategoriasProduto::find($id);
    }

    public function save($inputs){
        $entry = new CategoriasProduto;
		$entry->nome = $inputs['nome'];
        $entry->save();
    }

    public function update($inputs,$id){
        $entry = $this->findById($id);
		$entry->nome = $inputs['nome'];
        $entry->save();
    }

    public function remove($id){
        $entry = CategoriasProduto::find($id);
        $entry->delete();
    }

}