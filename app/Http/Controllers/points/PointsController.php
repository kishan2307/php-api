<?php

namespace App\Http\Controllers\points;

use App\Balance;
use App\UserFlags;
use Illuminate\Http\Request;
use App\models\CreditHistory;
use App\models\RedeemRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class PointsController extends ApiController
{
    public function add(Request $request){
      $this->validate($request, ['type' => 'bail|required','point'=>'bail|required|integer']);

  DB::beginTransaction();
    try{    
      
      $flags=UserFlags::where('user_id',$request->uid)->first();
      
      switch (strtolower($request->type)) {
        case 'dailycheckin':
            if($flags[UserFlags::DAILY_CHCK_IN]){
              return $this->errorResponse('Daily chck in is already done for the tody.');    
            }
            $flags[UserFlags::DAILY_CHCK_IN]=true;            
          break;
        case 'appinstall':
            if($flags[UserFlags::APP_INSTALL]){
              return $this->errorResponse('app install is already done.');    
            }
            $flags[UserFlags::APP_INSTALL]=true;            
            break;
         case 'quiz':
         $flags[UserFlags::QUIZ]=$flags[UserFlags::QUIZ] + 1;
         break;
         case 'spin':
         $flags[UserFlags::SPIN]=$flags[UserFlags::SPIN] + 1;
         break;
         case 'memory_quiz':
         $flags[UserFlags::MEMORY_QUIZ]=$flags[UserFlags::MEMORY_QUIZ] + 1;
         break; 
        default:
          return $this->errorResponse('invalid type::'.$request->type);
          break;
      }  

        $flags->save();
        $bl= $this->addBalance($request->uid,$request->point);
        CreditHistory::create(array(
          'user_id'=>$request->uid,
          'point'=>$request->point,
          'type'=>$request->type
        ));      
        DB::commit();
        return $this->successResponse(array('balance'=>$bl,'flags'=>$flags));
      } catch (\Exception $e) {
        DB::rollback();      
     }
     return $this->errorResponse('intrnal server error, plaese try again.');  
    }    

    public function redeem(Request $request){
        $this->validate($request, ['type' => 'bail|required','point'=>'bail|required|integer','number'=>'bail|required']);

        $bl = Balance::where('user_id', $request->uid)->first();

        if (isset($bl)) {
          if($bl->net_balance<$request->point){
            return $this->errorResponse('insufficient balance.'); 
          }      

          DB::beginTransaction();

          try {                     
            $bl->net_balance-=$request->point;
            $bl->reedem_balance+=$request->point;
            $bl->save();

            RedeemRequest::create(array(
              'user_id'=>$request->uid,
              'point'=>$request->point,   
              'number'=>$request->number                         
            ));

            DB::commit();

            return $this->successResponse($bl);

          } catch (\Exception $e) {
            DB::rollback();      
         }
        }     
        return $this->errorResponse('Please try again, Redeem request Fail.');                   
    }    

    public function history(Request $request){      
      $his=RedeemRequest::where('user_id', $request->uid)->latest()->take(10)->get();

      if(isset($his) && count($his)==0){
        return $this->errorResponse('There is no redeem history availabe.');                   
      }

      return $this->successResponse($his);
  }    

  public function balanceHistory(Request $request){
    $his=CreditHistory::where('user_id', $request->uid)->latest()->take(15)->get();    

      if(isset($his) && count($his)==0){
        return $this->errorResponse('Credit history is not availabe.');                   
      }

      return $this->successResponse($his);
  }


}
