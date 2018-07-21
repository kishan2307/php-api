<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RedeemRequest extends Model
{

    protected $fillable = ['user_id','card_id','points','type','status','message'];

    protected $hidden = [
        'id',
        'user_id'        
    ];

    protected $casts = [
        "status" => "boolean",
    ];
}
