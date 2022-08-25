<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    //
    function index(){
    	if(Auth::user()){
    		return redirect('dashboard');	
    	}
        return view('auth.admin_login');
    }
}
