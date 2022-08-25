<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Seller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Validator;
use Auth;
class SettingsController extends Controller
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
    public function index()
    {
       
    
        return view('admin.site_settings.index')->with('data', getSiteSetting());
    }

   /*public function save(Request $request){
    $validator = Validator::make($request->all(), [
        'address' => 'required',
      
    ]);

    if ($validator->fails()) {
        return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
    }
    
    $id = Auth::user()->id;

    $data = Seller::where('seller_id', $id)->get();

    if(count($data) > 0){

        $seller = Seller::find($data[0]->id);

        $seller->name = $request->display_name;
        $seller->address_1 = $request->address;
        $seller->lattitude = $request->lattitude;
        $seller->longitude = $request->longitude;
        $seller->email = $request->contact_email;
        $seller->contact = $request->contact_number;
        $seller->save();

    }else{
        $seller = new Seller();

        $seller->name = $request->display_name;
        $seller->address_1 = $request->address;
        $seller->lattitude = $request->lattitude;
        $seller->longitude = $request->longitude;
        $seller->email = $request->contact_email;
        $seller->contact = $request->contact_number;
        $seller->save();
    }

    return redirect('admin/seller_profile')->with('status', 'Details saved successfully!!!');
}*/

function save(Request $request)
{

 $validator = Validator::make($request->all(), [
        'site_name' => 'required',
      
    ]);

    if ($validator->fails()) {
        return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
    }

        $data = $request->all();

        if($request->hasfile('site_logo'))
         {
                $file = $request->file('site_logo');
                $name = rand(100,700).time().'.'.$file->extension();
                /*$request->validate([
              'site_logo' => 'image|size:max:500',
             ]);
               */
                $res = $file->move(public_path().'/siteimages/', $name);  
                if($res){
                    $data['site_logo'] = $name;
                }else{
                    return Redirect::back()
                    ->with('status','Error while uploading.')
                    ->withInput();
                }
            
         }



         if($request->hasfile('site_banner'))
         {
                $file = $request->file('site_banner');
                $name = rand(100,700).time().'.'.$file->extension();
                /*$request->validate([
                 'site_banner' => 'image|size:1024',
                ]);
                    */
                $res = $file->move(public_path().'/siteimages/', $name);  
                if($res){
                    $data['site_banner'] = $name;
                }else{
                    return Redirect::back()
                    ->with('status','Error while uploading.')
                    ->withInput();
                }
            
         }

        unset($data['_token']);

         foreach($data  as $key=>$d){

            $settingData = SiteSetting::where('meta_key', $key)->first();
             if(is_null($settingData)) {
            $setting = new SiteSetting();
            $setting->meta_key = $key;
            $setting->meta_value = $d;
            $setting->save();
        } else{
               
             $setting = SiteSetting::find($settingData->id);
             $setting->meta_value = $d;
             $setting->save();
        } 
            
         }


         return redirect('admin/site_settings')->with('status','saved successfully');


}
    
}
