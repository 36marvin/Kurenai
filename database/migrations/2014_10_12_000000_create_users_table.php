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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name', 40)->unique();
            $table->string('email', 320)->unique()->nullable();
            $table->string('password', 200); // the hash may be much longer than the original password 
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('badgeId')->references('id')->on('badges')->nullable(); we don't need this 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
