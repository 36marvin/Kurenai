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
            $table->uuid('id')->unique();
            $table->string('name', 255);
            $table->string('uri', 255)->unique();
            $table->string('description', 2000);
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->boolean('isFrozen')->default(false);
            $table->boolean('isSecret')->default(false);
            $table->boolean('isGlobalStaffOnly')->default(false);

            // This is to make sure that thread and replies' public ids
            // will always continuously increment together.
            $table->unsignedBigInteger('postCount')->autoIncrement()->from(1);   
        });

        Schema::table('threads', function (Blueprint $table) {
            $table->foreign('boardUri')->references('uri')->on('boards');
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
