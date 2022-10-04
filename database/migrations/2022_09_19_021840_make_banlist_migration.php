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
        Schema::create('bans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('mod_id');  // or "autoban"
            $table->string('banned_user_id');
            $table->string('board_uri'); // or "global", for global bans

            // Global mods should be able to ban an user
            // from all boards except one (e.g. a /meta/ 
            // or some special ban-appeal board)
            $table->string('board_uri_exception');

            $table->string('message'); // to display only on the banlist
            $table->string('public_message');
            $table->timestamp('expires_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            // In case someone decides to take down a wrongful ban
            // without deleting it's entire record from the db
            $table->boolean('is_revoked')->default(false);
            $table->boolean('show_at_public_banlist')->default(false); // 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bans');
    }
};
