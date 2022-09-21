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
        Schema::create('global_badges', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('user_id'); 
            $table->timestamp('created_at');
            $table->timestamp('last_edited_at');
            $table->boolean('mod_1');
            $table->boolean('mod_2');
            $table->boolean('mod_3');
            $table->boolean('ban_reviewer');
            $table->boolean('news_editor');
            $table->boolean('aux_manager');
            $table->boolean('aux_manager2');
            $table->boolean('admin');
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
