<?php

namespace App\Http\Controllers;

use App\UserFlags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
    public function run(){
        DB::table('user_flags')->update([
            UserFlags::DAILY_CHCK_IN => 0,
            UserFlags::APP_INSTALL=>0,            
            UserFlags::QUIZ=>0,
            UserFlags::SPIN=>0,
            UserFlags::STATUS=>0,
            UserFlags::RED_OFFER=>0,      
            UserFlags::SPECIAL_OFFER=>0,      
            UserFlags::MEMORY_QUIZ=>0     
            ]);

        return "success";
    }
}
