<?php

namespace App\Http\Controllers\support;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\models\Support;
use App\User;

class SupportController extends ApiController
{
    public function create(Request $request){

        $this->validateRequest($request);

        $data = $request->all();
        $data['user_id']=$request->uid;
        
        $support = Support::create($data);

        return $this->successResponse($support);
    }

    public function history(Request $request){
        $this->validate($request, ['uid' => 'required','token' => 'required',]);

        $comments = User::find($request->uid)->support->take(10);
        return $this->successResponse($comments);
    }

    private function validateRequest(Request $request)
    {
        $this->validate($request, ['uid' => 'required','subject' => 'required','desc' => 'required','token' => 'required']);
    }
}


