<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Balance;

trait ApiResponser
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json(['status' => TRUE, 'code' => $code, 'data' => $data], $code);
    }

    protected function errorResponse($message, $code = 200)
    {
        return response()->json(['status' => FALSE, 'msg' => $message, 'code' => $code], $code);
    }         
}
