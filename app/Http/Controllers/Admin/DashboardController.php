<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Auth;
class DashboardController extends Controller
{
    //
    public function index()
    {


    	if(Auth::user()->role_id == Role::SELLER_ROLE_ID){

 				return redirect('admin/seller_profile');
    	}
        return view('admin.dashboard');
        
    }


}
