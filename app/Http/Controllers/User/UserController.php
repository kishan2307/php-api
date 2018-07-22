<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Balance;
use App\Commons;
use App\UserFlags;
use App\models\Tokens;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;


class UserController extends ApiController
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            $this->valid($request);
            return $this->create($request);
        } else {
            return $this->update($request, $user);
        }
    }

    private function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['uniq_id'] = Str::random(6);
            $token =  Str::random(5).'-'.Str::random(5).'-'.Str::random(5);
            $data['login_at'] = date('Y-m-d H:i:s');

            $user = User::create($data);
            $user->token=$token;
            $flag = UserFlags::create(array('user_id' => $user->id));
            $bal = Balance::create(array('user_id' => $user->id));
            Tokens::create(array('user_id' => $user->id, 'token' => $token));
            
            DB::commit();

            return $this->successResponse(array(
                'user' => $user,
                'common' => $this->getCommonParam(),
                'flags' => $flag->first(),
                'balance' => $bal->first()
            ));
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
           return $this->errorResponse('Please try again, User creation Fail.');
        }

        
    }

    private function update(Request $request, $user)
    {   
        $tokenstr = Str::random(5).'-'.Str::random(5).'-'.Str::random(5);        
        $user->token=$tokenstr;
        
        Tokens::where('user_id',$user->uid)->update(['token' => $tokenstr]);
                
        return $this->successResponse(array(
            'user' => $user,
            'common' => $this->getCommonParam(),
            'flags' => $this->getFlags($user->id),
            'balance' => User::find($user->id)->balance
        ));
    }

    private function getFlags($id)
    {
        return User::find($id)->flags;
    }

    private function getBelance($id)
    {
        return User::find($id)->balance;
    }

    private function valid(Request $request)
    {
        $rules = [
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'ip' => 'bail|required',
            'imei' => 'bail|required',
            'device' => 'bail|required|unique:users',
            'phone' => 'bail|nullable|numeric'
        ];

        $this->validate($request, $rules);
    }    
}
