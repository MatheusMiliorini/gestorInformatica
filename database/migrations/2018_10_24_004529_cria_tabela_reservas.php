<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas',function (Blueprint $table) {
            $table->date('dia');
            $table->integer('codigo_professor');
            $table->string('horario');
            $table->integer('sala_numero');

            $table->primary(['dia','sala_numero','horario']);

            $table->foreign('codigo_professor')->references('codigo_professor')->on('professores');
            $table->foreign('horario')->references('horario')->on('horarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservas');
    }
}
