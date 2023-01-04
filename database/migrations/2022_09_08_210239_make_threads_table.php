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
            $table->uuid('id')->unique();
            $table->uuid('user_id'); // author of the thread 
            $table->unsignedBigInteger('fuel_count')->default(0);
            $table->unsignedBigInteger('bump_count')->default(0);
            $table->unsignedBigInteger('in_board_pseudo_id'); // threads and replies in a specific board are numbered in the order that they have been created: 1, 2, 3, ... 100, ... (this counter should be updated when the thread is moved)

            $table->string('title', 255);
            $table->string('body', 4000);
            $table->string('board_uri', 255);

            $table->timestamp('created_at');
            $table->timestamp('last_pinned_updated')->default(null); // pinned posts go first, the ones with longer last_pinned_update timestamp at the topmost
            $table->timestamp('last_valid_bump_at');
            $table->timestamp('updated_at');

            $table->boolean('is_locked')->default(false);
            $table->boolean('is_infinite')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_censored')->default(false);
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
