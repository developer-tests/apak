@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

    <section class="auctions-category">
        <div class="inner-container">
            <div class="row">
                <div class="tab-link">
                    <ul>
                        <li><a href="{{asset('/currentbids')}}">Current Bids</a></li>
                        <li class="active"><a href="#">Watch Lists</a></li>
                        <li><a href="{{route('auctions.past_lots')}}">Lot List</a></li>
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
                <div class="alert alert-warning text-center print-hidden">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>WARNING:</strong>
                    <a href="#" class="lot-filter-refresh alert-link">Click here to refresh the page and get updated bid
                        amounts, time left, and bid status.</a>
                </div>

                <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert">
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
                            <a id="lot-list-buyer-status-top-watching" href="#"
                               class="btn btn-xs lot-status lot-status-watching"
                               title="Watched Lots">{{count($auction_ids)}}</a>
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
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-none">
                            <div class="lot-list-view-switcher-container btn-group btn-group-toggle btn-group-sm right-float">
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
                            <div class="dataTables_info show-results" id="lot-list_info" role="status"
                                 aria-live="polite">Showing 1 to 50 of 80 lots
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($auctions as $auction)

                    <div class="view-catalog">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <a href="{{route('catalog',$auction->slug)}}"><h4>{{$auction->title}}</h4></a>
                                <a href="#"><p>Miami, FL</p></a>
                                <span class="light-font">{{date('Y-m-d',strtotime($auction->auction_start_date))}} - {{date('Y-m-d',strtotime($auction->auction_end_date))}}</span>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="view-catalog-btn">
                                    <a href="{{route('catalog',$auction->slug)}}"><i class="fa fa-book fa-lg"></i><span>View Catalog</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($auction->items as $value)
                        <!---- Start Condensed Layout --->
                        @if(in_array($value->id,$item_ids->toArray()))
                        <div class="bid-status-border-watching">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3 col-md-3 col-lg-3 col-xl-3">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="watched-images">
                                                    <a href="#"><img src="images/thumbs_img3.jpg"></a>
                                                    <div class="watch-star">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                <div class="lots-title">
                                                    <span><p><span>Lot {{$value->id}}</span> | {{$value->title}}</p></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                                <a href="#" class="history-lot">{{$value->bidds->count()}} Bids</a>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                <div class="label-info padding-top">
                                                    <span class="text-wrap">{{getBidTime($auction->auction_start_date,$auction->auction_end_date)}}  </span>
                                                    <i class="lot-time-extended fa fa-clock-o hidden"></i>
                                                </div>
                                                <div class="info-text">
                                                    <i class="fa hidden-sm fa-info-circle"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="high-bid">
                                                    <span>High Bid</span>
                                                    <div class="lot-high-bid">{{$value->bidds->max('amount')?$value->bidds->max('amount'):0}}
                                                        USD
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="bid-status-watching">
                                                    <h4><span class="label  lot-status lot-status-watching">Watching</span>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="space-brtween">
                                                    @auth
                                                        <button class="btn btn-primary openBidModal"
                                                                title="Bid" type="button" data-item-id="{{$value->id}}"
                                                                data-item-price="{{$value->min_bidding_cost}}"
                                                                data-auction-id="{{$value->auction->id}}">
                                                            <i class="fa fa-plus fa-lg" title="Bid"></i>
                                                            @endauth
                                                            @guest
                                                                <button class="lowrb-trigger btn p-x btn-primary"
                                                                        title="Bid" type="button" data-toggle="modal"
                                                                        data-target="#loginRegisterModal"><i
                                                                            class="fa fa-plus fa-lg" title="Bid"></i>
                                                                    @endguest
                                                                </button>
                                                                <button class="btn btn-default p-x unwatchItem"
                                                                        type="button" title="" data-itid="{{$value->id}}"
                                                                        data-aucid="{{$auction->id}}"><i
                                                                            class="fa fa-times fa-lg" title="Unwatch"></i>
                                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                        <span class="edit-notes"><i class="fa fa-pencil"></i>Click to add notes.</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                <!---- End of Condensed Layout --->

                @endforeach
                <div id="lot-list-buyer-status-top" class="alert alert-info highbid-alert">
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
                            <a id="lot-list-buyer-status-top-watching" href="#"
                               class="btn btn-xs lot-status lot-status-watching"
                               title="Watched Lots">{{count($auction_ids)}}</a>
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
    <script>
        $(document).on('click', '.openBidModal', function () {
            var id = $(this).attr("id");
            $('#registerForBidModal').modal('show');
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

        });
        $(document).on('click', '.unwatchItem', function () {
            $.ajax({
                url: "{!! route('watchlist.store') !!}",
                type: 'POST',
                data: {item_id: $(this).data('itid'), auction_id: $(this).data('aucid'), _token: '{{csrf_token()}}'},
                success: function (data) {
                    window.location.reload();
                }
            })

        })
    </script>
@endsection