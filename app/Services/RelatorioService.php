<?php

namespace App\Services;

use App\Saida;
use App\Entrada;
use App\Estoque;

class RelatorioService{

    public function generateRelatorioSaidas($dataInicial,$dataFinal){
        return Saida::all()->where('dataVenda','>=',$dataInicial)->where('dataVenda','<=',$dataFinal);
    }

    public function generateRelatorioEntradas($dataInicial,$dataFinal){
        return Entrada::all()->where('dataCompra','>=',$dataInicial)->where('dataCompra','<=',$dataFinal);
    }

    public function generateRelatorioEstoque(){
        return Estoque::all();
    }

}