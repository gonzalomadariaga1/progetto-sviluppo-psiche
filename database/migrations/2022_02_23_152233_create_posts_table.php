<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_es');
            $table->string('title_it')->nullable();
            $table->string('slug');
            $table->enum('status',['public','hidden','draft','program'])->default('draft');
            $table->mediumText('resumen_es')->nullable();
            $table->mediumText('resumen_it')->nullable();
            $table->text('content_it')->nullable();
            $table->text('content_es')->nullable();
            $table->mediumText('iframe')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->foreignId('categoria_id')->references('id')->on('categorias')->nullable();
            $table->integer('userId')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
