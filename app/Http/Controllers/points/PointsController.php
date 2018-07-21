<?php

namespace App\Http\Controllers\points;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PointsController extends ApiController
{
    public function add(Request $request){
        $this->validate($request, ['type' => 'bail|required','point'=>'bail|required|integer']);

      $bl= $this->addBalance($request->uid,$request->point);

      return $this->successResponse($bl);
    }

    public function redeem(Request $request){
        $this->validate($request, ['type' => 'bail|required','point'=>'bail|required|integer']);

      $bl= $this->redeemBalance($request->uid,$request->point);

      return $this->successResponse($bl);
    }    
}
