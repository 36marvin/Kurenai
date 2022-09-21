<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // fuck yeah, I love this framework

class BanModel extends Model
{
    use HasFactory;

    protected $table = 'bans';

    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = ['id', 'message', 'board_uri', 'board_uri_exception', 'expires_at', 'created_at'];

    /**
     *  Returns an associative array with each ban
     *  and its properties.
     *  @return arrray
     */

    public function getActiveBans($userId):array {
        $self::select('id', 'message', 'board_uri', 'board_uri_exception', 'expires_at', 'created_at')
             ->where('is_revoked', false)
             ->orderBy('created_at', 'desc')
             ->get();
    }

    public function makeBan(array $ban) {
        create([
            'message' => $ban['message'],
            'message' => $ban['public_message'],
            'board_uri' => $ban['board_uri'],
            'board_uri_exception' => $ban['board_uri_exception'],
            'expired_at' => $ban['expires_at'],
            'show_at_public_banlist' => $ban['show_at_public_banlist']

        ]);
    }
}
