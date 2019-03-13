<?php

namespace App\Services;

use App\Cliente;

class ClienteService{

    public function __construct(){}

    public function getAll(){
        return Cliente::all();
    }

    public function findById($id){
        return Cliente::find($id);
    }

    public function save($inputs){
        $registro = new Cliente;
        
        $registro->nome = $inputs['nome'];
        $registro->cnpjcpf = $inputs['cnpjcpf'];
        $registro->ierg = $inputs['ierg'];
        $registro->endereco = $inputs['endereco'];
        $registro->numero = $inputs['numero'];
        $registro->cep = $inputs['cep'];
        $registro->bairro = $inputs['bairro'];
        $registro->cidade = $inputs['cidade'];
        $registro->estado = $inputs['estado'];
        $registro->complemento = $inputs['complemento'];
        $registro->contato = $inputs['contato'];
        $registro->email = $inputs['email'];
        $registro->telefone = $inputs['telefone'];
        $registro->celular = $inputs['celular'];
        $registro->observacoes = $inputs['observacoes'];

        $registro->save();
    }

    public function update($inputs,$id){
        $registro = $this->findById($id);

        $registro->nome = $inputs['nome'];
        $registro->cnpjcpf = $inputs['cnpjcpf'];
        $registro->ierg = $inputs['ierg'];
        $registro->endereco = $inputs['endereco'];
        $registro->numero = $inputs['numero'];
        $registro->cep = $inputs['cep'];
        $registro->bairro = $inputs['bairro'];
        $registro->cidade = $inputs['cidade'];
        $registro->estado = $inputs['estado'];
        $registro->complemento = $inputs['complemento'];
        $registro->contato = $inputs['contato'];
        $registro->email = $inputs['email'];
        $registro->telefone = $inputs['telefone'];
        $registro->celular = $inputs['celular'];
        $registro->observacoes = $inputs['observacoes'];
        
        $registro->save();
    }

    public function remove($id){
        $registro = Cliente::find($id);
        $registro->delete();
    }
    
}