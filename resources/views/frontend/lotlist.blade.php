@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <section class="auctions-category">
        <div class="inner-container">
            <div class="row">
                <div class="tab-link">
                    <ul>
                        <li><a href="{{route('auctions.type','current')}}">Auctions</a></li>
                        <li><a href="{{route('auctions.map')}}">Auction Map</a></li>
                        <li class="active"><a href="#">Lot List</a></li>
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
            </div>
        </div>
    </section>

    <!--- End of Auction Tab --->

    <!--- Start Auction Categories --->
    @if(count($auction_items) > 0)
        <section class="auctions-category single-page d-none">
            <div class="inner-container">


                <form id="items_filter_form">
                    <div class="row mt-30">
                        <div class="lot-list-view-options col-12 col-sm-12 col-md-12 col-lg-12  text-right text-center-xs pull-right print-hidden p-b-sm p-0">
                            <div class="lot-list-view-switcher-container btn-group btn-group-toggle btn-group-sm"
                                 data-toggle="buttons">
                                <label class="btn btn-default btn-sm p-x-sm {{$data['list_view'] == 'condensed' ? 'active' : ''}}">
                                    <input type="radio" id="lot-list-view-switcher" value="condensed"
                                           class="lot-list-view-switcher" name="list_view" autocomplete="off"><i
                                            class="fa fa-lg fa-list-ol m-r-sm"></i>Condensed
                                </label>
                                <label class="btn btn-default p-x-sm {{$data['list_view'] == 'tile' ? 'active' : ''}}">
                                    <input type="radio" id="lot-list-view-tile" value="tile"
                                           class="lot-list-view-switcher " name="list_view" autocomplete="off"><i
                                            class="fa fa-lg fa-th-large m-r-sm"></i>Tile View
                                </label>
                                <label class="btn btn-default p-x-sm {{$data['list_view'] == 'full' ? 'active' : ''}}">
                                    <input type="radio" id="lot-list-view-full" value="full"
                                           class="lot-list-view-switcher" name="list_view" autocomplete="off"><i
                                            class="fa fa-lg fa-th-list m-r-sm"></i>Full View
                                </label>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </section>
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
        <!--- Start lot Box --->
        @if($data['list_view'] == 'tile')
            <section class="lot-box">
                <div class="inner-container">
                    <div class="row">
                        <div class="grid-box-main">
                            @foreach($auction_items as $key=>$item)
                                <div class="wrapper-item">
                                    <div class="box-title">
                                        <p><span>Lot {{$item->id}}</span> | {{$item->title}}</p>
                                        <i class="fa fa-info-circle"></i>
                                    </div>
                                    @php
                                        $image = getAuctionItemImage(1, $item->id);
                                    @endphp
                                    <a href="javascript:(0);" data-id="{{$item->id}}" class="abcd" data-toggle="modal"
                                       onclick="openGalleria('{{$item->id}}')" data-target="#myModalgallery{{$item->id}}">
                                        @if($image && isset($image[0]))
                                            <img src="{{isset($image[0])?url('auctions/'.$image[0]['image_name']):''}}">
                                        @endif
                                    </a>
                                    <div class="center-content">
                                        <div class="bid-status bid-status-76282044" data-event-item-id="0"
                                             data-status="nobid">
                                            <div class="bid-status-nobid"></div>
                                            <div class="bid-status-winning  hidden">
                                                <h4>
                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Winning</span>
                                                </h4>
                                            </div>
                                            <div class="bid-status-won  hidden">
                                                <h4>
                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Won</span>
                                                </h4>
                                            </div>
                                            <div class="btn btn-default btn-sm             bid-status-mayhavewonstatus  hidden"
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
                                                <h4><span class="label  lot-status lot-status-default">Watching</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <span class="lot-high-bid text-bold">{{number_format($item->min_bidding_cost,2)}} USD </span>
                                        <div class="lot-bid-history">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#bidHistory">
                                                <span>21 Bids</span>
                                            </a>
                                        </div>
                                        <span class="lot-time-left inline-block text-wrap"
                                              id="auctionTimer{{$key}}"> <span class="days">3</span>d  <span
                                                    class="hours">3</span>h <span class="minutes">3</span>m </span>
                                        <script type="text/javascript">
                                            var idd = "auctionTimer" +<?php echo $key ?>;
                                            var deadline = '<?php echo date('Y-m-d', strtotime($item->auction_end_date)) ?>';
                                            initializeClock(idd, deadline);
                                        </script>
                                    </div>
                                    <div class="cost-detail">
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                data-target="#registerForBidModal">
                                            <span>Bid</span> {{number_format($item->min_bidding_cost, 2)}}</button>
                                        <button type="button" class="btn btn-primary watch_item"
                                                data-itid="{{$item->id}}" data-aucid="{{$item->auctionid}}">
                                            <i class="fa fa-star fa-lg"></i>
                                        </button>
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
                                                             id="lot-preview-lot-number">{{$item->id}}</div>
                                                    </div>
                                                    <div id="lot-preview-bid-history-container" class="row">
                                                        <div class="col-sm-4 text-right p-r">
                                                            Bid History
                                                        </div>
                                                        <div class="col-sm-8 text-left p-l">
                                                            <a class="lot-bid-history  btn btn-link p-a-0"
                                                               href="javscript:void(0)" data-toggle="modal"
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
                                                <button class="watch-lot lowrb-trigger watch-notes-popover-trigger btn btn-default print-hidden m-x-0 watch_item">
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <span class="hidden-xs">Watch</span>
                                                </button>
                                                <button class="watch-lot lowrb-trigger unwatch-lot watch-notes-popover-trigger btn btn-default print-hidden m-x-0 hidden">
                                                    <i class="fa fa-times fa-lg"></i>
                                                    <span class="hidden-xs">Unwatch</span>
                                                </button>
                                                <a id="lot-preview-contact" class="btn btn-success lot-feedback m-x-0"
                                                   href="javascript:(0);" data-toggle="modal"
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
                                <!--- End Modal --->
                            @endforeach
                        </div>
                        <input type="hidden" id="oldid" value="">
                    </div>
                </div>
            </section>
        @endif
    @endif
   {{-- @if($data['list_view'] == 'condensed')
        <section class="condensed-layout">
            <div class="inner-container">
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tbody>
                            @foreach($auction_items as $key=>$item)
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
                                                                    <img class="inline-lot-thumbnail img-responsive"
                                                                         src="{{url('auctions/'.$image[0]['image_name'])}}">
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
                                                            <div><strong><a href=""
                                                                            class="inline-lot-number-lead lot-number-lead lot-link lot-preview-link"><b>Lot {{$item->id}}</b>
                                                                        | {{$item->title}}</a></strong></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 p-0 hidden-xs">
                                                    <div class="row m-x-0">
                                                        <div class="text-center col-2">
                                                            <a class="lot-bid-history  btn btn-link p-a-0"
                                                               href="jaavscript:void(0);" data-toggle="modal"
                                                               data-target="#bidHistory">20 Bids</a>
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
                                                                            var idd = "auctionTimer" +<?php echo $key ?>;
                                                                            var deadline = '<?php echo date('Y-m-d', strtotime($item->auction_end_date)) ?>';
                                                                            initializeClock(idd, deadline);
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="lot-date-sold-container hidden">
                                                                <span>Date Sold:</span>
                                                                <span class="lot-date-sold"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div id="lot-at-banner" class="at-banner hidden">
                                                                <img src="/Styles/images/icons/at-icon.png"
                                                                     alt="Auction Time">
                                                                Online Auction
                                                            </div>
                                                            <div id="lot-ef-banner" class="ef-banner hidden">
                                                                <img src="/Styles/images/icons/ef-icon.png"
                                                                     alt="EquipmentFacts">
                                                                On-Site Auction
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <dl class="lot-bid-max-container text-center m-b-0 hidden">
                                                                <dt>
                                                                    <span class="lot-bid-type-max">Your Max</span>
                                                                    <span class="lot-bid-type-flat">Your Bid</span>
                                                                </dt>
                                                                <dd class="lot-bid-max"></dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lot-buttons-col col-4 col-sm-4 col-md-3 col-lg-3 p-x-0">
                                                    <div class="row m-x-0">

                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center p-x-0 hidden print-visible">
                                                            <span class="lot-bid-type-max">Your Max</span>
                                                            <span class="lot-bid-type-flat">Your Bid</span>
                                                            <span class="lot-bid-max"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row m-x-0">
                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-0 inline-lot-bid-button-container print-hidden">

                                                            <div class="lot-bid-container inline-lot-bid-container text-center">
                                                                <button class="lowrb-trigger btn p-x btn-primary"
                                                                        title="Bid" type="button"
                                                                        id="lot-bid-button-76282044"><i
                                                                            class="fa fa-plus fa-lg" title="Bid"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-0 lot-inline-altbid-button-container text-center">
                                                            <a class="btn p-x btn-primary hidden"
                                                               id="lot-inline-altbid-button" href="">
                                                                <i class="fa fa-link fa-lg"></i>
                                                            </a>
                                                        </div>
                                                        <div class="bid-status bid-status-76282044"
                                                             data-event-item-id="0" data-status="nobid">
                                                            <div class="bid-status-nobid"></div>
                                                            <div class="bid-status-winning  hidden">
                                                                <h4>
                                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Winning</span>
                                                                </h4>
                                                            </div>
                                                            <div class="bid-status-won  hidden">
                                                                <h4>
                                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Won</span>
                                                                </h4>
                                                            </div>
                                                            <div class="btn btn-default btn-sm             bid-status-mayhavewonstatus  hidden"
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
                                                                <h4><span class="label  lot-status lot-status-default">Watching</span>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 p-0 inline-lot-watch-button-container print-hidden">

                                                            <button type="button"
                                                                    class="watch-lot lowrb-trigger watch-notes-popover-trigger btn btn-default p-x watch_item"
                                                                    data-itid="{{$item->id}}"
                                                                    data-aucid="{{$item->auctionid}}">
                                                                <i class="fa fa-star fa-lg" title="Watch"></i>
                                                            </button>

                                                            <div class="lot-unwatch-container text-center unwatch_item hidden"
                                                                 data-itid="{{$item->id}}"
                                                                 data-aucid="{{$item->auctionid}}">
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
                                                   href="javascript:(0);" data-toggle="modal"
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
                        <input type="hidden" id="oldid" value="">
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($data['list_view'] == 'full')
        <section class="fullview-layout">
            <div class="inner-container">
                @foreach($auction_items as $key=>$item)
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
                                                <img src="{{url('auctions/'.$image[0]['image_name'])}}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                        <div class="lot-description-container lot-description-toggle lot-description-large lot-description-ellipsis">
                                            <div class="lot-description-arrow-container">
                                                <div class="lot-description text-pre-line">
                                                    {!! $item->description !!}
                                                </div>
                                                --}}{{--
                                                <div class="lot-description-arrow">
                                                   <i class="fa fa-chevron-circle-down fa-lg text-primary"></i>
                                                </div>
                                                --}}{{--
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
                                                var deadline = '<?php echo date('Y-m-d', strtotime($item->auction_end_date)) ?>';
                                                initializeClock(idd, deadline);
                                            </script>
                                            <dlv class="lot-bid-container text-center m-b-0">
                                                <dt>High Bid</dt>
                                                <dd class="lot-high-bid" data-sealed="Sealed">1,150.00 USD</dd>
                                            </dlv>
                                            <div class="text-center m-b">
                                                <a class="lot-bid-history  btn btn-link p-a-0" href="javascript:void(0)"
                                                   data-toggle="modal" data-target="#bidHistory">20 Bids</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="bid-status bid-status-76282044" data-event-item-id="0"
                                             data-status="nobid">
                                            <div class="bid-status-nobid"></div>
                                            <div class="bid-status-winning  hidden">
                                                <h4>
                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Winning</span>
                                                </h4>
                                            </div>
                                            <div class="bid-status-won  hidden">
                                                <h4>
                                                    <span class="label  lot-status inline-block text-wrap lot-status-default">Won</span>
                                                </h4>
                                            </div>
                                            <div class="btn btn-default btn-sm             bid-status-mayhavewonstatus  hidden"
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
                                                <h4><span class="label  lot-status lot-status-default">Watching</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="inline-btn">
                                            <button class="watch-lot lowrb-trigger watch_item watch-notes-popover-trigger btn btn-default btn-block print-hidden"
                                                    type="button" data-itid="{{$item->id}}"
                                                    data-aucid="{{$item->auctionid}}">
                                                <i class="fa fa-star fa-lg"></i>
                                                <span class="hidden-xs">Watch</span>
                                            </button>
                                            <button type="button"
                                                    class="unwatch_item watch-lot lowrb-trigger watch_item watch-notes-popover-trigger btn btn-default btn-block print-hidden hidden"
                                                    data-itid="{{$item->id}}" data-aucid="{{$item->auctionid}}">
                                                <i class="fa fa-times fa-lg" title="Unwatch"></i>
                                                <span class="hidden-xs">Unwatch</span>
                                            </button>

                                            <button class="lowrb-trigger mt-10 lot-bid-button lot-bid-button-bid-amount btn btn-block print-hidden btn-primary">
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
                                                   data-toggle="modal" data-target="#bidHistory">20 Bids</a>
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
                                    <div class="lot-preview-altbid-container text-center inline-block">
                                        <a id="lot-preview-altbid-button" href="" class="btn btn-primary hidden"
                                           target="_blank" rel="noopener noreferrer">
                                        </a>
                                    </div>
                                    <div class="lot-buyitnow-container text-center inline-block">
                                        <button class="lowrb-trigger lot-buyitnow-button btn btn-primary p-x"
                                                data-ba="130" title="Buy It Now" type="button" style="display: none;">
                                            <i class="fa fa-cart-arrow-down fa-lg" title="Buy It Now"></i>
                                            <span class="lot-buyitnow-text">
                        Buy It Now
                        </span>
                                            <div>
                                                <span class="TileDisplayBuyItNowPrice"></span>
                                            </div>
                                        </button>
                                    </div>
                                    <button class="watch-lot lowrb-trigger watch-notes-popover-trigger btn btn-default print-hidden m-x-0"
                                            data-ba="6" type="button" data-bai="76282044" id="lot-watch-button-76282044"
                                            data-original-title="" title=""><i class="fa fa-star fa-lg"></i>
                                        <span class="hidden-xs">Watch</span>
                                    </button>
                                    <button class="watch-lot lowrb-trigger unwatch-lot watch-notes-popover-trigger btn btn-default print-hidden m-x-0 hidden"
                                            data-ba="10" type="button" data-bai="76282044"
                                            id="lot-unwatch-button-76282044" data-original-title="" title=""><i
                                                class="fa fa-times fa-lg"></i>
                                        <span class="hidden-xs">Unwatch</span>
                                    </button>
                                    <a id="lot-preview-contact" class="btn btn-success lot-feedback m-x-0"
                                       href="javascript:(0);" data-toggle="modal" data-target="#contactSeller">
                                        <i class="fa fa-envelope fa-lg"></i>
                                        <span class="visible-xl">Contact Auctioneer</span>
                                    </a>
                                    <a id="lot-preview-detail" href="{{route('lotdetails', $item->slug)}}"
                                       class="btn btn-default m-x-0" target="_blank">Lot Details</a>
                                    <button type="button" class="btn btn-primary m-x-0" data-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- End Modal --->
                @endforeach
            </div>
            <input type="hidden" id="oldid" value="">
        </section>
    @endif--}}

    <div class="min-height"></div>
    @include('layouts.footers.modals')
    <!--- End of  lot Box --->
@stop

@push('frontend_css')

@endpush
@push('frontend_script')
    <script>
        $(document).ready(function () {
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
    <script>

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
    </script>
@endpush