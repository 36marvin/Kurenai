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
            $table->unsignedBigInteger('id')->unique()->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('thread_id');
            $table->string('reply_title', 50)->nullable();
            $table->string('reply_body', 255);
            $table->integer('fuel_count')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('last_edited_at');
            $table->boolean('is_highlighted')->default(false);
            
            $table->foreign('thread_id')->references('id')->on('threads');
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