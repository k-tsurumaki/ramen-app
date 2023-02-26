<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Post;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_owner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        // ユーザーの投稿を返す
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        // ユーザーのいいねした投稿を返す
        return $this->hasMany(Like::class);
    }

    public function shop()
    {
        // ユーザーがオーナーの場合、店を返す
        return $this->hasOne(Shop::class);
    }

    public function follows()
    {
        // ユーザーがフォローしている人を返す
        return $this->belongsToMany(User::class, 'followings', 'following_user_id', 'user_id');
    }

    public function followers()
    {
        // ユーザーのフォロワーを返す
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'following_user_id');
    }

    public function getPaginateFollows(int $limit_count = 6, int $user_id)
    {
        // フォローリストをペジネーション
        return $this
            ->find($user_id)
            ->follows()
            ->paginate($limit_count);
    }

    public function getPaginateFollowers(int $limit_count = 6, int $user_id)
    {
        // フォロワーリストをペジネーション
        return $this
            ->find($user_id)
            ->followers()
            ->paginate($limit_count);
    }
}
