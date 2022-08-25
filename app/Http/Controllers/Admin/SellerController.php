<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Seller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function edit($id)
    {
        //$id = Auth::user()->id;

        $user = User::findOrFail($id);
        return view('admin.sellers.edit_profile',compact('user'));
    }

    public function index()
    {
        $seller = User::where('role_id',2)->get();
        return view('admin.adminseller.index')->with('seller', $seller);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'display_name' => 'required',
            'contact_email' => 'required',

        ]);

        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $saller = Seller::where('seller_id', $id)->first();
        $user = User::where('id', $id)->first();
        $user->update([
            'name'=>$request->display_name,
            'email'=>$request->contact_email,
        ]);
        $saller->update([
            'name'=>$request->display_name,
            'email'=>$request->contact_email,
            'address_1'=>$request->address,
        ]);
        return Redirect::back()->with('status', 'Details saved successfully!!!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::back();
    }

     public function create()
    {
        
        return view('admin.adminseller.create');
    }


}
