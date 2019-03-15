<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () { return view('welcome'); });
Route::get('/home', 'HomeController@index');
Auth::routes();

// CADASTROS
Route::resource('nerds', 'NerdController');
Route::resource('categoriasProduto', 'CategoriasProdutoController');
Route::resource('produto', 'ProdutoController');
Route::resource('cliente', 'ClienteController');
Route::resource('fornecedor', 'FornecedorController');

// VENDAS
Route::resource('venda', 'VendaController');
Route::post('/venda/{id}/edit', 'VendaController@addItem');
Route::post('/venda/{id}/pagar', 'VendaController@addPagamento');
Route::post('/venda/{id}/removePagamento', 'VendaController@removePagamento');
Route::post('/venda/{id}/finalizar', 'VendaController@finalizarVenda');
Route::post('/venda/{id}/removeItem', 'VendaController@removeItem');

// PEDIDO
Route::resource('pedido', 'PedidoController');
Route::post('/pedido/{id}/edit', 'PedidoController@addItem');
Route::post('/pedido/{id}/finalizar', 'PedidoController@finalizarPedido');
Route::post('/pedido/{id}/vender', 'PedidoController@venderPedido');
Route::post('/pedido/{id}/removeItem', 'PedidoController@removeItem');

// COMPRAS
Route::resource('compra', 'CompraController');
Route::post('/compra/{id}/edit', 'CompraController@addItem');
Route::post('/compra/{id}/pagar', 'CompraController@addPagamento');
Route::post('/compra/{id}/removePagamento', 'CompraController@removePagamento');
Route::post('/compra/{id}/finalizar', 'CompraController@finalizarCompra');
Route::post('/compra/{id}/removeItem', 'CompraController@removeItem');

// RELATORIOS
Route::get('/relatorio', 'RelatorioController@index');
Route::post('/relatorio/saidas', 'RelatorioController@relatorioSaidas');
Route::post('/relatorio/entradas', 'RelatorioController@relatorioEntradas');
Route::post('/relatorio/estoque', 'RelatorioController@relatorioEstoque');

// PLANO CONTAS
Route::resource('planoContas', 'PlanoContaController');

// CONTAS A RECEBER
Route::resource('contasReceber', 'ContasReceberController');
Route::post('/contasReceber/{id}/receber', 'ContasReceberController@addRecebimento');
Route::post('/contasReceber/{id}/removeRecebimento', 'ContasReceberController@removeRecebimento');

// CONTAS A PAGAR
Route::resource('contasPagar', 'ContasPagarController');
Route::post('/contasPagar/{id}/pagar', 'ContasPagarController@addPagamento');
Route::post('/contasPagar/{id}/removePagamento', 'ContasPagarController@removePagamento');

// ESTOQUE
Route::resource('estoque', 'EstoqueController');


