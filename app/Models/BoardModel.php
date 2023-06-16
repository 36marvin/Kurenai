<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\App;
use Database\Factories\BoardFactory;
use App\Models\ThreadModel;
use App\Models\User as UserModel;

class BoardModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'boards';

    protected $primaryKey = 'id';

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'uri',
        'isSecret',
        'isFrozen',
        'isGlobalStaffOnly',
    ];

    private function getThreadModel () {
        return App::make('App\Models\ThreadModel'); 
    }

    // private function getUserModel () {
    //     return App::make(UserModel::class); 
    // }

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

    public function createBoard($name, $uri, $description, $isFrozen, $isSecret, $isGlobalStaffOnly) {
        $this->create([
            'name' => $name,
            'uri' => $uri,
            'description' => $description,
            'isFrozen' => $isFrozen,
            'isSecret' => $isSecret,
            'isGlobalStaffOnly' => $isGlobalStaffOnly,
        ]);
    }

    public function deleteBoard($uri) {
        $self->where('uri', $uri)
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
        $boardConfig = $this->select('uri', 'name', 'createdAt', 'description', 'isFrozen', 'isSecret')
                            ->where('uri', $boardUri)
                            ->first()
                            ->toArray();
        return $boardConfig;
    }

    public function getAllBoards (): array {
        $allBoards = $this->get()
                          ->toArray();
        return $allBoards;
    }

    /**
     *  This is for the boardlist.
     */
    public function getAllBoardsPaginated()
    {
        // paginate()'s argument will make Docker's php process glitch if changed to some other values (eg 20)
        // return $this->paginate(50)
                    // ->toArray();

        // this is a workaround
        $userModel = App::make(UserModel::class);
        if (Auth::check() && $userModel->isGlobalStaffer(Auth::id())) {
            return $this->paginate(50);
        } else {
            return $this->where('isSecret', false)
                        ->paginate(50);
        }
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

        $secretBoards = $this->where('isSecret', true)->count();
        $nonSecretBoards = $allBoards - $secretBoards;

        $frozenBoards = $this->where('isFrozen', true)->count();
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
        return $this->where('uri', $uri)
             ->exists();
    }

    public function getPostCount($boardUri)
    {
        return $this->select('postCount')
                    ->where('uri', $boardUri)
                    ->first()
                    ->postCount;
    }

    public function incrementBoardPostCount($boardUri) 
    {
        $board = $this->where('uri', $boardUri)
                      ->first();
        if(isset($board->postCount)) {
            $board->postCount = $board->postCount + 1;
        } else {
            $board->postCount = 1;    
        }
        Model::withoutTimestamps(fn () => $board->save());
    }
}