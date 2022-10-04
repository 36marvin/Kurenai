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
        Schema::create('autobans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
        
            // to be inserted using function strtotime()
            // e.g. strtotime('44 year 2 day 88 second'),
            // which becomes a unix timestamp
            $table->string('ban_duration');
            $table->string('banned_string');
            $table->string('autoban_message');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('is_innactive')->default(false); // if the admin decides to disable it without deleting it
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autobans');
    }
};
