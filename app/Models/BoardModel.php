<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Database\Factories\BoardFactory;
use App\Models\ThreadModel;

class BoardModel extends Model
{
    use HasFactory;

    protected $table = 'boards';

    protected $primaryKey = 'uri';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public $incrementing = false;

    protected $keyType = 'string';

    // protected $fillable = [];

    public function __construct () {
        $this->threadModel = App::make('App\Models\ThreadModel');
    }

    protected static function newFactory() {
        return BoardFactory::new();
    }

    /**
     *  Returns an array of all threads, along with their replies, 
     *  for the board index view. Detects the uri from the request 
     *  and does pagination automatically.
     */
    public function getThreadsForIndex () {
        return $this->threadModel->getPaginatedBoardIndexThreadsWithReplies();
    }

    public function updateBoard($uri) {
        
    }

    public function createBoard(Request $request) {
        $this->insert([
            'board_name' => $request->boardName,
            'board_uri' => $request->boardUri,
            'board_description' => $request->boardDescription,
            'is_frozen' => $request->isFrozen ?? false,
            'is_secret' => $request->isSecret ?? false,
        ]);
        $this->save();
    }

    public function deleteBoard($uri) {
        
    }

    /**
     *   Returns an array containing thread data (title, author, time...), 
     *   and reply data (title, author, etc) for each thread.
     */

     public function getBoardConfig(): array {
        $boardUri = request()->boardUri;
        $boardConfig = $this->select('board_uri', 'board_name', 'board_description')
                            ->where('board_uri', $boardUri)
                            ->first()
                            ->toArray();
        return $boardConfig;
    }
}