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
        Schema::create('thread_tags', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('tag');
            $table->string('tag_description')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thread_tags');
    }
};
