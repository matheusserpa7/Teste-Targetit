<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Foundation\Auth\Scheduling as Authenticatable;

class Room extends Authenticatable
{
    use Notifiable;
    use SofDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $timestamps=true;

    protected $fillable = [
        'user_id','room_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
