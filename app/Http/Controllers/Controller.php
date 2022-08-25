<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function create_wallet($user_id,$type,$amount,$description=null)
    {

        $total_amount = total_amount($user_id,$type,$amount);
        $wallet = $this->update_wallet($user_id,$total_amount);
        $wallet_history = WalletHistory::where('user_id',$user_id)->latest()->first();
        if ($wallet_history){
            $wallet_history->update([
                'wallet_id'=>$wallet->id,
                'type'=>$type,
                'amount'=>$amount,
                'description'=>$wallet->id,
            ]);
        }else{
            $wallet_history = WalletHistory::create([
                'user_id'=>$user_id,
                'wallet_id'=>$wallet->id,
                'type'=>$type,
                'amount'=>$amount,
                'description'=>$wallet->id,
            ]);
        }

        return $wallet_history;
    }

    public function update_wallet($user_id,$amount)
    {
        $wallet = Wallet::where('user_id',$user_id)->first();
        if ($wallet){
            // amount is coin amount
            $wallet->update(['amount'=>$amount]);
        }else{
            $wallet = Wallet::create(['user_id'=>$user_id,'amount'=>$amount]);
        }
        return $wallet;
    }
}
