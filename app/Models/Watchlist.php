<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $guarded = [];
    public function auctions()
    {
        return $this->hasMany(Auction::class,'id','auction_id');
    }

    public function auctionItems()
    {
        return $this->hasMany(AuctionItems::class,'id','item_id');
    }
}
