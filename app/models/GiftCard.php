<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable = ['name','points','type','status','order'];

    protected $hidden = [
        'id'              
    ];

    protected $casts = [
        "status" => "boolean",
    ];
}
