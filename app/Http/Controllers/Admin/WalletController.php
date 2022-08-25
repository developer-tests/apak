<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class WalletController extends Controller
{

    public function index(Request $request)
    {
        $wallet =  Wallet::with('user')->get();
        if ($request->ajax()){
            return DataTables::of($wallet)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return ($row->user)?$row->user->name:'';
                })
                ->addColumn('wallet', function($row){
                    return number_format((float)$row->amount, 2, '.', '');
                })
                ->addColumn('description', function($row){
                    return $row->description;
                })
                
                ->editColumn('date', function($row){
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                // ->addColumn('action', function($row){
                //     return '<a class="btn btn-sm btn-info" href="'.route('wallet.edit',$row->id).'">show</a>
                //     <a class="btn btn-sm btn-success" href="'.route('wallet.delete',$row->id).'">Accept</a>';
                // })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.wallet.index');

    }


    public function create()
    {
        $users = User::where('role_id','!=','1')->get();
        return view('admin.wallet.user_wallet_update',compact('users'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users' => 'required',
            'transaction_type'=> 'required',
            'amount'=>'required',

        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $wallet = Wallet::where('user_id',$request->users)->first();
        $prev_amount= $wallet?$wallet->amount:0;
        if($request->transaction_type=='Credit'){
            $amount = $request->amount+$prev_amount;
        }else{
            $amount = $request->amount -$prev_amount;
        }

        if ($wallet){
            $wallet->update(
                [
                    'amount' => $amount,
                    'description' => $request->remark,
                ]
            );
        }else{
            Wallet::create(
                [
                    'user_id' => $request->users,
                    'amount' => $amount,
                    'description' => $request->remark,
                    'status'=> 1,

                ]
            );
        }
         WalletHistory::create([
            'user_id' => $request->users,
            'type' => $request->transaction_type,
            'amount' => $request->amount,
            'description' => $request->remark,
            'wallet_id' => 2,
        ]);


        return redirect()->back()->with('status','Wallet Update successfully');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
