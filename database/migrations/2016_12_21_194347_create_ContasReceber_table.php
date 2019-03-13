<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_receber', function (Blueprint $table) {
            
        	$table->increments('id');
            
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            
            $table->integer('plano_contas_id')->unsigned();
            $table->foreign('plano_contas_id')->references('id')->on('plano_contas');
            
            $table->date('dataEmissao')->nullable();
            $table->date('dataVencimento')->nullable();
            $table->date('dataRecebimento')->nullable();
            
            $table->longText('descricao')->nullable();
            
            $table->decimal('valorOriginal', 10, 2)->default(0);
            $table->decimal('valorLiquido', 10, 2)->default(0);
            $table->decimal('valorRecebido', 10, 2)->default(0);
            
            $table->enum('situacao', array('aberta', 'finalizada','incompleta'))->default('aberta');
            
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
        Schema::dropIfExists('contas_receber');
    }
}
