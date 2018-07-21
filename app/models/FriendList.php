<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    protected $fillable = [
        'user_id',        
        'friend_id'              
    ];

    protected $hidden = [
        'id' ,
        'created_at',
        'updated_at'             
    ];
}
