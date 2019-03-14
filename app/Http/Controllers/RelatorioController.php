<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Services\RelatorioService;
use Excel;

class RelatorioController extends Controller
{
    
    protected $relatorioService;

	public function __construct(RelatorioService $relatorioService)
	{
        $this->middleware('auth');
        $this->relatorioService = $relatorioService;
	}
	
	public function index()
	{
		return View::make('relatorio.index');
	}
	
	public function relatorioSaidas()
	{
		Excel::create('Relatorio Saidas', function($excel) {
			
			$excel->setTitle('Relatório ERP');
			$excel->setCreator('Arthur Klug Neto')->setCompany('KluSoft');
					
			$excel->sheet('Saidas', function($sheet) {

				$dataInicial = Input::get('dataInicial').' 00:00:00';
				$dataFinal = Input::get('dataFinal'). '23:59:59';
					
                $saidas = $this->relatorioService->generateRelatorioSaidas($dataInicial,$dataFinal);
				
				$arrayDados = array();				
								
				foreach($saidas as $saida)
				{
					$array = array(
							"Data Venda" => $saida->dataVenda,
							"Cliente" => $saida->cliente->nome,
							"Valor" => $saida->valor,
							"Valor Recebido" => $saida->valorRecebido,
							"Situação" => $saida->situacao,
							"Observações" => $saida->observacoes,
							"Data de Criação" => $saida->created_at,
					);
					array_push($arrayDados,$array);
				}
				
				$sheet->fromArray($arrayDados);
			
			});
			
		})->download('xlsx');
		
		return View::make('relatorio.index');
		
	}
	
	public function relatorioEntradas()
	{
		Excel::create('Relatorio Entradas', function($excel) {
				
			$excel->setTitle('Relatório ERP');
			$excel->setCreator('Arthur Klug Neto')->setCompany('KluSoft');
				
			$excel->sheet('Entradas', function($sheet) {
		
				$dataInicial = Input::get('dataInicial').' 00:00:00';
				$dataFinal = Input::get('dataFinal'). '23:59:59';
					
				$entradas = $this->relatorioService->generateRelatorioEntradas($dataInicial,$dataFinal);
		
				$arrayDados = array();		
		
				foreach($entradas as $entrada)
				{
					$array = array(
							"Data Compra" => $entrada->dataCompra,
							"Fornecedor" => $entrada->fornecedor->nome,
							"Valor" => $entrada->valor,
							"Valor Pago" => $entrada->valorPago,
							"Situação" => $entrada->situacao,
							"Observações" => $entrada->observacoes,
							"Data de Criação" => $entrada->created_at,
					);
					array_push($arrayDados,$array);
				}
		
				$sheet->fromArray($arrayDados);
					
			});
					
		})->download('xlsx');
		
		return View::make('relatorio.index');
	}
	
	public function relatorioEstoque()
	{
		Excel::create('Relatorio Estoque', function($excel) {
		
			$excel->setTitle('Relatório ERP');
			$excel->setCreator('Arthur Klug Neto')->setCompany('KluSoft');
		
			$excel->sheet('Entradas', function($sheet) {
		
					
				$estoque = $this->relatorioService->generateRelatorioEstoque();
		
				$arrayDados = array();
		
		
				foreach($estoque as $estoque)
				{
					$array = array(
							"Produto" => $estoque->produto->nome,
							"Quantidade" => $estoque->quantidade,
							"Data de Atualização" => $estoque->updated_at,
					);
					array_push($arrayDados,$array);
				}
		
				$sheet->fromArray($arrayDados);
					
			});
					
		})->download('xlsx');
		
		return View::make('relatorio.index');
	}
	
}
