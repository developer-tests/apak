<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $fillable =['user_id','wallet_id','type','amount','description'];
    
}
