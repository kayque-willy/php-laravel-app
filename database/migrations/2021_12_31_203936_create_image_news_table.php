<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_news', function (Blueprint $table) {
            $table->id();
            $table->integer('news_id');
            $table->string('image');
            $table->string('description');
            $table->boolean('active');
            $table->timestamps();
            // Relações
            $table->foreign('news_id')
                ->references('id')
                ->on('news')
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
        Schema::dropIfExists('image_news');
    }
}
