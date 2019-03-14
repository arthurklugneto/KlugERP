<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
        $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value > $min_value;
        });   
      
        Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
        return str_replace(':field', $parameters[0], $message);
        });
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
        $this->app->bind('App\Services\ContaReceberService', function($app){
            return new \App\Services\ContaReceberService();
        });
        $this->app->bind('App\Services\RelatorioService', function($app){
            return new \App\Services\RelatorioService();
        });
    }
}
