<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_produtos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('entrada_id')->unsigned();
            $table->foreign('entrada_id')->references('id')->on('entradas');
            
            $table->decimal('valor', 10, 2);
            $table->decimal('quantidade', 10, 2);
            
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');
            
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
        Schema::dropIfExists('entradas_produtos');
    }
}
