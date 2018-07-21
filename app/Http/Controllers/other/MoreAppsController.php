<?php

namespace App\Http\Controllers\other;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\models\MoreApps;

class MoreAppsController extends ApiController
{

    public function list(){
        $apps=MoreApps::all();
        return $this->successResponse($apps);
    }    
}
