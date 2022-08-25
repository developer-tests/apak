<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use App\Models\PartnersLogo;
use Illuminate\Support\Facades\Validator;


class PartnersLogoController extends Controller
{
    function __construct(){

        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            if($this->user->role_id !=1){
               
                return abort(404);
            }
            return $next($request);
        });

    }
    public function index()
    {
        $data =  PartnersLogo::all();
        return view('admin.partners_logo.index')->with('data', $data);
    }

    public function edit($id){
        $data  = PartnersLogo::find($id);
      
        return view('admin.partners_logo.edit')->with('data', $data);
    }
    public function create(){
      
        return view('admin.partners_logo.create');
    }

    public function save(Request $request){
        
        $validator = Validator::make($request->all(), [
            'logo_title' => 'required',
            'logo_image' => 'required|file|mimes:jpeg,bmp,png|max:2048',
            'logo_link' => 'nullable|url'
           
        ]);
       
        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
       
        $partnerslogo = new PartnersLogo();

        $partnerslogo->logo_title = $request->logo_title;
        if(isset($request->status) && $request->status != ""){
            $partnerslogo->status = $request->status;
        }
        if($request->hasfile('logo_image'))
         {
                $file = $request->file('logo_image');
                $name = rand(100,700).time().'.'.$file->extension();
               
                $res = $file->move(public_path().'/partnerlogos/', $name);  
                if($res){
                    $partnerslogo->logo_image_name=$name;
                }else{
                    return Redirect::back()
                    ->with('status','Error while uploading.')
                    ->withInput();
                }
            
         }
       
        $partnerslogo->logo_link = $request->logo_link;
        $partnerslogo->save();
        return redirect('admin/partnerslogo')->with('status','saved successfully');
    }

    public function update(Request $request, $id){
        
            
        $validator = Validator::make($request->all(), [
            'logo_title' => 'required',
            'logo_image' => 'nullable|file|mimes:jpeg,bmp,png|max:2048',
            'logo_link' => 'nullable|url'
           
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $partnerslogo = PartnersLogo::find($id);

        $partnerslogo->logo_title = $request->logo_title;
        if(isset($request->status) && $request->status != ""){
            $partnerslogo->status = $request->status;
        }
        if($request->hasfile('logo_image'))
         {
                $file = $request->file('logo_image');
                $name = rand(100,700).time().'.'.$file->extension();
                $res = $file->move(public_path().'/partnerlogos/', $name);
                if($res){
                    @unlink(public_path().'/partnerlogos/'.$partnerslogo->logo_image_name);
                    $partnerslogo->logo_image_name=$name;
                    
                }else{
                    return Redirect::back()
                    ->withErrors('Error while uploading.')
                    ->withInput();
                }
                
            
         }
       
        $partnerslogo->logo_link = $request->logo_link;
        $partnerslogo->save();
        return redirect('admin/partnerslogo')->with('status','saved successfully');
    }

    function delete($id){
        $partnerslogo = PartnersLogo::find($id);
      
        if(is_null($partnerslogo)){
            return Redirect::back()->with('status','No record found');
        }
        $imagename = $partnerslogo->logo_image_name;
        $partnerslogo->delete();
        
        @unlink(public_path().'/partnerlogos/'.$imagename);
        return Redirect::back()->with('status','Deleted successfully');

    }
}
