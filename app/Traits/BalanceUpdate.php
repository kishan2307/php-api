<?php

namespace App\Traits;

use App\Balance;
use App\Commons;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

trait BalanceUpdate
{
    protected function addBalance($uid, $balnce)
    {
        $bl = Balance::where('user_id', $uid)->first();
        if (isset($bl)) {                            
            $bl->net_balance+=$balnce;
            $bl->total_balance+=$balnce;
            $bl->save();
        }

        return $bl;
    }

    protected function redeemBalance($uid, $balnce)
    {
        $bl = Balance::where('user_id', $uid)->first();
        if (isset($bl)) {                            
            $bl->net_balance-=$balnce;
            $bl->reedem_balance+=$balnce;
            $bl->save();
        }

        return $bl;
    }

    protected function getCommonParam(){            
        return $value = Cache::remember('common',5, function () {
             $common = Commons::all();
             return $this->getObj($common, '0');
         });        
     }
 
     private function getObj($arr, $type)
     {
         $temp = [];
         if (isset($arr) && count($arr) > 0) {
             foreach ($arr as $key => $value) {
                 if ($value->status == '1' && $value->type == $type) {
                     $temp[$value->name] = $value->value;
                 }
             }
         }
         return $temp;
     }
}
