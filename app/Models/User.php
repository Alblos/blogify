<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'password' => 'hashed',
    ];

    public static function getTotalRecivedLikes($user_id): int
    {
        return DB::table('likes')
            ->where('blog_id', DB::table('blogs')
                ->where('user_id', $user_id)->value('id'))
            ->where('liked', true)->count();
    }

    public static function getPostsCount($user_id): int
    {
        return  DB::table('blogs')->where('user_id', $user_id)->where('status', 'published')->count();
    }

    public static function getUpSince($user_id): string
    {
        return DB::table('users')->where('id', $user_id)->value('created_at');
    }

    /**
     * Function to validate the user
     * @return string[]
     */
    public static function validate(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
    }
}
