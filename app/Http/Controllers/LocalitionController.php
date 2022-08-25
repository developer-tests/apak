<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Auth;
class LocalitionController extends Controller
{
    //
    public function index($locale)
    {
        \App::setLocale($locale);
        \Session::put('locale', $locale);
       
        return redirect()->back();
    }


}
