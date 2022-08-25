@extends('layouts.app', ['class' => 'bg-default'])
@section('content')
    <section class="auctions-list collapse-btn">
        <div class="inner-container">
            <div class="row">
                @if(session('success'))
                    <div class="col-12">

                        <div class="alert alert-success alert-dismissible " role="alert">
                            <strong><i class="fa fa-info-circle"></i> Success:</strong>
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            <!--- Start Category Result List --->
                <div class="city-title">
                    <p><i class="fa fa-clock-o fa-lg"
                          title="Online-Only Auction"></i> {{$auction_detail['title']}} {{date('m/d/Y',strtotime($auction_detail['auction_start_date']))}}
                    </p>
                </div>

                <div class="filter-show">
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 pr-0">
                        <div class="location-img">
                            <img src="{{asset($auction_detail->image?'auctions/'.$auction_detail->image->image_name:'')}}">
                            <div class="social-share">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 pr-0">
                        <div class="address-sec">
                            @if($auction_detail->seller)
                                <p><a href="#"><strong>{{$auction_detail->seller->name}}</span></a></strong></p>
                                <p><a href="#" class="add">{{$auction_detail->seller->address_1}}</br>
                                        {{$auction_detail->seller->address_2}}</a>
                                </p>
                            @endif
                            <div class="date">Date(s)
                                - {{date('m/d/Y',strtotime($auction_detail['auction_start_date']))}} {{date('m/d/Y',strtotime($auction_detail['auction_end_date']))}}</div>
                            <p>{{$auction_detail['auction_type']}} Auction</p>
                            <p>Starts: {{date('l, F dS, Y',strtotime($auction_detail['auction_start_date']))}}
                                @ {{$auction_detail['auction_timezone']}}</p>
                            <p>Ends: {{date('l, F dS, Y',strtotime($auction_detail['auction_end_date']))}}
                                @ {{$auction_detail['auction_timezone']}}</p>
                            <div class="city-name-date">
                                <p>Multi-City Surplus Auction, Participating Cities are: The Town of Davie, City of
                                    Parkland, City of Hialeah Gardens & City of West Miami. (More items will be posted
                                    shortly)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                        <div class="catalog-btn">
                            <ul>
                                <li><a href=""><i class="fa fa-flag fa-lg"></i><span>Bidding Open</span></a></li>
                                <li><a href=""><i class="fa fa-clock-o fa-lg" title="Online-Only Auction"></i><span>Online-Only Auction</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        @if(!empty($auction_detail['bidding_notes']))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Bidding
                                    Notice:</strong> {{$auction_detail['bidding_notes']}}
                            </div>
                        @endif
                        @if(!empty($auction_detail['auction_notice']))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Auction
                                    Notice:</strong> {{$auction_detail['auction_notice']}}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="three-btn">
                                    <ul>
                                        <li><a href="{{route('auction-detail', $auction_detail['slug'])}}">
                                                <i class="fa fa-info fa-lg"></i> <span>Auction Details</span></a>
                                        </li>
                                        @auth
                                          
                                                <li>
                                                    @if(!$auctions_register_check)
                                                    <a href="#" data-toggle="modal" id="bid_register_check"
                                                            data-target="#registerForBidModalCheck">
                                                            <i class="fa fa-gavel fa-lg"></i>
                                                        <span>Register to Bid</span>
                                                    </a>
                                                    @else
                                                    <a href="#" data-toggle="modal" id="alredy_register"
                                                            data-target="#AlreadyregisterForbid">
                                                            <i class="fa fa-gavel fa-lg"></i>
                                                        <span>Register to Bid</span>
                                                    </a>
                                                    @endif
                                                </li>
                                            
                                        @endauth
                                        @guest
                                            <li><a href="javascript:(0);" data-toggle="modal"
                                                   data-target="#loginRegisterModal"><i class="fa fa-gavel fa-lg"></i>
                                                    <span>Register to Bid</span></a></li>
                                        @endguest
                                        <li>
                                            <a href="{{route('catalog', $auction_detail['slug'])}}">
                                                <i class="fa fa-book fa-lg"></i>
                                                <span>View Catalog
                                                 <strong class="hidden-xs hidden-sm">
                                                    ({{count($auction_detail->items)}} Lots)
                                                 </strong>
                                              </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- End of show category list --->
            </div>
        </div>
    </section>
    @php
        $user_bids = user_bids($auction_detail->id,\Illuminate\Support\Facades\Auth::id());
    @endphp
    <!--- End of Auctions List --->
    <!--- Start Auction Categories --->
    @if(count($auction_detail->items) > 0)
        <section class="auctions-category single-page">
            <div class="inner-container">
                <div class="row">
                    <div class="category-main">
                        <form id="items_filter_form">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 pr-0">
                                <div class="search-form full-w">
                                    <input type="text" name="q" value="{{!empty($data['q']) ? $data['q'] :''}}"
                                           id="text" class="form-control" placeholder="Search">
                                    <button type="button" class="btn btn-primary search">Search</button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                                <div class="categories-button">
                                    <select class="form-control" id="auction-search-category" name="cat">
                                        <option value="">All Groups &amp; Categories</option>
                                        @foreach($categories as $ct)
                                            <option value="{{$ct->id}}" {{!empty($data["cat"]) && $ct->id== $data['cat'] ? 'selected':''}}>{{$ct->title}}
                                                ({{$ct->item_count}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                <div class="lot-select">
                                    <select class="form-control" data-val="true"
                                            data-val-required="The SortOrder field is required." id="sortOrder"
                                            name="sort" aria-required="true" aria-invalid="false"
                                            aria-describedby="sortOrder-error">
                                        <option selected="selected" value="2">Lot #</option>
                                        {{--
                                        <option value="8">Hot Lots</option>
                                     <select class="form-control" data-val="true" data-val-required="The SortOrder field is required." id="sortOrder" name="sort" aria-required="true" aria-invalid="false" aria-describedby="sortOrder-error">
                                        <option selected="selected" value="2">Lot #</option>
                                        <option value="7" >Time Left</option>
                                        <option value="5">Bid Count (high to low)</option>
                                        <option value="6">Bid Count (low to high)</option>
                                        --}}
                                        <option value="3" {{!empty($data["sort"]) && $data['sort']=='3' ? 'selected':''}}>
                                            Bid  (high to low)
                                        </option>
                                        <option value="4" {{!empty($data["sort"]) && $data['sort']=='4' ? 'selected':''}}>
                                            Bid  (low to high)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        {{--
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                           <div class="print-data">
                              <a href="#"><i class="fa fa-print fa-lg"></i></a>
                           </div>
                        </div>
                        --}}
                    </div>
                </div>
                <div class="row mt-30 d-none">
                    <div class="lot-list-view-options col-12 col-sm-12 col-md-12 col-lg-12  text-right text-center-xs pull-right print-hidden p-b-sm p-0">
                        <div class="lot-list-view-switcher-container btn-group btn-group-toggle btn-group-sm"
                             data-toggle="buttons">
                            <label class="btn btn-default btn-sm p-x-sm {{$data['list_view'] == 'condensed' ? 'active' : ''}}">
                                <input type="radio" id="lot-list-view-switcher" value="condensed"
                                       class="lot-list-view-switcher" name="list_view" autocomplete="off"><i
                                        class="fa fa-lg fa-list-ol m-r-sm"></i>Condensed
                            </label>
                            <label class="btn btn-default p-x-sm {{$data['list_view'] == 'tile' ? 'active' : ''}}">
                                <input type="radio" id="lot-list-view-tile" value="tile" class="lot-list-view-switcher "
                                       name="list_view" autocomplete="off"><i class="fa fa-lg fa-th-large m-r-sm"></i>Tile
                                View
                            </label>
                            <label class="btn btn-default p-x-sm {{$data['list_view'] == 'full' ? 'active' : ''}}">
                                <input type="radio" id="lot-list-view-full" value="full" class="lot-list-view-switcher"
                                       name="list_view" autocomplete="off"><i class="fa fa-lg fa-th-list m-r-sm"></i>Full
                                View
                            </label>
                        </div>
                    </div>
                    {{--
                    <div class="dataTables_info" id="lot-list_info" role="status" aria-live="polite">Showing 1 to 50 of 80 lots</div>
                    <div class="dataTables_paginate paging_simple_numbers" id="lot-list_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="lot-list_previous" style="display: none;"><a href="#" aria-controls="lot-list" data-dt-idx="0" tabindex="0">
                    <span class="hidden-xs">Previous</span>
                    <span class="visible-xs-inline"><i class="fa fa-chevron-left"></i></span>
                    </a></li><li class="paginate_button active"><a href="#" aria-controls="lot-list" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="lot-list" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button next" id="lot-list_next"><a href="#" aria-controls="lot-list" data-dt-idx="3" tabindex="0">
                    <span class="hidden-xs">Next</span>
                    <span class="visible-xs-inline"><i class="fa fa-chevron-right"></i></span>
                    </a></li></ul></div>
                    --}}
                </div>
                </form>
            </div>
        </section>
        <!--- End of Auction Tab --->
        <script type="text/javascript">
            function getTimeRemaining(endtime) {
                var offset = new Date().getTimezoneOffset();// getting offset to make time in gmt+0 zone (UTC) (for gmt+5 offset comes as -300 minutes)
                var date = new Date();
                date.setMinutes ( date.getMinutes() + offset);// date now in UTC time
                            
                var easternTimeOffset = -240; //for dayLight saving, Eastern time become 4 hours behind UTC thats why its offset is -4x60 = -240 minutes. So when Day light is not active the offset will be -300
                date.setMinutes ( date.getMinutes() + easternTimeOffset);

                const total = Date.parse(endtime) - Date.parse(date);
                const seconds = Math.floor((total / 1000) % 60);
                const minutes = Math.floor((total / 1000 / 60) % 60);
                const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
                const days = Math.floor(total / (1000 * 60 * 60 * 24));

                return {
                    total,
                    days,
                    hours,
                    minutes,
                    seconds
                };
            }

            function initializeClock(id, endtime) {
                const clock = document.getElementById(id);
                const daysSpan = clock.querySelector('.days');
                const hoursSpan = clock.querySelector('.hours');
                const minutesSpan = clock.querySelector('.minutes');

                //const secondsSpan = clock.querySelector('.seconds');

                updateClock();
                var timeinterval = setInterval(updateClock, 1000);

                function updateClock() {
                    const t = getTimeRemaining(endtime);

                    daysSpan.innerHTML = t.days;
                    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                    // secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                    if (t.total <= 0) {
                        clearInterval(timeinterval);
                    }
                }

            }
        </script>
        <style>
            .cost-detail .btn.btn-success{
                font-size: 14px;
            }
        </style>
        <!--- Start lot Box --->
        @if($data['list_view'] == 'tile')
            <section class="lot-box">
                <div class="inner-container">
                    <div class="row">
                        <div class="grid-box-main">
                            @foreach($auction_detail->items as $key=>$item)
                                @php
                                    $userAuction = user_auction_status($auction_detail->id,$item->id);
                                    $image = getAuctionItemImage(1, $item->id);
                                    $count_bids = item_bids($auction_detail->id,$item->id);
                                @endphp
                                <div class="wrapper-item">
                                    <div class="box-title">
                                        <p><span>Lot {{$item->id}}</span> | {{$item->title}}</p>
                                        <i class="fa fa-info-circle"></i>
                                    </div>
                                    <a href="javascript:(0);" data-id="{{$item->id}}"
                                       onclick="openGalleria('{{$item->id}}')" class="abcd" data-toggle="modal"
                                       data-target="#myModalgallery{{$item->id}}">
                                        @if(count($image)>0&&$image[0])
                                        <img src="{{url('auctions/'.$image[0]['image_name'])}}">
                                            @endif
                                    </a>
                                    <div class="center-content">
                                        <span class="lot-high-bid text-bold">{{number_format($item->min_bidding_cost,2)}}  </span>
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
                                        <script type="text/javascript">
                                            var idd = "auctionTimer" +<?php echo $key ?>;
                                            var deadline = '<?php echo date('Y-m-d H:i:s', strtotime($auction_detail['auction_end_date'])) ?>';
                                            initializeClock(idd, deadline);
                                        </script>
                                    </div>
                                    <div class="cost-detail">
                                        @auth()
                                            @if(!$auctions_register_check)
                                            {{-- @if(wallet_balance(\Illuminate\Support\Facades\Auth::id()) == 0) --}}
                                                <button class="btn btn-primary bid_register_check" type="button"
                                                            data-toggle="modal" id="bid_register_check"
                                                            data-target="#registerForBidModalCheck"
                                                            data-item-id="{{$item->id}}"
                                                            data-item-price="{{$item->min_bidding_cost}}"
                                                            data-auction-id="{{$auction_detail->id}}">
                                                        <span>Bid</span>
                                                        {{number_format($item->min_bidding_cost, 2)}}
                                                </button>
                                            @else
                                                @if($userAuction)
                                                    <button class="btn btn-primary bid_register" type="button"
                                                            data-toggle="modal" id="bid_register"
                                                            data-target="#registerBidBefore"
                                                            data-item-id="{{$item->id}}"
                                                            data-auction-id="{{$auction_detail->id}}">
                                                        <span>Bid</span>
                                                        {{number_format($item->min_bidding_cost, 2)}}
                                                    </button>

                                                @else
                                                    <button class="btn btn-primary bid_register" type="button"
                                                            data-toggle="modal" id="bid_register"
                                                            data-target="#registerBidBefore"
                                                            data-item-id="{{$item->id}}"
                                                            data-item-price="{{$item->min_bidding_cost}}"
                                                            data-auction-id="{{$auction_detail->id}}">
                                                        <span>Bid</span>
                                                        {{number_format($item->min_bidding_cost, 2)}}
                                                    </button>
                                                    {{--@if(user_bids($auction_detail->id,\Illuminate\Support\Facades\Auth::id())->count() < 0 )

                                                    @else
                                                        <a href="{{route('auction.add',[base64_encode($auction_detail->id),base64_encode($item->id)])}}"
                                                           class="btn btn-primary bid_register">
                                                            Bid {{number_format($item->min_bidding_cost, 2)}}</a>
                                                    @endif--}}
                                                @endif
                                            @endif    
                                        @else

                                            <button class="btn btn-primary bid_register" type="button"
                                                    data-toggle="modal" id="bid_register"
                                                    data-target="#loginRegisterModal" data-item-id="{{$item->id}}"
                                                    data-item-price="{{$item->min_bidding_cost}}"
                                                    data-auction-id="{{$auction_detail->id}}">
                                                <span>Bid</span> {{number_format($item->min_bidding_cost, 2)}}</button>
                                        @endauth
                                            @php $watched = watched_by_user($auction_detail->id,$item->id,\Illuminate\Support\Facades\Auth::id()) @endphp
                                        <button type="button" class="btn btn-{{$watched && $watched->status==1?'success ml-1':'primary'}} watch_item"
                                                data-itid="{{$item->id}}" data-aucid="{{$auction_detail['id']}}">
                                            <i class="fa fa-star fa-lg"></i>{{$watched && $watched->status==1?'Un':''}}Watch</button>
                                        <div class="lot-unwatch-container bid-watch-btn tile-watch-unwatch text-right pull-right m-l-xs p-1 unwatch_item hidden"
                                             data-itid="{{$item->id}}" data-aucid="{{$auction_detail['id']}}">
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
                                                        <div class="col-sm-8 text-left p-l" id="lot-preview-lot-number">
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
                                                    @php $watched = watched_by_user($auction_detail->id,$item->id,\Illuminate\Support\Facades\Auth::id()) @endphp

                                                    <button class="btn btn-{{$watched && $watched->status ==1?'success':'default'}} watch_item test"
                                                            data-itid="{{$item->id}}"
                                                            data-aucid="{{$auction_detail['id']}}">
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
                                                            type="button" data-target="#loginRegisterModal">Lot Details
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
                                                    <h4 class="modal-title">Bid History for 101 - 2008 Ford Escape</h4>
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
                                                                        <td>{{$bids->user?count(user_bids($auction_detail->id,$bids->user->id)):''}}</td>
                                                                        <td>{{$bids->item_amount?$bids->item_amount:''}}
                                                                            
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
                        <input type="hidden" id="oldid" value="">
                    </div>
                </div>
            </section>
        @endif
    @endif
    @if($data['list_view'] == 'condensed')
        <section class="condensed-layout">
            <div class="inner-container">
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tbody>
                            @foreach($auction_detail->items as $key=>$item)
                                @php
                                    $userAuction = user_auction_status($auction_detail->id,$item->id);
                                    $image = getAuctionItemImage(1, $item->id);
                                    $count_bids = item_bids($auction_detail->id,$item->id);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="lot inline-lot print-border bid-status-border bid-status-border-default">
                                            <div class="row m-x-0">
                                                <div class="col-8 col-sm-8 col-md-3 col-lg-3 pr-0">
                                                    <div class="row m-x-0">
                                                        <div class="col-4 pr-0">
                                                            @php
                                                                $image = getAuctionItemImage(1, $item->id);
                                                            @endphp
                                                            <a href="javascript:(0);" data-id="{{$item->id}}"
                                                               onclick="openGalleria('{{$item->id}}')"
                                                               class="lot-link lot-preview-link" data-toggle="modal"
                                                               data-target="#myModalgallery{{$item->id}}">
                                                                <div class="">
                                                                    @if(count($image)>0&&$image[0])
                                                                    <img class="inline-lot-thumbnail img-responsive"
                                                                         src="{{url('auctions/'.$image[0]['image_name'])}}">
                                                                    @endif
                                                                    <div class="align-top-absolute">
                                                                        <div class="lot-quantity label label-warning label-transparent hidden"></div>
                                                                        <div class="lot-quantity-sold-container label label-warning label-transparent text-center hidden">
                                                                            x <span class="lot-quantity-sold"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="align-top-absolute m-r-0-absolute">
                                                                        <div id="lot-watch-status"
                                                                             class="lot-watch-status label label-primary label-transparent hidden">
                                                                            <i class="fa fa-star"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                        </div>
                                                        <div class="col-8 pr-0">
                                                            <div>
                                                                <strong>
                                                                    <a href=""
                                                                       class="inline-lot-number-lead lot-number-lead lot-link lot-preview-link">
                                                                        <b>Lot {{$item->id}}</b>
                                                                        | {{$item->title}}</a>
                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 p-0 hidden-xs">
                                                    <div class="row m-x-0">
                                                        <div class="text-center col-2">
                                                            <a class="lot-bid-history  btn btn-link p-a-0"
                                                               href="javascript:void(0)" data-toggle="modal"
                                                               data-target="#bidHistory_{{$key}}">{{count($count_bids)}}
                                                                Bids</a>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="lot-time-left-container h4 text-center">
                                                                <div>
                                                                    <div class="lot-time-label label inline-block label-info">
                                                                        <span class="lot-time-left inline-block text-wrap"
                                                                              id="auctionTimer{{$key}}"> <span
                                                                                    class="days">3</span>d  <span
                                                                                    class="hours">3</span>h <span
                                                                                    class="minutes">3</span>m </span>
                                                                        <script type="text/javascript">
                                                                            var idd = "auctionTimer" + {{$key}};
                                                                            var deadline = '{{date('Y-m-d H:i:s', strtotime($auction_detail['auction_end_date']))}}';
                                                                            initializeClock(idd, deadline);
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-3">
                                                            <dl class="lot-bid-max-container text-center m-b-0 ">
                                                                <dt>
                                                                    <span class="lot-bid-type-max">High Bid</span>

                                                                </dt>
                                                                <dd class="lot-bid-max">fdfdsfds</dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lot-buttons-col col-4 col-sm-4 col-md-3 col-lg-3 p-x-0">
                                                    <div class="row m-x-0">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center p-x-0">

                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center p-x-0  print-visible">
                                                            <span class="lot-bid-type-max">Your Max</span>
                                                            <span class="lot-bid-type-flat">Your Bid</span>
                                                            <span class="lot-bid-max"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row m-x-0">
                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-0 inline-lot-bid-button-container print-hidden">
                                                            <div class="bid-status bid-status-76282044"
                                                                 data-event-item-id="0" data-status="nobid">

                                                                <div class="bid-status-winning hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Winning</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-won  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Won</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="btn btn-default btn-sm bid-status-mayhavewonstatus  hidden"
                                                                     data-toggle="popover" data-placement="top"
                                                                     data-content="&amp;quot;Congratulations&amp;quot; You Have Won!"
                                                                     data-original-title="" title="">
                                                                    <span class="may-have-won-status">Status</span>
                                                                </div>
                                                                <div class="bid-status-mayhavewon  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">May Have Won</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-pending  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Pending</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-notaccepted  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Not Accepted</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-sealed  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Sealed</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-passed  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Pass</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-outbid  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Outbid</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-declined  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status inline-block text-wrap lot-status-default">Declined</span>
                                                                    </h4>
                                                                </div>
                                                                <div class="bid-status-watching  hidden">
                                                                    <h4>
                                                                        <span class="label  lot-status lot-status-default">Watching</span>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="lot-bid-container inline-lot-bid-container text-center">
                                                                @auth()
                                                                    @if(userPaymentMethod(\Illuminate\Support\Facades\Auth::id())->count() > 0)
                                                                        @if($userAuction)
                                                                            <button class="lowrb-trigger btn p-x btn-primary"
                                                                                    title="Bid" type="button"
                                                                                    id="lot-bid-button-76282044"
                                                                                    data-toggle="modal"
                                                                                    data-target="#registerForBidModal">
                                                                                <i class="fa fa-plus fa-lg"
                                                                                   title="Bid"></i>
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <button class="lowrb-trigger btn p-x btn-primary"
                                                                            title="Bid" type="button"
                                                                            id="lot-bid-button-76282044"
                                                                            data-toggle="modal"
                                                                            data-target="#registerForBidModal">
                                                                        <i class="fa fa-plus fa-lg"
                                                                           title="Bid"></i>
                                                                    </button>
                                                                @endauth
                                                            </div>
                                                        </div>

                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-0 inline-lot-watch-button-container print-hidden">

                                                            <button type="button"
                                                                    class="watch-lot lowrb-trigger watch-notes-popover-trigger btn btn-default p-x watch_item"
                                                                    data-itid="{{$item->id}}"
                                                                    data-aucid="{{$auction_detail['id']}}">
                                                                <i class="fa fa-star fa-lg" title="Watch"></i>
                                                            </button>

                                                            <div class="lot-unwatch-container text-center unwatch_item hidden"
                                                                 data-itid="{{$item->id}}"
                                                                 data-aucid="{{$auction_detail['id']}}">
                                                                <button type="button"
                                                                        class="watch-lot lowrb-trigger unwatch-lot watch-notes-popover-trigger btn btn-default p-x">
                                                                    <i class="fa fa-times fa-lg" title="Unwatch"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-x-0 pull-right p-t-sm inline-lot-buyitnow-button-container print-hidden">
                                                            <div class="lot-buyitnow-container inline-lot-buyitnow-container text-center"
                                                                 style="display: none;">
                                                                <button class="lowrb-trigger btn btn-primary p-x"
                                                                        title="Buy It Now" type="button">
                                                                    <i class="fa fa-cart-arrow-down fa-lg"
                                                                       title="Buy It Now"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="watch-notes m-t ready" data-title="Personal Notes"
                                                         data-placement="auto right" data-placement-xs="auto left">
                                                        <div class="watch-notes-edit-link text-nowrap hidden">
                                                            <i class="fa fa-pencil"></i>
                                                            <i class="watch-notes-link-hint">Click to add notes.</i>
                                                            <span class="watch-notes-text hidden">null</span>
                                                        </div>
                                                        <textarea class="watch-notes-edit collapse" rows="3" cols="30"
                                                                  maxlength="200"
                                                                  placeholder="Add your personal notes about this item here."
                                                                  aria-expanded="false"></textarea>
                                                        <div class="notes-saved-alert alert alert-success p-a-sm m-b-0 m-t-sm hidden">
                                                            <i class="fa fa-check-circle fa-lg m-r-sm"></i>
                                                            <span>Notes saved</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                                                             id="lot-preview-lot-number">{{$item->id}}</div>
                                                    </div>
                                                    <div id="lot-preview-bid-history-container" class="row">
                                                        <div class="col-sm-4 text-right p-r">
                                                            Bid History
                                                        </div>
                                                        <div class="col-sm-8 text-left p-l">
                                                            <a class="lot-bid-history  btn btn-link p-a-0"
                                                               href="javascript:void(0)" data-toggle="modal"
                                                               data-target="#bidHistory">20 Bids</a>
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
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="lot-preview-altbid-container text-center inline-block">
                                                    <a id="lot-preview-altbid-button" href=""
                                                       class="btn btn-primary hidden" target="_blank"
                                                       rel="noopener noreferrer">
                                                    </a>
                                                </div>
                                                <div class="lot-buyitnow-container text-center inline-block">
                                                    <button class="lowrb-trigger lot-buyitnow-button btn btn-primary p-x"
                                                            data-ba="130" title="Buy It Now" type="button"
                                                            style="display: none;">
                                                        <i class="fa fa-cart-arrow-down fa-lg" title="Buy It Now"></i>
                                                        <span class="lot-buyitnow-text">
                                    Buy It Now
                                    </span>
                                                        <div>
                                                            <span class="TileDisplayBuyItNowPrice"></span>
                                                        </div>
                                                    </button>
                                                </div>
                                                <button class="watch-lot lowrb-trigger watch-notes-popover-trigger btn btn-default print-hidden m-x-0 watch_item"
                                                        type="button">
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <span class="hidden-xs">Watch</span>
                                                </button>
                                                <button class="watch-lot lowrb-trigger unwatch-lot watch-notes-popover-trigger btn btn-default print-hidden m-x-0 unwatch_item hidden"
                                                        type="button">
                                                    <i class="fa fa-times fa-lg"></i>
                                                    <span class="hidden-xs">Unwatch</span>
                                                </button>
                                                <a id="lot-preview-contact" class="btn btn-success lot-feedback m-x-0"
                                                   href="jaavscript:void(0);" data-toggle="modal"
                                                   data-target="#contactSeller">
                                                    <i class="fa fa-envelope fa-lg"></i>
                                                    <span class="visible-xl">Contact Auctioneer</span>
                                                </a>
                                                <a id="lot-preview-detail" href="{{route('lotdetails', $item->slug)}}"
                                                   class="btn btn-default m-x-0" target="_blank">Lot Details</a>
                                                <button type="button" class="btn btn-primary m-x-0"
                                                        data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        @foreach($auction_detail->items as $key=>$item)
                            @php
                                $userAuction = user_auction_status($auction_detail->id,$item->id);
                                $image = getAuctionItemImage(1, $item->id);
                                $count_bids = item_bids($auction_detail->id,$item->id);
                            @endphp
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
                                                <h4 class="modal-title">Bid History for 101 - 2008 Ford Escape</h4>
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
                                                                    <td>{{$bids->user?count(user_bids($auction_detail->id,$bids->user->id)):''}}</td>
                                                                    <td>{{$bids->item?$bids->item->min_bidding_cost:''}}</td>
                                                                    <td>{{$bids->created_at}}</td>
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

                                            <!-- Modal footer -->


                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" id="oldid" value="">
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($data['list_view'] == 'full')
        <section class="fullview-layout">
            <div class="inner-container">
                @foreach($auction_detail->items as $key=>$item)
                    @php
                        $userAuction = user_auction_status($auction_detail->id,$item->id);
                        $image = getAuctionItemImage(1, $item->id);
                        $count_bids = item_bids($auction_detail->id,$item->id);
                    @endphp
                    <div class="row mb-30">
                        <div class="col-12">
                            <div class="full-inner">
                                <div class="heading-top">
                                    <h4><span>Lot {{$item->id}}</span> | {{$item->title}}</h4>
                                </div>
                                <div class="row">
                                    @php
                                        $image = getAuctionItemImage(1, $item->id);
                                    @endphp
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="img-social">
                                            <a href="javascript:(0);" data-id="{{$item->id}}"
                                               onclick="openGalleria('{{$item->id}}')" class="abcd" data-toggle="modal"
                                               data-target="#myModalgallery{{$item->id}}">
                                                @if(count($image)>0&&$image[0])
                                                <img src="{{url('auctions/'.$image[0]['image_name'])}}">
                                                    @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                        <div class="lot-description-container lot-description-toggle lot-description-large lot-description-ellipsis">
                                            <div class="lot-description-arrow-container">
                                                <div class="lot-description text-pre-line">
                                                    {!! $item->description !!}
                                                </div>
                                                {{--
                                                <div class="lot-description-arrow">
                                                   <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                                                </div>
                                                --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                        <div class="hours-detail">

                                            <span class="lot-time-left inline-block text-wrap"
                                                  id="auctionTimer{{$key}}"> <span class="days">3</span>d  <span
                                                        class="hours">3</span>h <span class="minutes">3</span>m </span>
                                            <script type="text/javascript">
                                                var idd = "auctionTimer" +<?php echo $key ?>;
                                                var deadline = '<?php echo date('Y-m-d H:i:s', strtotime($auction_detail['auction_end_date'])) ?>';
                                                initializeClock(idd, deadline);
                                            </script>
                                            <dlv class="lot-bid-container text-center m-b-0">
                                                <dt>High Bid</dt>
                                                <dd class="lot-high-bid" data-sealed="Sealed">1,150.00 </dd>
                                            </dlv>
                                            <div class="text-center m-b">
                                                <a class="lot-bid-history  btn btn-link p-a-0" href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-target="#bidHistory_{{$key}}">{{count($count_bids)}} Bids</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="inline-btn">
                                            <button class="watch-lot lowrb-trigger watch_item watch-notes-popover-trigger btn btn-default btn-block print-hidden"
                                                    type="button" data-itid="{{$item->id}}"
                                                    data-aucid="{{$auction_detail['id']}}">
                                                <i class="fa fa-star fa-lg"></i>
                                                <span class="hidden-xs">Watch</span>
                                            </button>
                                            <button type="button"
                                                    class="unwatch_item watch-lot lowrb-trigger watch_item watch-notes-popover-trigger btn btn-default btn-block print-hidden hidden"
                                                    data-itid="{{$item->id}}" data-aucid="{{$auction_detail['id']}}">
                                                <i class="fa fa-times fa-lg" title="Unwatch"></i>
                                                <span class="hidden-xs">Unwatch</span>
                                            </button>

                                            <button class="lowrb-trigger mt-10 lot-bid-button lot-bid-button-bid-amount btn btn-block print-hidden btn-primary"
                                                    data-toggle="modal" data-target="#registerForBidModal">
                                                <div class="lot-bid-text-container">
                                                    <span class="lot-bid-text" data-bid="Bid"
                                                          data-no-minimum-caption="No Minimum">Bid</span>
                                                    <span class="TileDisplayMinBid">{{number_format($item->min_bidding_cost, 2)}}</span>
                                                    <span class="TileDisplayBidQuantity" data-total="Total"
                                                          style="margin-left: 2px"></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModalgallery{{$item->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{$item->title}}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                 id="lot-preview-lot-number">{{$item->id}}</div>
                                        </div>
                                        <div id="lot-preview-bid-history-container" class="row">
                                            <div class="col-sm-4 text-right p-r">
                                                Bid History
                                            </div>
                                            <div class="col-sm-8 text-left p-l">
                                                <a class="lot-bid-history  btn btn-link p-a-0" href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-target="#bidHistory_{{$key}}">{{count($count_bids)}} Bids</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 text-right p-r">
                                                Estimate
                                            </div>
                                            <div class="col-sm-8 text-left p-l" id="lot-preview-estimate"></div>
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @auth()
                                        <div class="lot-preview-altbid-container text-center inline-block">
                                            <a id="lot-preview-altbid-button" href="" class="btn btn-primary hidden"
                                               target="_blank" rel="noopener noreferrer">
                                            </a>
                                        </div>
                                        <div class="lot-buyitnow-container text-center inline-block">
                                            <button class="lowrb-trigger lot-buyitnow-button btn btn-primary p-x"
                                                    data-ba="130" title="Buy It Now" type="button">
                                                <i class="fa fa-cart-arrow-down fa-lg" title="Buy It Now"></i>
                                                <span class="lot-buyitnow-text">
                                                    Buy It Now
                                                </span>
                                                <span class="TileDisplayBuyItNowPrice"></span>
                                            </button>
                                        </div>
                                        <button class="btn btn-default"
                                                data-ba="6" type="button" data-bai="76282044"
                                                id="lot-watch-button-76282044"
                                                data-original-title="" title=""><i class="fa fa-star fa-lg"></i>
                                            <span class="hidden-xs">Watch</span>
                                        </button>
                                        <a id="lot-preview-contact" class="btn btn-success lot-feedback m-x-0"
                                           href="jaavscript:void(0);" data-toggle="modal" data-target="#contactSeller">
                                            <i class="fa fa-envelope fa-lg"></i>
                                            <span class="visible-xl">Contact Auctioneer</span>
                                        </a>
                                        <a id="lot-preview-detail" href="{{route('lotdetails', $item->slug)}}"
                                           class="btn btn-default m-x-0" target="_blank">Lot Details</a>
                                    @endauth
                                    <button type="button" class="btn btn-primary m-x-0" data-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- End Modal --->
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
                                        <h4 class="modal-title">Bid History for 101 - 2008 Ford Escape</h4>
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
                                                            <td>{{$bids->user?count(user_bids($auction_detail->id,$bids->user->id)):''}}</td>
                                                            <td>{{$bids->item?$bids->item->min_bidding_cost:''}}</td>
                                                            <td>{{$bids->created_at}}</td>
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

            <input type="hidden" id="oldid" value="">
        </section>
    @endif
    <div class="modal fade" id="registerForBidModalCheck" tabindex="-1"
         aria-labelledby="bid_register_check" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bid_register_check"> Instruction </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Before you bid you must Register to auction.</p>
                    <p>The cost is {{$chargeAmount}} coins which can be charge from your wallet</p>
                    <!-- <p>Click OK to Register</p> -->
                </div>
                <div class="modal-footer text-center">
                    <div class="" style="display:inherit">
                        @if(wallet_balance(\Illuminate\Support\Facades\Auth::id()) > $chargeAmount)
                        <form action="{{route('entry')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="charge_amount" value="{{$chargeAmount}}">
                            <input type='hidden' name="auction_id" value="{{$auction_detail->id}}">
                            <button class="btn btn-primary float-right form-control"  style="margin-left:5px"> Register to Bid
                            </button>
                        </form>
                        @endif
                        <button class="btn btn-primary float-right" style="margin-left:10px" data-toggle="modal" id="add_to_wallet" data-target="#add_wallet_amount_check" data-dismiss="modal"> Add to Wallet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AlreadyregisterForbid" tabindex="-1"
         aria-labelledby="bid_register_check" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bid_register_check"> Instruction </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You Already Register on current auction Now you can bid on items</p>
                    <!-- <p>Click OK to Register</p> -->
                </div>
                <div class="modal-footer text-center">
                    <div class="" style="display:inherit">
                        
                        <button class="btn btn-primary float-right" style="margin-left:10px" data-dismiss="modal"> Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerBidBefore" tabindex="-1"
         aria-labelledby="bid_register_check" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('auction.bidplaced')}}" class="form-horizontal"
                  id="auction_register" method="POST" novalidate="novalidate">
                @csrf
                <input type="hidden" id="item_id" value="{{old('item_id')}}" name="item_id">
                <input type="hidden" id="auction_id" value="{{old('auction_id')}}" name="auction_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="bid_register_check"> Instruction </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You will be charge same amount if you won. </p>
                    <p>Please click Ok to process</p>
                </div>
                <div class="modal-footer text-center">
                    <div class="col-md-3 col-6 mx-auto">
                        <input class="btn btn-primary float-right" type="submit" value="OK">
                        
                    </div>
                </div>
                </form>
            </div>
        
        </div>
    </div>

    <div class="modal fade" id="add_wallet_amount_check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Coin in Wallet</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" id="add_wallet">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class=" wallet_amount">
                                <input type="hidden" value="{{$auction_detail->id}}" id="auctionId">
                                <input type="text" class="form-control" id="process_payment"
                                       placeholder="Please Enter Amount" name="add_amount" value="{{$chargeAmount}}" readonly >
                                <hr>
                            </div>
                            <input type="hidden" id="prev_url" name="prev_url" value="{{base64_encode(url()->current())}}">

                            <div class="btn btn-primary" id="add_to_wallet" onclick="add_to_wallet();"> Add to
                                Wallet
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="min-height"></div>
    @include('layouts.footers.modals')
    <!--- End of  lot Box --->
    <script>


        $(document).on('click', ".bid_register", function () {
            $('.insuficent_balance').removeClass('d-none')
            $('#item_id').val($(this).data('item-id'))
            $('#auction_id').val($(this).data('auction-id'))
            var balance,auction_item_price;
            auction_item_price = $(this).data('item-price');
            @auth()
                balance = {{wallet_balance(\Illuminate\Support\Facades\Auth::id())}}
            @else
                balance = 0;
            @endauth 
            if(balance > 0){
                $('.insuficent_balance').addClass('d-none')
                $('.submit_bid').removeClass('d-none')
            }else{
                $('.insuficent_balance').removeClass('d-none')
                $('.submit_bid').addClass('d-none')
            }
        })

        $(document).on('change', ".categories-button select", function () {
            $("#items_filter_form").submit();
        })
        $("#sortOrder").change(function () {
            $("#items_filter_form").submit();
        })
        $(".search").click(function () {
            $("#items_filter_form").submit();
        })
        $(document).on('change', ".lot-list-view-switcher", function () {
            $("#items_filter_form").submit();
        })

        $(document).on('change', ".lot-list-view-switcher", function () {

            $("#items_filter_form").submit();
        })

        $(document).on('click', '.watch_item', function () {
            var watch_btn = $(this);
            var watch_error = $('.watch_list_error');
            watch_error.text('')
            $.ajax({
                url: "{!! route('watchlist.store') !!}",
                type: 'POST',
                data: {
                    item_id: watch_btn.data('itid'),
                    auction_id: watch_btn.data('aucid'),
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    var data = JSON.parse(result);
                    if (data.status == 200) {
                        var watch = data.watch
                        if (watch.status == 1) {
                            watch_btn.removeClass('btn-default').addClass('btn-success').html('<i class="fa fa-star fa-lg"></i> UnWatch');
                        } else {
                            watch_btn.removeClass('btn-success').addClass('btn-default').html('<i class="fa fa-star fa-lg"></i> Watch');
                        }
                    } else {
                        watch_error.text('Sorry ! Something Wrong try again');
                    }
                    console.log();
                    /*$(t).addClass('hidden');
                    console.log($(t).next('.unwatch_item'));
                    $(t).next('.unwatch_item').removeClass('hidden');
                    $(t).parent().prev().find(".bid-status-watching").removeClass('hidden');*/
                }
            })
        })

    </script>

    <script>
        
        setTimeout(function(){
   window.location.reload(1);
}, 20000);
    </script>
@endsection