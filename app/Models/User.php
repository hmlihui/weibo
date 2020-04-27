<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->activation_token = str::random(10);
        });
    }
    /**
     * [statuses 一个用户关联多条微博]
     * @Author   larry1.li
     * @DateTime 2020-04-27T13:40:42+0800
     * @return   [type]                   [description]
     */
     public function statuses()
    {
        return $this->hasMany(Status::class);
    }   

    /**
     * [feed 微博列表]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:17:30+0800
     * @return   [type]                   [description]
     */
    public function feed()
    {
        $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        return Status::whereIn('user_id', $user_ids)
                              ->with('user')
                              ->orderBy('created_at', 'desc');
    }
    /**
     * [followers 获取用户粉丝]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:50:05+0800
     * @return   [type]                   [description]
     */
     public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }
    /**
     * [followings 获取用户关注的人]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:50:33+0800
     * @return   [type]                   [description]
     */
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * [follow 关注]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:57:16+0800
     * @param    [type]                   $user_ids [description]
     * @return   [type]                             [description]
     */
     public function follow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }
    /**
     * [unfollow 取消关注]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:57:27+0800
     * @param    [type]                   $user_ids [description]
     * @return   [type]                             [description]
     */
    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    /**
     * [isFollowing 判断用户A是否包含在用户B中]
     * @Author   larry1.li
     * @DateTime 2020-04-27T15:58:39+0800
     * @param    [type]                   $user_id [description]
     * @return   boolean                           [description]
     */
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
