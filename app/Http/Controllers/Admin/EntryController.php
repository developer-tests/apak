<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntryAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EntryController extends Controller
{

   public function index(){
      $gt = EntryAmount::all();
      $amount = '';
      if(count($gt)>0){
         $amount = $gt[0]->amount;
      }

      return view('admin.entry.index',compact('amount'));
   }

   public function save(Request $request){
      $gt = EntryAmount::all();

      if(count($gt)>0){
         EntryAmount::where('id',$gt[0]->id)->delete();
      }
      EntryAmount::create(['amount'=>$request->amount]);
      return redirect()->back()->with('success','Amount Updated.');
   }
}