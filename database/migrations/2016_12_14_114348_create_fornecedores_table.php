<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
        	$table->increments('id');
        	
        	$table->string('nome');
        	
        	$table->enum('tipo', array('fisica', 'juridica'))->default('fisica');
        	
        	$table->string('cnpjcpf')->nullable();
        	$table->string('ierg')->nullable();
        	
        	$table->string('endereco')->nullable();
        	$table->string('numero')->nullable();
        	$table->string('cep')->nullable();
        	$table->string('bairro')->nullable();
        	$table->string('cidade')->nullable();
        	$table->string('estado')->nullable();
        	$table->string('complemento')->nullable();
        	
        	$table->string('contato')->nullable();
        	$table->string('email')->nullable();
        	$table->string('telefone')->nullable();
        	$table->string('celular')->nullable();
        	
        	$table->longText('observacoes')->nullable();
        	
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedors');
    }
}
