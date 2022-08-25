<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    public function items()
    {
        return $this->hasMany(AuctionItems::class,'auctionid','id');
    }

    public function image()
    {
        return $this->belongsTo(AuctionImage::class,'id','auction_id')
            ->where('auction_image_cat','auction')->latest();
    }

    public function images()
    {
        return $this->hasMany(AuctionImage::class,'auction_id','id')->where('auction_image_cat','auction');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'sellerid','id');
    }


    public function watchlists()
    {
        return $this->belongsToMany(AuctionItems::class, 'watchlists', 'auction_id', 'item_id');
    }
}
