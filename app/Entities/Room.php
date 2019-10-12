<?php

namespace App\Entities;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;



class Room extends Authenticatable
{
    use Notifiable;
    //use SofDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $timestamps=true;

    protected $fillable = [
        'room_identification'
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
