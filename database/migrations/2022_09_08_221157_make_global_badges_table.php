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
            $table->uuid('id')->unique();
            $table->unsignedBigInteger('userId')->unique(); 
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->boolean('mod1');
            $table->boolean('mod2');
            $table->boolean('mod3');
            $table->boolean('banReviewer');
            $table->boolean('newsEditor');
            $table->boolean('auxManager');
            $table->boolean('auxManager2');
            $table->boolean('admin');
            $table->boolean('dev');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_badges');
    }
};
