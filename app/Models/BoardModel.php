<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardModel extends Model
{
    use HasFactory;

    protected $table = 'boards';

    protected $primaryKey = 'uri';

    public $incrementing = false;

    protected $keyType = 'string';

    // protected $fillable = [];

    public function getBoardViewData($uri, $page) {

    }

    public function updateBoard($uri) {
        
    }

    public function createBoard($options) {
        
    }

    public function deleteBoard($uri) {
        
    }
}
