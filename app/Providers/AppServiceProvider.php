<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\CategoriasService', function($app){
            return new \App\Services\CategoriasService();
        });
        $this->app->bind('App\Services\ProdutoService', function($app){
            return new \App\Services\ProdutoService();
        });
        $this->app->bind('App\Services\PlanoContaService', function($app){
            return new \App\Services\PlanoContaService();
        });
        $this->app->bind('App\Services\ClienteService', function($app){
            return new \App\Services\ClienteService();
        });
        $this->app->bind('App\Services\FornecedorService', function($app){
            return new \App\Services\FornecedorService();
        });
        
        $this->app->bind('App\Services\CompraService', function($app){
            return new \App\Services\CompraService();
        });
        $this->app->bind('App\Services\VendaService', function($app){
            return new \App\Services\VendaService();
        });
        $this->app->bind('App\Services\EstoqueService', function($app){
            return new \App\Services\EstoqueService();
        });
        $this->app->bind('App\Services\PedidoService', function($app){
            return new \App\Services\PedidoService();
        });

        $this->app->bind('App\Services\ContaPagarService', function($app){
            return new \App\Services\ContaPagarService();
        });
    }
}
