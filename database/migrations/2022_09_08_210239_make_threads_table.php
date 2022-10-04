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
        Schema::create('threads', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique()->autoIncrement();
            $table->unsignedBigInteger('user_id'); // author of the thread 
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('fuel_count')->default(0);
            $table->unsignedBigInteger('bump_count')->default(0);
            $table->string('thread_title');
            $table->string('thread_body');
            $table->timestamp('created_at');
            $table->timestamp('last_pinned_updated')->default(null); // pinned posts go first, the ones with longer last_pinned_update timestamp at the topmost
            $table->timestamp('last_valid_bump_at');
            $table->timestamp('last_edited_at');
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_infinite')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_highlighted')->default(false);


            $table->primary('id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
};
