@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <style>
        .cost-detail .btn.btn-success {
            font-size: 14px;
        }
    </style>
    <section class="auctions-category single-page">
        <div class="inner-container">
            <div class="row">
                <div class="tab-link">
                    <ul>
                        <li class="active"><a href="#">Current Bids</a></li>
                        <li><a href="{{asset('/watchlist')}}">Watch List</a></li>
                        <li><a href="{{route('auctions.lots')}}">Lot List</a></li>
                    </ul>
                </div>
                <div class="category-main">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <div class="search-form">
                            <form>
                                <input type="text" name="text" id="text" class="form-control" placeholder="Search">
                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="categories-button">
                            <select class="form-control" id="auction-search-category" name="cat">
                                <option value="">All Groups &amp; Categories</option>
                                @foreach($category as $ct)
                                    <option value="{{$ct->id}}" {{!empty($data["cat"]) && $ct->id== $data['cat'] ? 'selected':''}}>{{$ct->title}}
                                        ({{$ct->item_count}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning text-center d-none">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>WARNING:</strong>
                    <a href="#" class="lot-filter-refresh alert-link">Click here to refresh the page and get updated bid
                        amounts, time left, and bid status.</a>
                </div>

                <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert mt-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                            <h4 class="m-y-0">
                                Winning "High Bid" Total:
                                <span id="lot-list-buyer-status-top-high-bid-total">0.00</span>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                            <h4 class="m-y-0">
                                Winning "Your Max Bid" Total:
                                <span id="lot-list-buyer-status-top-bid-max-total">0.00</span>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-x print-hidden">
                            <a id="lot-list-buyer-status-top-winning" href="#"
                               class="btn btn-xs lot-status lot-status-winning" title="Winning Bids">0</a>
                            <a id="lot-list-buyer-status-top-pending" href="#"
                               class="btn btn-xs lot-status lot-status-pending" title="Sealed and Pending Bids">0</a>
                            <a id="lot-list-buyer-status-top-losing" href="#"
                               class="btn btn-xs lot-status lot-status-losing" title="Losing and Declined Bids">0</a>

                        </div>
                    </div>
                </div>

                <div class="m-b change-layout">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="text-center-xs lot-list-view-switcher-container">
                                <a href="#" class="print-link btn btn-default" target="_blank"><i
                                            class="fa fa-print fa-lg"></i> Print</a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="lot-list-view-switcher-container btn-group btn-group-toggle btn-group-sm right-float d-none">
                                <label class="btn btn-default btn-sm p-x-sm">
                                    <input type="radio" id="lot-list-view-switcher" class="lot-list-view-switcher"
                                           name="lot-view" autocomplete="off"><i class="fa fa-lg fa-list-ol m-r-sm"></i>Condensed
                                </label>
                                <label class="btn btn-default p-x-sm active">
                                    <input type="radio" id="lot-list-view-tile" class="lot-list-view-switcher"
                                           name="lot-view" autocomplete="off"><i
                                            class="fa fa-lg fa-th-large m-r-sm"></i>Tile View
                                </label>
                                <label class="btn btn-default p-x-sm">
                                    <input type="radio" id="lot-list-view-full" class="lot-list-view-switcher"
                                           name="lot-view" autocomplete="off"><i class="fa fa-lg fa-th-list m-r-sm"></i>Full
                                    View
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            {{-- <div class="dataTables_info show-results" id="lot-list_info" role="status" aria-live="polite">Showing 1 to 50 of 80 lots</div> --}}
                        </div>
                    </div>
                </div>

                <section class="lot-box w-100">
                    <div class="inner-container px-2">
                        <div class="row">
                            <div class="grid-box-main">
                                @foreach($auction_items as $key=>$item)
                                    @php
                                        $userAuction = user_auction_status($item->auctionid,$item->id);
                                        $image = getAuctionItemImage(1, $item->id);
                                        $count_bids = item_bids($item->auctionid,$item->id);
                                    @endphp
                                    <div class="wrapper-item">
                                        <div class="box-title">
                                            <p><span>Lot {{$item->id}}</span> | {{$item->title}}</p>
                                            <i class="fa fa-info-circle"></i>
                                        </div>
                                        <a href="javascript:(0);" data-id="{{$item->id}}"
                                           onclick="openGalleria('{{$item->id}}')" class="abcd" data-toggle="modal"
                                           data-target="#myModalgallery{{$item->id}}">
                                            @if($image && isset($image[0]))
                                                <img src="{{url('auctions/'.$image[0]['image_name'])}}">
                                            @endif
                                        </a>
                                        <div class="center-content">
                                            <span class="lot-high-bid text-bold">{{number_format($item->min_bidding_cost,2)}} USD </span>
                                            <div class="lot-bid-history">
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#bidHistory_{{$key}}">
                                                    {{count($count_bids)}}
                                                    Bids
                                                </a>
                                            </div>
                                            <span class="lot-time-left inline-block text-wrap"
                                                  id="auctionTimer{{$key}}"> <span class="days">3</span>d  <span
                                                        class="hours">3</span>h <span class="minutes">3</span>m </span>

                                        </div>
                                        <div class="cost-detail">
                                            @auth()
                                                @if($userAuction)
                                                    <button class="btn btn-primary bid_register" type="button"
                                                            data-toggle="modal" id="bid_register"
                                                            data-target="#auction_item_Status"
                                                            data-item-id="{{$item->id}}"
                                                            data-auction-id="{{$item->auctionid}}">
                                                        <span>Bid</span>
                                                        ${{number_format($item->min_bidding_cost, 2)}}
                                                    </button>

                                                @else
                                                    <button class="btn btn-primary bid_register" type="button"
                                                            data-toggle="modal" id="bid_register"
                                                            data-target="#registerForBidModal"
                                                            data-item-id="{{$item->id}}"
                                                            data-item-price="{{$item->min_bidding_cost}}"
                                                            data-auction-id="{{$item->auctionid}}">
                                                        <span>Bid</span>
                                                        ${{number_format($item->min_bidding_cost, 2)}}
                                                    </button>
                                                    {{--@if(user_bids($item->auctionid,\Illuminate\Support\Facades\Auth::id())->count() < 0 )

                                                    @else
                                                        <a href="{{route('auction.add',[base64_encode($item->auctionid),base64_encode($item->id)])}}"
                                                           class="btn btn-primary bid_register">
                                                            Bid ${{number_format($item->min_bidding_cost, 2)}}</a>
                                                    @endif--}}
                                                @endif
                                            @else

                                                <button class="btn btn-primary bid_register" type="button"
                                                        data-toggle="modal" id="bid_register"
                                                        data-target="#loginRegisterModal" data-item-id="{{$item->id}}"
                                                        data-item-price="{{$item->min_bidding_cost}}"
                                                        data-auction-id="{{$item->auctionid}}">
                                                    <span>Bid</span> {{number_format($item->min_bidding_cost, 2)}}
                                                </button>
                                            @endauth
                                            @php $watched = watched_by_user($item->auctionid,$item->id,\Illuminate\Support\Facades\Auth::id()) @endphp
                                            <button type="button"
                                                    class="btn btn-{{$watched && $watched->status==1?'success ml-1':'primary'}} watch_item"
                                                    data-itid="{{$item->id}}" data-aucid="{{$item->auctionid}}">
                                                <i class="fa fa-star fa-lg"></i>{{$watched && $watched->status==1?'Un':''}}
                                                Watch
                                            </button>
                                            <div class="lot-unwatch-container bid-watch-btn tile-watch-unwatch text-right pull-right m-l-xs p-1 unwatch_item hidden"
                                                 data-itid="{{$item->id}}" data-aucid="{{$item->auctionid}}">
                                                <button class="watch-lot lowrb-trigger unwatch-lot watch-notes-popover-trigger btn btn-default print-hidden"
                                                        type="button" id="lot-unwatch-button-{{$item->id}}">
                                                    <i class="fa fa-times fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModalgallery{{$item->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$item->title}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div id="galleria{{$item->id}}" class="galleria{{$item->id}}">
                                                        @php
                                                            $iimages = getAuctionItemImage(0, $item->id);
                                                        @endphp
                                                        @foreach($iimages as $imm)
                                                            <a href="{{url('auctions/'.$imm->image_name)}}">
                                                                <img src="{{url('auctions/'.$imm->image_name)}}"
                                                                     data-description="{{$item->title}}"
                                                                     data-title="{{$item->title}}">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                    <p class="text-center">Click Main Image For Fullscreen Mode</p>
                                                    <div class="col-12">
                                                        <div class="row m-t">
                                                            <div class="col-sm-4 text-right p-r">
                                                                Lot #
                                                            </div>
                                                            <div class="col-sm-8 text-left p-l"
                                                                 id="lot-preview-lot-number">
                                                                {{$item->id}}</div>
                                                        </div>
                                                        <div id="lot-preview-bid-history-container" class="row">
                                                            <div class="col-sm-4 text-right p-r">
                                                                Bid History
                                                            </div>
                                                            <div class="col-sm-8 text-left p-l">
                                                                <a class="lot-bid-history  btn btn-link p-a-0"
                                                                   href="javascript:void(0)" data-toggle="modal"
                                                                   data-target="#bidHistory_{{$key}}">{{count($count_bids)}}
                                                                    Bids</a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4 text-right p-r">
                                                                Estimate
                                                            </div>
                                                            <div class="col-sm-8 text-left p-l"
                                                                 id="lot-preview-estimate"></div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4 text-right p-r">
                                                                Description
                                                            </div>
                                                            <div class="col-sm-8 text-left p-l">
                                                                <div class="lot-description-container">
                                                                    <div class="lot-description-toggle lot-description-ellipsis">
                                                                        <div class="lot-description-arrow-container">
                                                                            <div id="lot-preview-description"
                                                                                 class="lot-description text-pre-line">
                                                                                {!! $item->description !!}
                                                                            </div>
                                                                            <div class="lot-description-arrow">
                                                                                <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <span class="watch_list_error text-danger mt-3 mx-auto"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="lot-preview-altbid-container text-center inline-block">
                                                        <a id="lot-preview-altbid-button" href=""
                                                           class="btn btn-primary hidden" target="_blank"
                                                           rel="noopener noreferrer">
                                                        </a>
                                                    </div>
                                                    @auth()
                                                        @php $watched = watched_by_user($item->auctionid,$item->id,\Illuminate\Support\Facades\Auth::id()) @endphp

                                                        <button class="btn btn-{{$watched && $watched->status ==1?'success':'default'}} watch_item test"
                                                                data-itid="{{$item->id}}"
                                                                data-aucid="{{$item->auctionid}}">
                                                            <i class="fa fa-star fa-lg"></i>
                                                            <span class="hidden-xs">{{$watched && $watched->status ==1?'Un':''}}Watch</span>
                                                        </button>

                                                        <a id="lot-preview-contact"
                                                           class="btn btn-success lot-feedback m-x-0"
                                                           href="jaavscript:void(0);" data-toggle="modal"
                                                           data-target="#contactSeller">
                                                            <i class="fa fa-envelope fa-lg"></i>
                                                            <span class="visible-xl">Contact Auctioneer</span>
                                                        </a>

                                                        <a id="lot-preview-detail"
                                                           href="{{route('lotdetails', $item->slug)}}"
                                                           class="btn btn-default m-x-0" target="_blank">Lot Details</a>
                                                    @else
                                                        <button class="watch-lot btn btn-default" data-toggle="modal"
                                                                type="button" data-target="#loginRegisterModal"
                                                                id="bid_register">
                                                            <i class="fa fa-star fa-lg"></i>
                                                            <span class="hidden-xs">Watch</span>
                                                        </button>

                                                        <button class="btn btn-default" id="lot-preview-detail"
                                                                data-toggle="modal"
                                                                type="button" data-target="#loginRegisterModal">Lot
                                                            Details
                                                        </button>
                                                    @endauth
                                                    <button type="button" class="btn btn-primary m-x-0"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($userAuction)
                                        <div class="modal fade" id="auction_item_Status" tabindex="-1"
                                             aria-labelledby="auction_item_StatusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="auction_item_StatusLabel">Item Bid
                                                            Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($userAuction->status == 0)
                                                            <p>Awaiting approval, It Should take 1-5 minutes</p>
                                                        @endif
                                                        @if($userAuction->status == 1)
                                                            <p>Bid Successfully done. You will be notified soon</p>
                                                        @endif
                                                        @if($userAuction->status == 2)
                                                            <p>Sorry ! Your bid request is rejected</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <div class="col-md-3 col-6 mx-auto">
                                                            <button type="button" class="btn btn-primary btn-block"
                                                                    data-dismiss="modal">OK
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- End Modal --->
                                    @endif
                                    @if(count($count_bids)>0)
                                        <div class="modal fade" id="bidHistory_{{$key}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Bid History for 101 - 2008 Ford
                                                            Escape</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;
                                                        </button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        <h2 id="bid-history-no-history" class="hidden">
                                                            No bids found for this item
                                                        </h2>
                                                        <div>
                                                            <div class="col">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Bidder</th>
                                                                        <th>Bids</th>
                                                                        <th>High Bid</th>
                                                                        <th>Last Bid</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($count_bids as $bids)
                                                                        <tr>
                                                                            <td>{{$bids->user?$bids->user->name:''}}</td>
                                                                            <td>{{$bids->user?count(user_bids($item->auctionid,$bids->user->id)):''}}</td>
                                                                            <td>{{$bids->item?$bids->item->min_bidding_cost:''}}
                                                                                USD
                                                                            </td>
                                                                            <td>{{\Carbon\Carbon::parse($bids->created_at)->format('d-m-Y H:i')}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div id="bid-history-disclaimer"
                                                                 class="alert alert-info text-center">
                                                                <i class="fa fa-info-circle"></i>
                                                                <span id="bid-history-disclaimer-text">In the case of a tie bid, precedence is given to the earliest bid</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <div class="warning-text d-none">
                    <p>There are no lots that match the search criteria. Please change your search criteria and try
                        again.</p>
                </div>

                <!---- End of Condensed Layout --->

                <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert mt-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                            <h4 class="m-y-0">
                                Winning "High Bid" Total:
                                <span id="lot-list-buyer-status-top-high-bid-total">0.00</span>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center p-x">
                            <h4 class="m-y-0">
                                Winning "Your Max Bid" Total:
                                <span id="lot-list-buyer-status-top-bid-max-total">0.00</span>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center p-x print-hidden">
                            <a id="lot-list-buyer-status-top-winning" href="#"
                               class="btn btn-xs lot-status lot-status-winning" title="Winning Bids">0</a>
                            <a id="lot-list-buyer-status-top-pending" href="#"
                               class="btn btn-xs lot-status lot-status-pending" title="Sealed and Pending Bids">0</a>
                            <a id="lot-list-buyer-status-top-losing" href="#"
                               class="btn btn-xs lot-status lot-status-losing" title="Losing and Declined Bids">0</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--- End of Auction Tab --->

    <!--- Start Auctions List --->



    <!--- End of Auctions List --->
@endsection

@section('extraJS')

@endsection