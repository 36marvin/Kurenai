<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  This class will be used by the autoban middleware.
 */

class AutoBanModel extends Model
{
    use HasFactory;

    protected $table = 'banned_strings';

    public function getBannedStrings() {
        return;
    }
}
