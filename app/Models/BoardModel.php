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

    private function getThreadModel () {
        return App::make('App\Models\ThreadModel'); 
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
        return $this->getThreadModel()->getPaginatedBoardIndexThreadsWithReplies();
    }

    public function updateBoard($uri) {
        
    }

    public function createBoard(Request $request) {
        $this->create([
            'board_name' => $request->boardName,
            'board_uri' => $request->boardUri,
            'board_description' => $request->boardDescription,
            'is_frozen' => $request->isFrozen ?? false,
            'is_secret' => $request->isSecret ?? false,
        ]);
        $this->save();
    }

    public function deleteBoard($uri) {
        $self->where('board_uri', $uri)
             ->delete();
        // $this->threadModel->where('board_uri', $boardUri)
        //                   ->delete();
        // and then delete the replies...
    }

    /**
     *   Returns an array containing thread data (title, author, time...), 
     *   and reply data (title, author, etc) for each thread.
     */

     public function getBoardConfig(): array {
        $boardUri = request()->route()->parameter('boardUri');
        $boardConfig = $this->select('board_uri', 'board_name', 'board_description', 'is_frozen', 'is_secret')
                            ->where('board_uri', $boardUri)
                            ->first()
                            ->toArray();
        return $boardConfig;
    }

    public function getAllBoards (): array {
        $allBoards = $this->get()
                          ->toArray();
        return $allBoards;
    }

    public function getAllBoardsPaginated()
    {
        return $this->paginate(50)
                    ->toArray();
    }

    /**
     *  Returns an array with numbers of boards by category 
     *  (secret, frozen, non-frozen, etc).
     *  
     *  Todo: except for the allBoards and staffBoards keys, staff
     *  boards are NOT included in the count.
     */

    public function getBoardCounts(): array {
        $allBoards = $this->count();

        // $staffBoards = $this->where('isGlobalStaffOnly', true)->count();
        // $nonStaffBoards = $allBoards - $staffBoards;

        $secretBoards = $this->where('is_secret', true)->count();
        $nonSecretBoards = $allBoards - $secretBoards;

        $frozenBoards = $this->where('is_frozen', true)->count();
        $nonFrozenBoards = $allBoards - $frozenBoards;

        return [
            'allBoards' => $allBoards,
            // 'staffBoards' => $staffBoards,
            // 'nonStaffBoards' => $nonStaffBoards, 
            'secretBoards' => $secretBoards,
            'nonSecretBoards' => $nonSecretBoards, 
            'frozenBoards' => $frozenBoards,
            'nonFrozenBoards' => $nonFrozenBoards,
        ];
    }

    public function checkIfBoardExists ($uri): bool {
        return $this->where('board_uri', $uri)
             ->exists();
    }
}