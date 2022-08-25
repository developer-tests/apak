<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    //
    function index(){
    	if(Auth::user()){
    		return redirect('admin/dashboard');	
    	}
        return view('auth.admin_login');
    }
}
