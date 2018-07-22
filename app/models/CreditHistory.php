<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    protected $fillable = ['user_id','point','type'];

    protected $hidden = [
        'id',
        'user_id',
        'updated_at'        
    ];
}
