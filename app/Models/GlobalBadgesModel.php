<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalBadgesModel extends Model
{
    use HasFactory;

    protected $table = 'global_badges';

    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     *  Checks if there is a global badge with
     *  at least one special column relating to
     *  its global permissions set to true.
     */
    public function checkIfValidBadgeExists(string $userId) : bool
    {
        $badge = $this->select(
                               'mod1',
                               'mod2',
                               'mod3', 
                               'ban-reviewer',
                               'aux-manager',
                               'aud-manager2',
                               'admin'
                              )
                      ->where('user_id', $userId)
                      ->first()
                      ->toArray(); // I like arrays

        // Whole function will return true if
        // any permission is found.
        foreach($badge as $badgePermission) {
            if($badgePermission == true) {
                return true;
            }
        };
        return false;
    }
}
