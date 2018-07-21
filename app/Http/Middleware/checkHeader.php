<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\Traits\ApiResponser;

class checkHeader
{

    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

        if($request->headers->get('x-api-key')!='kishan'){  
            return $this->errorResponse('Invalid header');
        }
        
        return $next($request);
    }
}
