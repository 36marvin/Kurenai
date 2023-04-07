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
                               'mod_1',
                               'mod_2',
                               'mod_3', 
                               'ban_reviewer',
                               'aux_manager',
                               'aux_manager2',
                               'admin'
                              )
                      ->where('user_id', $userId)
                      ->first();
        if($badge) {
            $badge->toArray(); // I like arrays
        } else {
            return false; // No badge for this user? Surely he's not a global staffer. Return false.
        }

        // He has a badge? See if his permissions are good.
        foreach($badge as $badgePermission) {
            if($badgePermission == true) {
                return true;
            }
        };
        return false;
    }
}
