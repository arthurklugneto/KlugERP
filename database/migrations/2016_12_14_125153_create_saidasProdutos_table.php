<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaidasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas_produtos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('saida_id')->unsigned();
            $table->foreign('saida_id')->references('id')->on('saidas');
            
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
        Schema::dropIfExists('saidas_produtos');
    }
}
