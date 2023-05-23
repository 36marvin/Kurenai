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
        Schema::create('replies', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignUuid('userId');
            $table->foreignUuid('threadId');
            $table->string('title', 255)->nullable();
            $table->string('body', 65535);
            $table->integer('fuelCount')->default(0);
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            // $table->timestamp('last_edited_at'); ???
            $table->boolean('isHighlighted')->default(false);
            
            $table->foreign('threadId')->references('id')->on('threads');
            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
