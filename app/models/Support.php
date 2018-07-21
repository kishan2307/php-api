<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'desc',
        'status'      
    ];

    protected $hidden = [
        'id',
        'user_id'        
    ];

    protected $casts = [
        "status" => "boolean",
    ];
}
