<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouseltarifaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carouseltarifa', function (Blueprint $table) {
            $table->id();
            $table->text('title_it')->nullable();
            $table->text('title_es')->nullable();
            $table->text('subtitle_it')->nullable();
            $table->text('subtitle_es')->nullable();
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
        Schema::dropIfExists('carouseltarifa');
    }
}
