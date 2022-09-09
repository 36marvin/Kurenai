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
        Schema::create('boards', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('board_name');
            $table->string('board_uri');

            $table->string('board_description');
            $table->timestamp('created_at');
            $table->boolean('is_frozen')->default(false);
            $table->boolean('is_secret')->default(false);

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
        //
    }
};
