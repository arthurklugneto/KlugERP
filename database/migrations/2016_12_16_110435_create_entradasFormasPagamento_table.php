<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasFormasPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_formas_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('entrada_id')->unsigned();
            $table->foreign('entrada_id')->references('id')->on('entradas');
            
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
        Schema::dropIfExists('entradas_formas_pagamentos');
    }
}
