<?php

use Carbon\Carbon;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

/**
 * Fetch General Settings set for whole site
 */
function createSlug($title, $b_model, $fieldname, $id = 0)
{

    // Normalize the title
    $slug = Str::slug($title, '-');

    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    $allSlugs = getRelatedSlugs($slug, $b_model, $fieldname, $id);


    // If we haven't used it before then we are all good.
    if (!$allSlugs->contains('slug', $slug)) {
        return $slug;
    }

    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
        $newSlug = $slug . '-' . $i;
        if (!$allSlugs->contains('slug', $newSlug)) {
            return $newSlug;
        }
    }


}

function getRelatedSlugs($slug, $b_model, $fieldname, $id = 0)
{

    $models = 'App\\Models\\' . $b_model;

    $ss = $models::select($fieldname)->where($fieldname, 'like', $slug . '%')
        ->where('id', '<>', $id)
        ->get();

    return $ss;
}

function getFieldValue($model, $fieldname, $value, $name)
{
    $models = 'App\\Models\\' . $model;
    $res = $models::where($fieldname, $value)->first();
    if (!is_null($res)) {
        return $res->$name;
    }

    return '--';

}

function getAuctionItemImage($limit = 0, $id)
{
    if ($limit > 1) {
        $auction_images = \App\Models\AuctionImage::where('auction_id', $id)->where('auction_image_cat', 'auction_item')->orderBy('id', 'desc')->take($limit)->get('image_name');
    } else {
        $auction_images = \App\Models\AuctionImage::where('auction_id', $id)->where('auction_image_cat', 'auction_item')->get('image_name');
    }
    return $auction_images;
}

function getTruncatedCCNumber($ccNum)
{
    return str_replace(range(0, 9), "*", substr($ccNum, 0, -4)) . substr($ccNum, -4);
}

function getCCImage($type = null)
{
    $data = '';
    $array = array(
        'American Express' => 'https://bidera.hibid.com/Styles/images/icons/cc-amex.png',
        'Visa' => 'https://bidera.hibid.com/Styles/images/icons/cc-visa.png',
        'Mastercard' => 'https://bidera.hibid.com/Styles/images/icons/cc-mastercard.png',
        'Discover' => 'https://bidera.hibid.com/Styles/images/icons/cc-discover.png'
    );
    if ($type) {
        $data = $array[$type];
    }
    return $data;
}

function fetchAuctionImage($id)
{
    $auction_images = \App\Models\AuctionImage::where('auction_id', $id)->where('auction_image_cat', 'auction')->orderBy('id', 'desc')->take(1)->get('image_name');
    return $auction_images;
}

function fetchItemsCategories($auction_id)
{
    $query = 'select categories.title, categories.id, count(auction_items.id) as item_count  from auction_items inner join categories on auction_items.categoryid = categories.id where auction_items.auctionid="' . $auction_id . '" group by auction_items.categoryid';
    $res = DB::select($query);
    return $res;
}

function fetchCatById($cat_id)
{


    $query = 'select title from categories where  id="' . $cat_id . '"';
    $res = DB::select($query);
    if (count($res) > 0) {
        return $res[0]->title;
    }
    return '';
}

function fetchAllItemsCategories()
{


    $query = 'select categories.title, categories.id, count(auction_items.id) as item_count  from auction_items inner join categories on auction_items.categoryid = categories.id group by auction_items.categoryid';
    $res = DB::select($query);
    return $res;
}

function imageResize($imageSrc, $imageWidth, $imageHeight, $newImageWidth, $newImageHeight)
{


    $newImageLayer = imagecreatetruecolor($newImageWidth, $newImageHeight);
    imagecopyresampled($newImageLayer, $imageSrc, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageWidth, $imageHeight);

    return $newImageLayer;
}

function getSellerDetailBySellerID($seller_id)
{
    $seller_details = \App\Models\Seller::where('seller_id', $seller_id)->first();
    return $seller_details;
}

function itemCount($auction_id)
{
    $query = \App\Models\AuctionItems::where('auctionid', $auction_id);
    $auction_items = $query->count();
    return $auction_items;
}

function getSiteSetting()
{
    $data = \App\Models\SiteSetting::all();
    $res = array();
    foreach ($data as $d) {
        $res[$d->meta_key] = $d->meta_value;
    }

    return $res;
}

function getBidTime($start_time, $end_time)
{
    $date = Carbon::parse($start_time);
    $now = Carbon::parse($end_time);

    return $date->diff($now)->format('%dd %Hh %im');
}

function getPaymentMethods()
{
    if (Auth::check()) {
        $payment_methods = PaymentMethod::where('user_id', auth()->user()->id)->get();
        return $payment_methods;
    }
    return [];
}

function paymentstatus($method,$type)
{
    $data = false;
    foreach ($method as $item){
        if ($item->pay_type == $type){
            $data = true;
        }
    }
    return $data;
}

function getInfopages()
{
    $res = App\Models\ContentPage::all();
    return $res;
}

function paymentMethod_by_id($id)
{
    $res = PaymentMethod::firstWhere('id', $id);
    return $res;
}

function userPaymentMethod($user_id)
{
    $res = PaymentMethod::where('user_id', $user_id)->get();
    return $res;
}

function user_auction_status($auction_id,$item_id)
{
    $auctions = false;
    if (Auth::check()){
       $auctions = \App\Models\AuctionRegister::where(['auction_id'=>$auction_id,'item_id'=>$item_id,'user_id'=>Auth::id()])->first();
    }
   return $auctions;
}
function item_bids($auction_id,$item_id)
{
    $auctions = \App\Models\AuctionRegister::where(['auction_id'=>$auction_id,'item_id'=>$item_id])->orderBy('id','desc')->get();
    return $auctions;
}
function user_bids($auction_id,$user_id)
{
    $auctions = \App\Models\AuctionRegister::where(['auction_id'=>$auction_id,'user_id'=>$user_id])->get();
    return $auctions;
}
function watched_by_user($auction_id,$item_id,$user_id)
{
    $data = \App\Models\Watchlist::where(['auction_id'=>$auction_id,'item_id'=>$item_id,'user_id'=>$user_id])->first();
    return $data;
}

function wallet_balance($user_id)
{
    $wallet = \App\Models\Wallet::where('user_id',$user_id)->first();
    if ($wallet){
        $amount = number_format((float)$wallet->amount, 2, '.', '');
    }else{
        $amount = 0;
    }
    return $amount;
}

function total_amount($user_id,$type,$amount)
{
    $total = $wallet_balance = wallet_balance($user_id);
    if ($type=='credit'){
        $total =  $wallet_balance + $amount;
    }
    if ($type=='debit'){
        $total =  $wallet_balance - $amount;
    }
    return $total;
}