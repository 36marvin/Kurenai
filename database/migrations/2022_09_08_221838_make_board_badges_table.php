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
        Schema::create('board_badges', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('userId')->primary(); 
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->boolean('mod1');
            $table->boolean('mod2');
            $table->boolean('mod3');
            $table->boolean('banReviewer');
            $table->boolean('auxManager');
            $table->boolean('boardOwner');

            $table->foreign('userId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_badges');
    }
};
