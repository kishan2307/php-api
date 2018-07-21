<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MoreApps extends Model
{
    protected $casts = [
        "status" => "boolean",
    ];

    protected $fillable = [
        'name',        
        'desc',
        'status',
        'link'      
    ];

    protected $hidden = [
        'id'              
    ];
}
