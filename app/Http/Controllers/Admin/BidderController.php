<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Bidder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Redirect;
use Yajra\DataTables\Facades\DataTables;

class BidderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    /*public function index()
    {
        $id = Auth::user()->id;
        $bidder = Bidder::all();
        return view('admin.bidder.index')->with('bidder', $bidder);
    }*/

    public function index(Request $request)
    {
        $bidder =  Bidder::orderBy('id','desc')->get();
        if ($request->ajax()){
            return DataTables::of($bidder)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return $row->firstname.' '.$row->lastname;
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function($row){
                    return $this->action($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.bidder.index')->with('bidder', $bidder);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',

        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = Auth::user()->id;

        $data = bidder::where('bidder_id', $id)->get();

        if (count($data) > 0) {

            $bidder = bidder::find($data[0]->id);

            $bidder->name = $request->display_name;
            $bidder->address_1 = $request->address;
            $bidder->lattitude = $request->lattitude;
            $bidder->longitude = $request->longitude;
            $bidder->email = $request->contact_email;
            $bidder->contact = $request->contact_number;
            $bidder->save();

        } else {
            $bidder = new Bidder();

            $bidder->name = $request->display_name;
            $bidder->address_1 = $request->address;
            $bidder->lattitude = $request->lattitude;
            $bidder->longitude = $request->longitude;
            $bidder->email = $request->contact_email;
            $bidder->contact = $request->contact_number;
            $bidder->save();
        }

        return redirect('admin/bidder_profile')->with('status', 'Details saved successfully!!!');
    }

    public function editer(Request $request, $id)
    {
        /*$validator = Validator::make($request->all(), [
            'firstname' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }*/
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            //'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal' => 'required',
            'phone1' => 'required',
            'email' => 'required|email|confirmed',
        ], [

            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            // 'country.required' => 'Country is required.',
            'address.required' => 'Address is required.',
            'city.required' => 'City is required.',
            'state.required' => 'State is required.',
            'postal.required' => 'Postal code is required.',
            'phone1.required' => 'Phone1 is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $bidder = bidder::find($id);

            $bidder->company = $request['company_name'];
            $bidder->firstname = $request['firstname'];
            $bidder->lastname = $request['lastname'];
            $bidder->email = $request['email'];
            $bidder->country = $request['country'];
            $bidder->state = $request['state'];
            $bidder->city = $request['city'];
            $bidder->postal_code = $request['postal'];
            $bidder->phone1 = $request['phone1'];
            $bidder->phone2 = $request['phone2'];
            $bidder->fax = $request['fax'];
            $bidder->save();

        return redirect('admin/bidder')->with('status', 'Saved successfully');
        //return redirect('bidder.index')->with('status', 'Details saved successfully!!!');
    }


    public function viewAll()
    {
        $bidder = bidder::all();
        return view('admin.bidder.index')->with('bidder', $bidder);
    }


    public function editbidder($id)
    {
        $bidder = bidder::find($id);

        return view('admin.bidder.edit')->with('bidder', $bidder);
    }

    public function create()
    {
        $role = Role::all();
        return view('admin.bidder.create',compact('role'));
    }

    public function save(Request $request)
    {

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

        $bidder = new User();
        $bidder->name = $request->name;
        $bidder->email = $request->email;
        $bidder->role_id = $request->role;
        $bidder->password = Hash::make($request->password);
        $bidder->save();
        return redirect('admin/bidder')->with('status', 'saved successfully');
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:bidders,email,' . $id,
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $bidder = bidder::find($id);

        $bidder->name = $request->name;
        $bidder->email = $request->email;
        $bidder->contact = $request->contact;
        $bidder->address1 = $request->address1;
        $bidder->address2 = $request->address2;
        $bidder->longitude = $request->longitude;
        $bidder->lattitude = $request->lattitude;
        $bidder->updated_at = now();
        $bidder->save();
        return redirect('admin/bidder')->with('status', 'Saved successfully');
    }

    function delete($id)
    {
        $bidder = bidder::find($id);
        if (is_null($bidder)) {
            return Redirect::back()->with('status', 'No bidder found');
        }

        $bidder->delete();
        return Redirect::back()->with('status', 'Deleted successfully');

    }

    public function action($row)
    {
        return ' <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="'.route('bidder.editbidder', $row->id).'">Edit</a>
                        <a class="dropdown-item"
                           href="'.route('bidder.delete', $row->id).'">Delete</a>
                    </div>
                </div>';
    }


}
