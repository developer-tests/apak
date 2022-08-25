<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuctionRegister;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\AuctionItems;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WinnerController extends Controller
{

    public function index(Request $request)
    {
        // $auction =  AuctionRegister::where('status',1)->get();
        //new code for winner
        $auctions = Auction::where('auction_start_date', '<=', date('Y-m-d'))->where('auction_end_date', '<=', date('Y-m-d'))->with('items')->get();
        $auctionRegister = [];
        foreach($auctions as $auction){
            if(isset($auction->items) && (count($auction->items)>0)){
                foreach($auction->items as $item){
                    $dataAuction = AuctionRegister::where('item_id',$item->id)->orderBy('id','desc')->with('user')->first();
                    if($dataAuction){
                        $auctionRegister[] = $dataAuction;
                    }
                }
                
            }
        }
        
        if ($request->ajax()){
            return DataTables::of($auctionRegister)
                ->addIndexColumn()
                ->addColumn('user', function($row){
                    return $row->user?$row->user->name:'';
                })
                ->addColumn('auction', function($row){
                    return $row->auction?$row->auction->title:'';
                })
                ->addColumn('amount', function($row){
                    return $row->item_amount;
                })
                ->addColumn('item', function($row){
                    return $row->item?$row->item->title:'';
                })
                
               
               
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.auction_register.winner');
    }

  
}
