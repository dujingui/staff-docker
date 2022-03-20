<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = "t_users";
    protected $primaryKey = 'user_id';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login_key',
        'birthday',
        'account',
        'nickname',
        'education',
        'gender',
        'password',
        'email',
        'avatar_url',
        'collect_list',
        'favorite_invitation_list',
        'favorite_comment_list',
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
        'created_at' => 'timestamp',
    ];

    /**
     * Return a timestamp as unix timestamp.
     *
     * @param  mixed  $value
     * @return int
     */
    protected function asTimestamp($value)
    {
        return $this->asDateTime($value)->getTimestamp() * 1000;
    }

    public function practice()
    {
        return $this->hasOne('App\Models\Practice', 'user_id', 'user_id');
    }

    public function highestScore($node_group_id, $practice_mode, $practice_mode_index)
    {
        return $this->hasMany(HighestScore::class, "user_id", 'user_id')->where([
            ['note_group_index', $node_group_id],
            ['practice_mode', $practice_mode],
            ['practice_mode_index', $practice_mode_index],
        ])->first();
    }

    public function errorNotes()
    {
        return $this->hasOne('App\Models\ErrorNotes', 'user_id', 'user_id');
    }

    public function invitativones()
    {
        return $this->hasMany(Invitation::class, "user_id", 'user_id');
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }

    public function followingsInvitativon()
    {
        $user_ids = $this->followings->pluck('user_id')->toArray();
        return Invitation::whereIn('user_id', $user_ids)
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    //获取粉丝
    public function followers()
    {
        return $this->belongsToMany(User::class, 't_followers', 'follower_id', 'user_id');
    }

    //获取关注的好友
    public function followings()
    {
        return $this->belongsToMany(User::class, 't_followers', 'user_id', 'follower_id');
    }

    public function follow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function scopeOrderByID($query, $order)
    {
        // 按照创建时间排序
        return $query->orderBy('user_id', $order);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case '+id':
                $query->orderByID('asc');
                break;
            case '-id':
                $query->orderByID('desc');
                break;
        }
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
