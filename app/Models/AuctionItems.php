<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionItems extends Model
{
    protected $guarded = [];
    protected $with=['bidds'];
    public function bidds()
    {
        return $this->hasMany(BiddingItem::class,'item_id','id');
    }
    public function auction()
    {
        return $this->belongsTo(Auction::class,'auctionid','id');
    }
    public function watchlists(){

        return $this->belongsTo(Watchlist::class,'item_id','id');
    }
    
}
