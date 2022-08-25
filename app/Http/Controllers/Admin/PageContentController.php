<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\ContentPage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PageContentController extends Controller
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
     * Show the apcation dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()

    {
        $data = ContentPage::paginate(2);

        return view('admin.page_content.index')->with('data', $data);

    }


    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'page_name' => 'required',
            'page_title' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $data = $request->all();
        $content = new ContentPage();
        $content->page_name = $request->page_name;
        $content->active = $request->status;
        $content->page_title = $request->page_title;
        $content->page_description = $request->page_description;
        $content->meta_title = $request->meta_title;
        $content->meta_description = $request->meta_description;
        $content->page_slug = createSlug($request->page_title, 'ContentPage', 'page_slug');
        $content->save();

        return redirect('admin/pagecontent')->with('status', 'saved successfully');
    }


    public function create()
    {
        return view('admin.page_content.create');
    }


    public function edit(Request $request, $id)
    {
        $pagecontent = ContentPage::find($id);
        $contentPage = $pagecontent;
        if (!$pagecontent) {
            abort(404);
        }
        return view('admin.page_content.edit', compact('contentPage'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'page_name' => 'required',
            'page_title' => 'required',
            'page_description' => 'min:100|max:99999999',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $content = ContentPage::find($id);

        if (is_null($content)) {
            return back();
        }
        $content->page_name = $request->page_name;
        $content->active = $request->status;
        $content->page_title = $request->page_title;
        $content->page_description = $request->page_description;
        $content->meta_title = $request->meta_title;
        $content->meta_description = $request->meta_description;
        $content->page_slug = createSlug($request->page_title, 'ContentPage', 'page_slug');
        $content->save();
        return back()->with('success', 'Updated successfully');
    }


    public function delete(Request $request, $id)
    {
        // return 'done';
        ContentPage::where('id', $id)->delete();
        return Redirect::back()->with('status', 'Deleted succesfully');


    }


} 
