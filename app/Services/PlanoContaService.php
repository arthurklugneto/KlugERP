<?php

namespace App\Services;

use App\PlanoConta;

class PlanoContaService{

    public function __construct(){}

    public function getAll(){
        return PlanoConta::all();
    }

    public function findById($id){
        return PlanoConta::find($id);
    }

    public function save($inputs){
        $plano = new PlanoConta;
        $plano->nome = $inputs['nome'];
        $plano->tipo = $inputs['tipo'];
        $plano->margem = 0;
        if(!empty($inputs['margem']) ) $plano->margem = str_replace(",", ".", $inputs['margem']);
        $plano->save();
    }

    public function update($inputs,$id){
        $plano = $this->findById($id);
        $plano->nome = $inputs['nome'];
        $plano->tipo = $inputs['tipo'];
        $plano->margem = 0;
        if(!empty($inputs['margem']) ) $plano->margem = str_replace(",", ".", $inputs['margem']);
        $plano->save();
    }

    public function remove($id){
        $entry = PlanoConta::find($id);
        $entry->delete();
    }

}
