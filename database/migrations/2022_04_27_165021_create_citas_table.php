<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_nombres')->nullable();
            $table->string('paciente_apellidos')->nullable();
            $table->string('paciente_email')->nullable();
            $table->string('paciente_telefono')->nullable();
            $table->string('dia')->nullable();
            $table->string('hora_inicio')->nullable();
            $table->string('hora_fin')->nullable();
            $table->string('estado')->nullable();
            $table->string('valor')->nullable();
            $table->foreignId('modalidad_id')->references('id')->on('modalidad')->onDelete('cascade');
            $table->foreignId('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreignId('especialista_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('cupon_id')->references('id')->on('cupones')->onDelete('cascade');
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
        Schema::dropIfExists('citas');
    }
}
