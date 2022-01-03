<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->date('published_at');
            $table->string('slug');
            $table->timestamps();
            // Relações
            $table->foreign('author_id')
                ->references('id')
                ->on('author')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
