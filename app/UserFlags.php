<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFlags extends Model
{

    public const DAILY_CHCK_IN = 'daily_check_in';
    public const APP_INSTALL = 'app_install_verify';
    public const PARENT_CODE = 'parent_code_verify';
    public const QUIZ = 'quiz';
    public const STATUS = 'status';
    public const MEMORY_QUIZ = 'memory_quiz';
    public const RED_OFFER = 'redoffer';
    public const SPIN = 'spin';
    public const SPECIAL_OFFER = 'specail_offer';

    protected $fillable = [
        'user_id',
        UserFlags::DAILY_CHCK_IN,
        UserFlags::APP_INSTALL, 
        UserFlags::PARENT_CODE,
        UserFlags::QUIZ,
        UserFlags::STATUS, 
        UserFlags::MEMORY_QUIZ,
        UserFlags::SPIN    
    ];

    protected $casts = [
        UserFlags::DAILY_CHCK_IN => "boolean",
        UserFlags::APP_INSTALL => "boolean",
        UserFlags::PARENT_CODE => "boolean",
        UserFlags::STATUS => "boolean",
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at'    
    ];

}
