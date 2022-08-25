<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AuctionImage;
use App\User;
use App\Models\Role;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\AuctionItems;

class AuctionController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role_id == Role::ADMIN_ROLE_ID) {
            //$auction = Auction::all();
            $auction = Auction::where('is_deleted', '=', '0')->get();
        } else {
            $auction = Auction::where('sellerid', Auth::user()->id)
                              ->where('is_deleted', '=', '0')->get();
        }
        return view('admin.auction.index')->with('data', $auction);
    }

    public function create()
    {
        if (Auth::user()->role_id == Role::SELLER_ROLE_ID) {
            return redirect('admin/auction')->with('status', 'Sorry! you are not authourized to ceate auction.');
        }
        $seller = User::where("role_id", Role::SELLER_ROLE_ID)->get();

        return view('admin.auction.create')->with('seller', $seller);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'auction_type' => 'required',
            'seller' => 'required',
            'auction_start_date' => 'required',
            'auction_end_date' => 'required',
            'auction_timezone' => 'required',
            'bidding_increment' => 'required',
            'auction_end_time' => 'required',
            'description' => 'required'

        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $auction = new Auction;


        $auction->title = $request->title;
        $auction->sellerid = $request->seller;
        $auction->description = $request->description;
        $auction->auction_start_date = date('Y-m-d', strtotime($request->auction_start_date));
        $auction->auction_end_date = date('Y-m-d H:i:s', strtotime("$request->auction_end_date $request->auction_end_time"));
        $auction->auction_timezone = $request->auction_timezone;
        $auction->preview_date_time = $request->preview_date_time;
        $auction->checkout_date_time = $request->checkout_date_time;
        $auction->payment_info = $request->payment_info;
        $auction->shipping_pickup = $request->shipping_pickup;
        $auction->bidding_notes = $request->bidding_notes;
        $auction->auction_notice = $request->auction_notice;
        $auction->bid_increment = $request->bidding_increment;
        $auction->auction_type = $request->auction_type;
        $auction->is_deleted = '0';
        $auction->slug = createSlug($request->title, 'Auction', 'slug');
        $auction->save();
        if ($request->hasfile('auction_images')) {
            foreach ($request->file('auction_images') as $file) {
                $name = rand(10, 100) . time() . '.' . $file->extension();
                if (!in_array($file->extension(), array('jpeg', 'bmp', 'png'))) {
                    continue;
                }
                if ($file->move(public_path() . '/auctions/', $name)) {

                    $image = new AuctionImage();
                    $image->auction_id = $auction->id;
                    $image->image_name = $name;
                    $image->auction_image_cat = 'auction';
                    $image->save();
                }
            }
        }

        return redirect('admin/auction')->with('status', 'saved successfully');

    }

    public function edit($id)
    {
        $auction = Auction::find($id);
        $images = AuctionImage::where('auction_id', $auction->id)->where('auction_image_cat', 'auction')->get();

        $seller = User::where("role_id", Role::SELLER_ROLE_ID)->get();
        return view('admin.auction.edit')->with('data', $auction)->with('images', $images)
            ->with('seller', $seller);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'auction_type' => 'required',
            'seller' => 'required',
            'auction_start_date' => 'required',
            'auction_end_date' => 'required',
            'auction_timezone' => 'required',
            'bidding_increment' => 'required',
            'description' => 'required'


        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $auction = Auction::find($id);

        $auction->title = $request->title;
        $auction->sellerid = $request->seller;
        $auction->description = $request->description;
        $auction->auction_start_date = date('Y-m-d', strtotime($request->auction_start_date));
        $auction->auction_end_date = date('Y-m-d', strtotime($request->auction_end_date));
        $auction->preview_date_time = $request->preview_date_time;
        $auction->checkout_date_time = $request->checkout_date_time;
        $auction->auction_timezone = $request->auction_timezone;
        $auction->payment_info = $request->payment_info;
        $auction->shipping_pickup = $request->shipping_pickup;
        $auction->bidding_notes = $request->bidding_notes;
        $auction->auction_notice = $request->auction_notice;
        $auction->bid_increment = $request->bidding_increment;
        $auction->auction_type = $request->auction_type;
        $auction->slug = createSlug($request->title, 'Auction', 'slug');
        $auction->save();
        if ($request->hasfile('auction_images')) {
            foreach ($request->file('auction_images') as $file) {
                $name = rand(10, 100) . time() . '.' . $file->extension();
                if (!in_array($file->extension(), array('jpeg', 'bmp', 'png'))) {
                    continue;
                }
                $file->move(public_path() . '/auctions/', $name);

                $image = new AuctionImage();
                $image->auction_id = $auction->id;
                $image->image_name = $name;
                $image->auction_image_cat = 'auction';
                $image->save();
            }
        }

        return redirect('admin/auction')->with('status', 'saved successfully');
    }

   /* public function delete(Request $request)
    {
        return view('admin.auction.edit');
    }*/
    function delete($id)
    {
        $auction = Auction::find($id);
        if (is_null($auction)) {
            return Redirect::back()->with('status', 'No Auction found');
        }
        $auction->is_deleted = '1';
        $auction->save();
        //$auction->delete();
        return Redirect::back()->with('status', 'Deleted successfully');

    }
    function item_delete($id)
    {
        $auctionitems = AuctionItems::find($id);
        if (is_null($auctionitems)) {
            return Redirect::back()->with('status', 'No Auction found');
        }
        //$auction->is_deleted = '1';
        //$auction->save();
        $auctionitems->delete();
        return Redirect::back()->with('status', 'Deleted successfully');

    }

    public function item_index($id)
    {
        if (Auth::user()->role_id == Role::SELLER_ROLE_ID) {
            $auction = Auction::where('id', $id)->where('sellerid', Auth::user()->id)->get();
        } else {
            $auction = Auction::where('id', $id)->get();
        }

        if (count($auction) > 0) {
            $auctionitems = AuctionItems::where('auctionid', $id)->get();
        }
        $parent_auction_name = $auction[0]->title;
        return view('admin.subauction.index')->with('data', $auctionitems)->with('auctionid', $id)->with('parent_auction_name', $parent_auction_name);
    }


    public function item_create($auctionid)
    {
        if (Auth::user()->role_id == Role::SELLER_ROLE_ID) {
            $auction = Auction::where('id', $auctionid)->where('sellerid', Auth::user()->id)->get();
        } else {
            $auction = Auction::where('id', $auctionid)->get();
        }


        $parent_auction_name = $auction[0]->title;
        $seller = User::where("role_id", Role::SELLER_ROLE_ID)->get();
        $category = Category::all();
        return view('admin.subauction.create')->with('seller', $seller)->with('category', $category)->with('auctionid', $auctionid)->with('parent_auction_name', $parent_auction_name);
    }

    public function item_edit($id)
    {

        $auction = AuctionItems::where('id', $id)->get();
        $auction = $auction[0];
        $pauction = Auction::where('id', $auction->auctionid)->get();
        $parent_auction_name = $pauction[0]->title;
        $category = Category::all();
        $images = AuctionImage::where('auction_id', $auction->id)->where('auction_image_cat', 'auction_item')->get();

        $seller = User::where("role_id", Role::SELLER_ROLE_ID)->get();
        return view('admin.subauction.edit')->with('data', $auction)->with('images', $images)
            ->with('seller', $seller)->with('category', $category)->with('parent_auction_name', $parent_auction_name);
    }


    public function item_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'auctionid' => 'required',
            'description' => 'required',
            'category' => 'required',
            'min_bidding_cost' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $auction = new AuctionItems;

        $item = AuctionItems::create(
            [
                'title' => $request->title,
                'slug' => createSlug($request->title, 'AuctionItems', 'slug'),
                'categoryid' => $request->category,
                'auctionid' => $request->auctionid,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'min_bidding_cost' => $request->min_bidding_cost,
                'status' => 1,
            ]
        );

        if ($request->hasfile('auction_images')) {
            foreach ($request->file('auction_images') as $file) {
                $name = rand(10, 100) . time() . '.' . $file->extension();
                if (!in_array($file->extension(), array('jpeg', 'bmp', 'png'))) {
                    continue;
                }
                if ($file->move(public_path() . '/auctions/', $name)) {

                    $image = new AuctionImage();
                    $image->auction_id = $item->id;
                    $image->image_name = $name;
                    $image->auction_image_cat = 'auction_item';
                    $image->save();
                }
            }
        }
        //return Redirect::back()->with('status', 'Auction Item Register Successfully');
          return redirect("admin/item/$request->auctionid")->with('status', 'saved successfully');

    }


    public function item_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'auctionid' => 'required',
            'description' => 'required',
            'category' => 'required',
            'min_bidding_cost' => 'required',
            'quantity' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $auction = AuctionItems::find($id);

        $auction->title = $request->title;
        $auction->categoryid = $request->category;
        $auction->auctionid = $request->auctionid;
        $auction->description = $request->description;
        $auction->quantity = $request->quantity;
        $auction->min_bidding_cost = $request->min_bidding_cost;
        $auction->status = 1;
        $auction->slug = createSlug($request->title, 'AuctionItems', 'slug');
        $auction->save();
        if ($request->hasfile('auction_images')) {
            foreach ($request->file('auction_images') as $file) {

                $name = rand(10, 100) . time() . '.' . $file->extension();
                if (!in_array($file->extension(), array('jpeg', 'bmp', 'png'))) {
                    continue;
                }
                if ($file->move(public_path() . '/auctions/', $name)) {

                    $image = new AuctionImage();
                    $image->auction_id = $auction->id;
                    $image->image_name = $name;
                    $image->auction_image_cat = 'auction_item';
                    $image->save();
                }


            }
        }
        //return Redirect::back()->with('status', 'Auction Item Register Successfully');
        return redirect("admin/item/$request->auctionid")->with('status', 'saved successfully');
    }



}
