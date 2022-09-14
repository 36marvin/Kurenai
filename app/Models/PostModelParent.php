<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\RegexProvider;

class PostModelParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    protected $userId;

    protected function formatBody($body, RegexProvider $regex) {
        return $regex->getFormattedBody($body);
    }
}
