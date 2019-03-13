<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaidasFormasPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas_formas_pagamentos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('saida_id')->unsigned();
            $table->foreign('saida_id')->references('id')->on('saidas');
            
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
        Schema::dropIfExists('saidas_formas_pagamentos');
    }
}
