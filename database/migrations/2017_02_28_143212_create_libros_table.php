<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id_libro');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
            $table->integer('id_genero')->unsigned();
            $table->foreign('id_genero')->references('id_genero')->on('generos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('libro');
    }
}
