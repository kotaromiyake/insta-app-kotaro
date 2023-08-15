<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use function PHPUnit\Framework\returnSelf;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    // user - post relationship
    public function posts()
    {
        return $this->hasmany(Post::class);
    }

    // user - followers relationship
    public function followers()
    {
        return $this->hasMany(Follow::class,'following_id');
        // user id to follows following id
    }

     // user - follower relationship
    public function following()
    {
        return $this->hasMany(Follow::class,'follower_id');
        // user id to follows following id
    }

    // follower_id         following_id
    // 1                       2
    // 1                       3
    // 1                       4
    // 2                       1
    // 2                       3
    // 2                       4

    // is followed
    // chech if currently logged in user follows the user
    public function isFollowed()
    {
        return $this->followers()->where('follower_id',Auth::user()->id)->exists();
        // return true if logged in user follows he user
    }
}
