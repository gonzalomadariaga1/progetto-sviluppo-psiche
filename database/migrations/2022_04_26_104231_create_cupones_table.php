<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->string('tipo', 20)->nullable();
            $table->integer('valor')->nullable();
            $table->boolean('limite_uso')->default(0); // 1 si es que se puede utilizar mas de una vez
            $table->integer('quedan_por_usar')->default(1)->nullable(); // si limite_uso es 1, aqui se pone la cantidad de veces que se puede utilzar
            $table->boolean('multi_uso')->default(0); // 1 si es que solo se puede utilizar 1 vez por mismo usuario
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
        Schema::dropIfExists('cupones');
    }
}
