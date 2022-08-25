<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Auth;
class DashboardController extends Controller
{
    //
    public function index()
    {
        if(Auth::user()){
            return view('admin.dashboard');
        }
        return redirect()->route('admin_login');
       
        
    }


}
