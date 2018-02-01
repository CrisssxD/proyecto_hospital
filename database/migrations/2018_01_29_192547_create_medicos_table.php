<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemedicosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('C_I');
            $table->string('especialidad');
            $table->integer('celular');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicos');
    }
}
