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
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('user_id'); 
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('mod_1');
            $table->boolean('mod_2');
            $table->boolean('mod_3');
            $table->boolean('ban_reviewer');
            $table->boolean('aux_manager');
            $table->boolean('board_owner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
