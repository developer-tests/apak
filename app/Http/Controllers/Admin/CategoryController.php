<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    //
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
        $data =  Category::all();
        return view('admin.categories.index')->with('data', $data);
    }

    public function edit($id)
    {
        $data  = Category::find($id);
        $allc =  Category::all();
        return view('admin.categories.edit')->with('data', $data)->with('allcat', $allc);
    }
    public function create()
    {
        $allc =  Category::all();
        return view('admin.categories.create')->with('allcat', $allc);
    }

    public function save(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
           
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $cat = new Category();

        $cat->title = $request->title;
        $cat->parent_id = $request->parent;
       
        $cat->slug = createSlug($request->title, 'Category', 'slug');
        
        $cat->save();
        return redirect('admin/category')->with('status','saved successfully');
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
           
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $cat = Category::find($id);

        $cat->title = $request->title;
        $cat->parent_id = $request->parent;
       
        $cat->slug = createSlug($request->title, 'Category', 'slug',$id);
        
        $cat->save();
        return redirect('admin/category')->with('status','Saved successfully');
    }

    function delete($id){
        $cat = Category::find($id);
        if(is_null($cat)){
            return Redirect::back()->with('status','No record found');
        }

        $cat->delete();
        return Redirect::back()->with('status','Deleted successfully');

    }
}
