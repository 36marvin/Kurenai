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
            $table->foreignUuid('userId'); // author of the thread, 
            $table->unsignedBigInteger('bumpCount')->default(0);
            $table->unsignedBigInteger('inBoardPseudoId')->unique(); // threads and replies in a specific board are numbered in the order that they have been created: 1, 2, 3, ... 100, ... (this counter should be updated when the thread is moved)

            $table->string('title', 255);
            $table->string('body', 4000);
            $table->string('boardUri', 255);

            $table->string('embeddedLink', 255)->nullable();
            $table->string('embeddedLinkTitle', 255)->nullable();

            $table->timestamp('createdAt');
            $table->timestamp('lastPinnedUpdated')->default(null); // pinned posts go first, the ones with longer last_pinned_update timestamp at the topmost
            $table->timestamp('lastValidBumpAt');
            $table->timestamp('updatedAt');

            $table->boolean('isLocked')->default(false);
            $table->boolean('isInfinite')->default(false);
            $table->boolean('isPinned')->default(false);
            $table->boolean('isCensored')->default(false);

            // $table->foreign('boardUri')->references('uri')->on('boards');

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
