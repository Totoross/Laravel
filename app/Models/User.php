<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //获取gravatar头像
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //发送定制重置密码邮件
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**指明一个用户拥有多条微博 返回该用户所有动态。
     * @return array
     */
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    /**该方法将当前用户发布过的所有微博从数据库中取出，并根据创建时间来倒序排序。
     * 将使用该方法来获取当前用户关注的人发布过的所有微博动态
     * @return array
     */
    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

}
