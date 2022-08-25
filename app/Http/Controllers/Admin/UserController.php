<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\Seller;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
Use Redirect;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    function __construct(){

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user->role_id !=1){
                //return abort(404);
                return redirect('/')->with('status', 'Sorry! you are not authourized to ceate auction.');
            }
            return $next($request);
        });

    }
    public function index(Request $request)
    {
        $user =  User::select('id','name','email','created_at')->where('id', '!=', '1')->orderBy('id','desc')->get();
        if ($request->ajax()){
            return DataTables::of($user)
                ->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('amount', function($row){
                    $balance = Wallet::where('user_id',$row->id)->pluck('amount')->first();
                    return '<b>'.$balance.'</b>';
                })
                ->addColumn('action', function($row){
                    return $this->action($row);
                })
                ->rawColumns(['amount','action'])
                ->make(true);
        }
        return view('admin.adminusers.index')->with('user', $user);
    }

    public function editUser($id){
        $user  = User::find($id);
        $role = Role::all();
        return view('admin.adminusers.edit')->with('user', $user)->with('role', $role);
    }
    public function create(){
        $role = Role::all();
        return view('admin.adminusers.create',compact('role'));
    }

    public function save(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10',
            'name' =>'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
    //dd($request->all());
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->role == "3"){
            $bidder = new Bidder();
            $bidder->firstname = $request->name;
            $bidder->email = $request->email;
            $bidder->user_id = $user->id;
            $bidder->save();
        }
        if ($request->role == "2"){
            $seller = new Seller();
            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->seller_id = $user->id;
            $seller->save();
        }

        return redirect('admin/user')->with('status','saved successfully');
    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6|max:10',
            'name' =>'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if ($request->role == "3"){
            $bidder = new Bidder();
            $bidder->firstname = $request->name;
            $bidder->email = $request->email;
            $bidder->user_id = $user->id;
            $bidder->save();
        }
        if ($request->role == "2"){
            $seller = new Seller();
            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->seller_id = $user->id;
            $seller->save();
        }
        return redirect('admin/user')->with('status','Saved successfully');
    }

    public function delete($id){
        $user = User::find($id);
        if(is_null($user)){
            return Redirect::back()->with('status','No user found');
        }

        $user->delete();
        return Redirect::back()->with('status','Deleted successfully');

    }

    public function action($row)
    {
        return ' <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="'.route('user.edit', $row->id).'">Edit</a>
                        <a class="dropdown-item"
                           href="'.route('user.delete', $row->id).'">Delete</a>
                    </div>
                </div>';
    }
}
