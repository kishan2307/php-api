<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Balance;

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
}
