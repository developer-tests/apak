<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuctionRegister;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AuctionRegisterController extends Controller
{

    public function index(Request $request)
    {
        $auction =  AuctionRegister::all();
        if ($request->ajax()){
            return DataTables::of($auction)
                ->addIndexColumn()
                ->addColumn('user', function($row){
                    return $row->user?$row->user->name:'';
                })
                ->addColumn('auction', function($row){
                    return $row->auction?$row->auction->title:'';
                })
                ->addColumn('item', function($row){
                    return $row->item?$row->item->title:'';
                })
                ->editColumn('status', function($row){
                    $data = '<span class="badge badge-primary">Pending</span>';
                    if ($row->status == 1)
                    {
                        $data = '<span class="badge badge-success">Accept</span>';
                    }
                    if ($row->status == 2)
                    {
                        $data = '<span class="badge badge-danger">Reject</span>';
                    }
                    return $data;
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function($row){
                    return $this->action($row);
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.auction_register.index');
    }

    public function accept(AuctionRegister $auctionRegister)
    {
        $item = $auctionRegister->item;
        $auction = $auctionRegister->auction;
        $auctionRegister->update(['status'=>1,'reason'=>null]);
        $status = '';
        if ($item && $auction){
            $this->send_mail(Auth::user()->email,$auction->title,$item->title,'Accept',null);
            $status = '! Mail sent successfully';
        }
        return Redirect::back()->with('success','Auction Bid Accept Successfully '.$status);
    }

    public function reject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error',$validator->messages()->first());
        }
        $auctionRegister = AuctionRegister::findOrFail($request->id);
        $item = $auctionRegister->item;
        $auction = $auctionRegister->auction;
        $status = '';
        if ($item && $auction){
            $this->send_mail(Auth::user()->email,$auction->title,$item->title,'Reject',$request->reason);
            $status = '! Mail sent successfully';
        }
        $auctionRegister->update(['status'=>2,'reason'=>$request->reason]);
        return Redirect::back()->with('success','Auction Bid Reject Successfully '.$status);
    }

    public function show(AuctionRegister $auctionRegister)
    {
       return view('admin.auction_register.show',compact('auctionRegister'));
    }

    public function send_mail($email,$title,$item_title,$status,$reason=null)
    {
        $details = [
            'subject'=>'Bid status update',
            'title'=>$title,
            'item_title'=>$item_title,
            'status'=>$status,
            'reason'=>$reason,
            ];

        Mail::to($email)->send(new \App\Mail\AuctionRegisterStatus($details));
    }

    public function action($row)
    {
        if ($row->status ==0)
        {
            $status = '<a class="btn btn-sm btn-success" href="'.route('auction.register.accept',$row).'">Accept</a> 
                        <button type="button" class="btn btn-sm btn-danger reject_auction_register" 
                        data-user-id="'.$row->user_id.'" data-id="'.$row->id.'" data-toggle="modal" data-target="#reject">Reject</button>';
        }
        if ($row->status ==1)
        {
            $status = '
                        <button type="button" class="btn btn-sm btn-danger reject_auction_register" data-toggle="modal" 
                        data-user-id="'.$row->user_id.'" data-id="'.$row->id.'" data-target="#reject">Reject</button>';
        }
        if ($row->status ==2)
        {
            $status = '<a class="btn btn-sm btn-success" href="'.route('auction.register.accept',$row).'">Accept</a>';
        }
        $data =  '<a class="btn btn-sm btn-info" href="'.route('auction.register.show',$row).'">show</a>'.$status;

        return $data;
    }

}
