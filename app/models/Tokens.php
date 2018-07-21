<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'token',            
    ];

    protected $hidden = [
        'id',
        'user_id'        
    ];
}
