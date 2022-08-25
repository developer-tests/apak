@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
 <section class="auctions-category">
            <div class="inner-container">
                <div class="row">
                    <div class="tab-link">
                        <ul>
                            <li class="active"><a href="#">Auctions</a></li>
                            <li><a href="{{route('auctions.map')}}">Auction Map</a></li>
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
                                <select class="form-control" id="auction-search-category" name="cat"><option value="">All Groups &amp; Categories</option>
                                @foreach($category as $ct)
                                    <option value="{{$ct->id}}" {{!empty($data["cat"]) && $ct->id== $data['cat'] ? 'selected':''}}>{{$ct->title}} ({{$ct->item_count}})</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--- End of Auction Tab --->

    <!--- Start Auctions List --->

        <section class="auctions-list">
            <div class="inner-container">
                <div class="row">
                    

            <!--- Start Category Result List ---> 
            @foreach($auctions as $auction)       
                    <div class="filter-show">
                        <div class="city-title">
                        <a href="{{route('catalog', $auction->slug)}}"><p><i class="fa fa-clock-o fa-lg" title="Online-Only Auction"></i>{{$auction->title}} {{date('m/d/Y',strtotime($auction->auction_start_date))}}</p></a>
                        </div>
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 pr-0">
                        <div class="location-img">
                        @php
                        $image = fetchAuctionImage($auction->id)
                        @endphp
                            <img src="{{url('auctions/'.$image[0]->image_name)}}">
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
                        @php
                        $seller = getSellerDetailBySellerID($auction->sellerid);
                        @endphp
                            <p><a href="#"><strong>{{$seller[0]->name}}</span></a></strong></p>
                            <p><a href="#" class="add">{{$seller[0]->address_1}}</br>
                            {{$seller[0]->address_2}}</a></p>
                            <div class="date">Date(s)  - {{date('m/d/Y',strtotime($auction->auction_start_date))}} {{date('m/d/Y',strtotime($auction->auction_end_date))}}</div>
                            <p>{{$auction->auction_type}} Auction</p>
                            <p>Starts: {{date('l, F dS, Y',strtotime($auction->auction_start_date))}} @ {{$auction->auction_timezone}}</p>
                            <p>Ends: {{date('l, F dS, Y',strtotime($auction->auction_end_date))}} @ {{$auction->auction_timezone}}</p>

                            <div class="city-name-date">
                                <p>City of Miramar Surplus Auction 10/06/2020</p>
                            </div>
                        </div>
                    </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="catalog-btn">
                                <ul>
                                    <li><a href="{{route('catalog', $auction->slug)}}"><i class="fa fa-flag fa-lg"></i><span>Bidding Open</span></a></li>
                                    <li><a href="{{route('catalog', $auction->slug)}}"><i class="fa fa-clock-o fa-lg" title="Online-Only Auction"></i><span>Online-Only Auction</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                        @if(!empty($auction->bidding_notes))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Bidding Notice:</strong> {{$auction->bidding_notes}} 
                            </div>
                            @endif
                            @if(!empty($auction->auction_notice))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Auction Notice:</strong> {{$auction->auction_notice}}
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="three-btn">
                                        <ul>
                                        <li><a href="{{route('auction-detail', $auction->slug)}}"><i class="fa fa-info fa-lg"></i> <span>Auction Details</span></a></li>
                                                    @auth
                                                    <li><a href="javascript:(0);" data-toggle="modal" data-target="#registerBidModal"><i class="fa fa-gavel fa-lg"></i> <span>Register to Bid</span></a></li>
                                                    @endauth
                                                    @guest
                                                    <li><a href="javascript:(0);" data-toggle="modal" data-target="#loginRegisterModal"><i class="fa fa-gavel fa-lg"></i> <span>Register to Bid</span></a></li>
                                                    @endguest
                                                     <li><a href="{{route('catalog', $auction->slug)}}"><i class="fa fa-book fa-lg"></i> <span>View Catalog	<strong class="hidden-xs hidden-sm">({{itemCount($auction->id)}} Lots)</strong>
                                                    </span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!--- End of show category list --->

            @endforeach        
                       
                </div>
            </div>
        </section>
        
    <!--- End of Auctions List --->
@endsection