@extends('layouts.app', ['class' => 'bg-default'])
@section('content')
    <section class="back-page">
        <div class="inner-container">
            <div class="row">
                {{--
                <div class="col-sm-12 p-0">
                   <div class="pull-left">
                      <a class="btn btn-default btn-sm" href="/catalog/249364/?q=124">
                      <i class="fa fa-arrow-left fa-lg"></i>
                      <span class="hidden-sm">Back to Catalog</span>
                      </a>
                      <span class="m-l">Result: 25 of 71</span>
                   </div>
                   <div class="pull-right">
                      <a class="lot-details-pager-prev btn btn-default btn-sm" href="/lot/78659866/" title="previous lot" rel="prev">
                      <i class="fa fa-chevron-left fa-lg"></i>
                      <span class="hidden-xs">Previous Lot</span>
                      </a>
                      <a class="lot-details-pager-next btn btn-default btn-sm" href="/lot/79925954/" title="next lot" rel="next">
                      <span class="hidden-xs">Next Lot</span>
                      <i class="fa fa-chevron-right fa-lg"></i>
                      </a>
                   </div>
                </div>
                --}}
                <div class="col-sm-12 p-0">
                    <div class="page-header">
                        <h1>
                            <i id="lot-watch-status-79426761" class="lot-watch-status fa fa-star hidden"></i>
                            <span>Lot # : {{$auction_item->id}} - {{$auction_item->title}}</span>
                        </h1>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 pl-0">
                    <div class="multi-slider">
                        <div id="galleria" class="detailgalleria">
                            @php
                                $images = getAuctionItemImage(0, $auction_item->id);
                            @endphp
                            @foreach($images as $img)
                                <a href="{{url('auctions/'.$img->image_name)}}">
                                    <img src="{{url('auctions/'.$img->image_name)}}"
                                         data-description="{{$auction_item->title}}"
                                         data-title="{{$auction_item->title}}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php($count_bids = item_bids($auction_item->auction->id,$auction_item->id))
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 pr-0">
                    <div class="platform-detail">
                        <table class="table table-no-border">
                            <tbody>
                            <tr>
                                <th class="text-right p-x col-xs-4 col-sm-5 col-lg-4">Type</th>
                                <td class="p-x col-xs-8 col-sm-7 col-lg-8">{{$auction_item->auction?$auction_item->auction->auction_type :''}}
                                    Auction
                                </td>
                            </tr>
                            <tr class="">
                                <th class="text-right p-x col-xs-4 col-sm-5 col-lg-4">Bid History</th>
                                <td class="p-x col-xs-8 col-sm-7 col-lg-8">
                                    <a class="lot-bid-history  btn btn-link p-a-0" href="javascript:void(0)"
                                       data-toggle="modal" data-target="#bidHistory">
                                        {{count($count_bids)}} Bids </a>
                                </td>
                            </tr>
                            <tr class="">
                                <th class="text-right p-x col-xs-4 col-sm-5 col-lg-4">High Bid</th>
                                <td class="p-x col-xs-8 col-sm-7 col-lg-8">
                                    <span class="lot-high-bid " data-sealed="Sealed">30.00 USD</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right p-x col-xs-4 col-sm-5 col-lg-4">Time Left</th>
                                <td class="p-x col-xs-8 col-sm-7 col-lg-8">
                                    <div class="lot-time-left-container">
                                      <span class="lot-time-left ">
                                         <span id="auctionTimer">
                                         <span class="days">3</span>d  <span class="hours">3</span>h <span
                                                     class="minutes">3</span>m
                                         </span>
                                         <script type="text/javascript">
                                            var idd = "auctionTimer";
                                            var deadline = "<?php echo date('Y-m-d', strtotime($auction_item->auction ? $auction_item->auction->auction_end_date : '')) ?>";
                                            initializeClock(idd, deadline);
                                         </script>
                                      </span>
                                        <span class="lot-time-extended label label-danger hidden">
                              <i class="fa fa-clock-o fa-lg"></i>
                              </span>
                                    </div>
                                    {{--
                                    <div class="">
                                       <i class="fa fa-info-circle fa-lg"></i>
                                       <abbr title="" data-toggle="popover" data-placement="bottom" data-content="The closing time of this lot will be extended by 1.0 minutes if a bid is placed on this lot in the last 1.0 minutes." data-original-title="Soft Close">
                                       Soft Close
                                       </abbr>
                                    </div>
                                    --}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                           <span class="m-x-0 hidden">
                              <a href="/webcast/249364/0/topper-and-bedslide-sliding-platform/"
                                 class="btn btn-primary blink"
                                 data-icon="signal-diag"
                                 style="animation-name: modernBlink; animation-duration: 1000ms; animation-iteration-count: infinite;">
                                 Bid Live
                              </a>
                           </span>
                            <span class="m-x-0 ">
                                 <button class="btn btn-primary bid_register" href="javascript:(0);" data-toggle="modal"
                                         data-item-id="{{$auction_item->id}}" data-item-price="{{$auction_item->min_bidding_cost}}"
                                         data-auction-id="{{$auction_item->auction->id}}"
                                         data-target="#registerForBidModal"
                                         type="button">
                                       <div class="lot-bid-text-container">
                                          <span class="lot-bid-text" data-bid="Bid"
                                                data-no-minimum-caption="No Minimum">
                                             Bid
                                          </span>
                                          <span class="TileDisplayMinBid">{{$auction_item->min_bidding_cost}}</span>
                                          <span class="TileDisplayBidQuantity" data-total="Total"
                                                style="margin-left: 2px"></span>
                                       </div>
                                 </button>
                              </span>
                            @php($watched = watched_by_user($auction_item->auction->id,$auction_item->id,\Illuminate\Support\Facades\Auth::id()))

                            <span class="lot-watch-container m-x-0 ">
                                 <button class="btn btn-{{$watched && $watched->status ==1?'success':'default'}} watch_item"
                                         type="button" data-itid="{{$auction_item->id}}"
                                         data-aucid="{{$auction_item->auctionid}}">
                                    <i class="fa fa-star fa-lg"></i>
                                    <span> {{$watched && $watched->status ==1?'Un':''}}Watch</span>
                                 </button>
                            </span>

                            <span class="feedback-continer text-center m-x-0">
                                 <a class="btn btn-success lot-feedback" href="javascript:(0);" data-toggle="modal"
                                    data-target="#contactSeller">
                                 <i class="fa fa-envelope fa-lg"></i>
                                 <span>Contact Auctioneer</span>
                                 </a>
                            </span>
                        </div>
                        <div class="col-12 d-none">
                            <div class="social-share center-share">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mt-5 pt-3">
                            <div class="sharethis-inline-share-buttons text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--- End Back to Catalog --->
    <!--- End of auction List --->
    <!--- Start Blue Highlight --->
    <section class="blue-highlight">
        <div class="inner-container">
            <div class="row">
                <div class="col-12 p-0">
                    @if($auction_item->auction->bidding_notes)
                        <div class="alert alert-primary" role="alert">
                            <strong><i class="fa fa-info-circle"></i>
                            {{$auction_item->auction->bidding_notes}}
                        </div>
                    @endif
                    @if($auction_item->auction->auction_notice)
                        <div class="alert alert-primary" role="alert">
                            <strong><i class="fa fa-info-circle"></i>
                            {{$auction_item->auction->auction_notice}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--- End of Blue Highlight --->
    <!---- Information Accordion --->
    <section class="information-accordion">
        <div class="inner-container">
            <div class="row">
                <div class="col-12 p-0">
                    <!--Accordion wrapper-->
                    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                        <!-- Accordion card -->
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header" role="tab" id="itemInfo">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx"
                                   href="#itemInformation"
                                   aria-expanded="false" aria-controls="itemInformation">
                                    <h5 class="mb-0">
                                        Information <i class="fa fa-chevron-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <!-- Card body -->
                            <div id="itemInformation" class="collapse" role="tabpanel" aria-labelledby="itemInfo"
                                 data-parent="#accordionEx">
                                <div class="card-body">
                                    <table class="table table-no-border table-fixed">
                                        <tbody>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Lot#</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->id}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Group - Category</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{fetchCatById($auction_item->auction->categoryid)}}
                                                Auction
                                            </td>
                                        </tr>
                                        <th class="col-sm-4 col-md-3 col-lg-2 text-right">Description</th>
                                        <td class="col-sm-8 col-md-9 col-lg-10">
                                            <div class="text-pre-line">{!!$auction_item->auction->description!!}</div>
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header" role="tab" id="auctionInfo">
                                <a data-toggle="collapse" data-parent="#accordionEx" href="#auctionInform"
                                   aria-expanded="true"
                                   aria-controls="auctionInform">
                                    <h5 class="mb-0">
                                        Auction Information <i class="fa fa-chevron-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <!-- Card body -->
                            <div id="auctionInform" class="collapse" role="tabpanel" aria-labelledby="auctionInfo"
                                 data-parent="#accordionEx">
                                <div class="card-body">
                                    <table class="table table-no-border table-fixed">
                                        <tbody>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Name</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->auction->auction_title}} {{date("m/d/Y", strtotime($auction_item->auction->auction_end_date))}}</td>
                                        </tr>
                                        @if($seller)
                                            <tr>
                                                <th class="col-sm-4 col-md-3 col-lg-2 text-right">Auctioneer</th>
                                                <td class="col-sm-8 col-md-9 col-lg-10">
                                                    <a class="lot-company-info-link" data-company-id="33081"
                                                       href="#">{{$seller->name}}</a>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Type</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->auction->auction_type}}
                                                Auction
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Date(s)</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10"> {{date("m/d/Y", strtotime($auction_item->auction->auction_start_date))}}
                                                - {{date("m/d/Y", strtotime($auction_item->auction_end_date))}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right"></th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->auction->auction_type}}
                                                Auction!
                                                Starts: {{date("l, F dS, Y", strtotime($auction_item->auction->auction_start_date))}}
                                                @ {{$auction_item->auction->auction_timezone}}
                                                Ends: {{date("l, F dS, Y", strtotime($auction_item->auction->auction_end_date))}}
                                                @ {{$auction_item->auction->auction_timezone}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Preview Date/Time</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->auction->preview_date_time}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Checkout Date/Time</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_item->auction->checkout_date_time}}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Location</th>
                                            <td class="col-sm-8 col-md-9 col-lg-10">
                                                <a target="_blank"
                                                   href="https://maps.google.com/maps?q={{$seller->address_1}}">{{$seller->address_1}}
                                                    <br>
                                                    {{$seller->address_2}}</a>
                                            </td>
                                        </tr>
                                        <th class="col-sm-4 col-md-3 col-lg-2 text-right">Description</th>
                                        <td class="col-sm-8 col-md-9 col-lg-10">
                                            <div class="text-pre-line">{!!$auction_item->auction->description!!}</div>
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingFour4">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour4"
                               aria-expanded="false" aria-controls="collapseFour4">
                                <h5 class="mb-0">
                                    Payment Information <i class="fa fa-chevron-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseFour4" class="collapse" role="tabpanel" aria-labelledby="headingFour4"
                             data-parent="#accordionEx">
                            <div class="card-body">
                                <tbody>
                                <tr>
                                    <th class="col-sm-4 col-md-3 col-lg-2 text-right">Payment Terms</th>
                                    <td class="col-sm-8 col-md-9 col-lg-10">
                                        <div class="text-pre-line">
                                            {{$auction_item->auction->payment_info}}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingFive5">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5"
                               aria-expanded="false" aria-controls="collapseFive5">
                                <h5 class="mb-0">
                                    Shipping / Pick Up <i class="fa fa-chevron-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5"
                             data-parent="#accordionEx">
                            <div class="card-body">
                                <p> {{$auction_item->auction->payment_info}} </p>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
            </div>
        </div>
        </div>
    </section>
    @include('layouts.footers.modals')
    <!---- End of Information Accordion --->


    <div class="modal fade" id="bidHistory">
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
                                        <td>{{$bids->user?count(user_bids($auction_item->auction->id,$bids->user->id)):''}}</td>
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

@stop

@push('frontend_css')
    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=61ef85696346030019493bd2&product=inline-share-buttons"
            async="async"></script>

    <style>
        .st-last {
            display: none !important;
        }
    </style>
@endpush
@push('frontend_script')

    <script type="text/javascript">
        function getTimeRemaining(endtime) {
            const total = Date.parse(endtime) - Date.parse(new Date());
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

            updateClock();
            const timeinterval = setInterval(updateClock, 1000);
        }
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', ".bid_register", function () {
                $('#item_id').val($(this).data('item-id'))
                $('#auction_id').val($(this).data('auction-id'))
                var balance,auction_item_price;
                auction_item_price = $(this).data('item-price');
                @auth()
                    balance = {{wallet_balance(\Illuminate\Support\Facades\Auth::id())}}
                        @else
                    balance = 0;
                @endauth
                if(balance > auction_item_price){
                    $('.insuficent_balance').addClass('d-none')
                    $('.submit_bid').removeClass('d-none')
                }else{
                    $('.insuficent_balance').removeClass('d-none')
                    $('.submit_bid').addClass('d-none')
                }
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
                                watch_btn.removeClass('btn-default').addClass('btn-success').html('<i class="fa fa-times fa-lg"></i> UnWatch');
                            } else {
                                watch_btn.removeClass('btn-success').addClass('btn-default').html('<i class="fa fa-star fa-lg"></i> Watch');
                            }
                        } else {
                            watch_error.text('Sorry ! Something Wrong try again');
                        }
                        console.log();
                    }
                })
            })
        });
    </script>
@endpush