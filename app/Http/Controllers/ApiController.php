<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Traits\BalanceUpdate;

class ApiController extends Controller 
{
    use ApiResponser;
    use BalanceUpdate;
}  