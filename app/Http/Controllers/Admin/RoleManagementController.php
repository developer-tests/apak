<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
class RoleManagementController extends Controller
{
    //
    function index(){
        $roles = Role::all();
        return view('admin.roles.index')->with('roles', $roles);
    }

    function create(){
        return view('admin.roles.create');
    }

    function edit($id){
        $roles = Role::find($id);
       
        return view('admin.roles.edit')->with('role', $roles);
    }

    public function save(Request $request){
        
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles',
        ]);

        if ($validator->fails()) {
            return redirect('admin/role/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = new Role;
        $role->role_name = $request->role_name;
        $role->permissions = json_encode($request->permissions);
        $role->save();
        return redirect('admin/role')->with('status','saved successfully');
    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,role_name,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect('admin/role/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = Role::find($id);
        $role->role_name = $request->role_name;
        if(!empty($request->permissions)){
            $role->permissions = json_encode($request->permissions);
        }
        
        $role->save();
        return redirect('admin/role')->with('status','Saved successfully');
    }
}
