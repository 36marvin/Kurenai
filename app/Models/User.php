<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    // use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'id',
        'email',
        'password',
        'badge_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $badgeID;

    function getUserByToken($token)
    {
        
    }

    function getRole($userId)
    {

    }

    public function signUp($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'password' => Hash::make($request->password),
            'id' => (string)Str::uuid(),
            'badge_id' => null,
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect('/');
    }

    public function login($request, $errorController) 
    {
        if (Auth::attempt([
            'email' => $request->email ?? null,
            'password' => $request->password,
            'name' => $request->name
          ])
        ) {
        $request->session()->regenerate();

        return redirect('/');
        }
    }

    public function logOut($request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
