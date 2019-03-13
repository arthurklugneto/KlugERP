<?php

namespace App\Services;

use App\Fornecedor;

class FornecedorService{

    public function getAll(){
        return Fornecedor::all();
    }

    public function findById($id){
        return Fornecedor::find($id);
    }

    public function save($inputs){
        $registro = new Fornecedor;
				
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
        $registro = Fornecedor::find($id);
	
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
        $registro = Fornecedor::find($id);
        $registro->delete();
    }

}
