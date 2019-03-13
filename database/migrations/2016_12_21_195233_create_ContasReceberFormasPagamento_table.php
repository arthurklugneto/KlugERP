<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasReceberFormasPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_receber_formas_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('conta_receber_id')->unsigned();
            $table->foreign('conta_receber_id')->references('id')->on('contas_receber');
            
            $table->integer('forma_pagamentos_id')->unsigned();
            $table->foreign('forma_pagamentos_id')->references('id')->on('forma_pagamentos');
            
            $table->decimal('valor', 10, 2);
            
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
        Schema::dropIfExists('contas_receber_formas_pagamentos');
    }
}
