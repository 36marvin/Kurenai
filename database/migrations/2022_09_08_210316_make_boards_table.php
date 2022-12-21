<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('board_name');
            $table->string('board_uri');
            $table->string('board_description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('is_frozen')->default(false);
            $table->boolean('is_secret')->default(false);

            // This is to make sure that thread and replies' public ids
            // will always continuously increment together. Each new post
            // of any type, in THIS board, should take this count as its 
            // id number, and THEN add this count by 1. This count should 
            // NEVER be subtracted.
            $table->unsignedBigInteger('post_count')->autoIncrement()->from(1);   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
};
