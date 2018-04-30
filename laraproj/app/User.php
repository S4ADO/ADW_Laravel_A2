<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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


    //Sets the user's avatar string to the name of the uploaded avatar
    public static function setImage($userid, $picName)
    {
        $user = User::find($userid);
        $user->avatar = $picName;
        $user->save();
    }

    //Deletes the reference to the user's avatar
    public static function deleteImage($userid)
    {
        $user = User::find($userid);
        $picName = $user->avatar;
        $user->avatar = "";
        $user->save();
        return $picName;
    }
}
