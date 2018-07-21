<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFlags extends Model
{
    //
    protected $fillable = [
        'user_id'      
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at'    
    ];

}
