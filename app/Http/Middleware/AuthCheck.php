<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\models\Tokens;

class AuthCheck
{
    use ApiResponser;
    use ValidatesRequests;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->validate($request,[
        'uid'=>'bail|required',
        'token'=>'bail|required'
        ]); 

        if(!Tokens::where('user_id', $request->uid)->where('token',$request->token)->exists()){
           return $this->errorResponse('Invalid uid OR token');
        }
        
        return $next($request);
    }
}
