<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuctionRegister extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class,'auction_id','id');
    }
    public function item()
    {
        return $this->belongsTo(AuctionItems::class,'item_id','id');
    }
   
}
