@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <section class="auctions-list collapse-btn">
        <div class="inner-container">
            <div class="row">
                <!--- Start Category Result List --->
                <div class="city-title">
                    <p><i class="fa fa-clock-o fa-lg"
                          title="Online-Only Auction"></i> {{$auction_detail->title}} {{date('m/d/Y',strtotime($auction_detail->auction_start_date))}}
                    </p>
                </div>
                <div class="filter-show">
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 pr-0">
                        <div class="location-img">
                            <img src="{{url('auctions/'.$auction_detail->auction_image)}}">
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
                            @if($seller)
                                <p><a href="#"><strong>{{$seller->name}}</strong></a></p>
                                <p><a href="#" class="add">{{$seller->address_1}}</br>
                                        {{$seller->address_2}}</a></p>
                            @endif
                            <div class="date">Date(s)
                                - {{date('m/d/Y',strtotime($auction_detail->auction_start_date))}} {{date('m/d/Y',strtotime($auction_detail->auction_end_date))}}</div>
                            <p>{{$auction_detail->auction_type}} Auction</p>
                            <p>Starts: {{date('l, F dS, Y',strtotime($auction_detail->auction_start_date))}}
                                @ {{$auction_detail->auction_timezone}}</p>
                            <p>Ends: {{date('l, F dS, Y',strtotime($auction_detail->auction_end_date))}}
                                @ {{$auction_detail->auction_timezone}}</p>

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
                                <li><a href="#"><i class="fa fa-flag fa-lg"></i><span>Bidding Open</span></a></li>
                                <li><a href="#"><i class="fa fa-clock-o fa-lg" title="Online-Only Auction"></i><span>Online-Only Auction</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        @if(!empty($auction_detail->bidding_notes))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Bidding
                                    Notice:</strong> {{$auction_detail->bidding_notes}}
                            </div>
                        @endif
                        @if(!empty($auction_detail->auction_notice))
                            <div class="alert alert-primary" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Auction
                                    Notice:</strong> {{$auction_detail->auction_notice}}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="three-btn">
                                    <ul>
                                        <li><a href="{{route('auction-detail', $auction_detail->slug)}}"><i
                                                        class="fa fa-info fa-lg"></i> <span>Auction Details</span></a>
                                        </li>
                                        @auth
                                            <li><a href="javascript:(0);" data-toggle="modal"
                                                   data-target="#registerForBidModal"><i class="fa fa-gavel fa-lg"></i>
                                                    <span>Register to Bid</span></a></li>
                                        @endauth
                                        @guest
                                            <li><a href="javascript:(0);" data-toggle="modal"
                                                   data-target="#loginRegisterModal"><i class="fa fa-gavel fa-lg"></i>
                                                    <span>Register to Bid</span></a></li>
                                        @endguest
                                        <li><a href="{{route('catalog', $auction_detail->slug)}}"><i
                                                        class="fa fa-book fa-lg"></i> <span>View Catalog	<strong
                                                            class="hidden-xs hidden-sm">({{count($auction_items)}} Lots)</strong>
                                                    </span></a></li>
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

    <!--- End of Auctions List --->
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
                            <div class="card-header" role="tab" id="headingOne1">
                                <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1"
                                   aria-expanded="true"
                                   aria-controls="collapseOne1">
                                    <h5 class="mb-0">
                                        Auction Information <i class="fa fa-chevron-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>

                            <!-- Card body -->
                            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                                 data-parent="#accordionEx">
                                <div class="card-body">
                                    <table class="table table-no-border table-fixed">
                                        <tbody>
                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Name</th>

                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_detail->title}} {{date("m/d/Y", strtotime($auction_detail->auction_start_date))}}
                                                - {{date("m/d/Y", strtotime($auction_detail->auction_end_date))}}</td>
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

                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_detail->auction_type}}
                                                Auction
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Date(s)</th>

                                            <td class="col-sm-8 col-md-9 col-lg-10"> {{date("m/d/Y", strtotime($auction_detail->auction_start_date))}}
                                                - {{date("m/d/Y", strtotime($auction_detail->auction_end_date))}}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right"></th>

                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_detail->auction_type}}
                                                Auction!

                                                Starts: {{date("l, F dS, Y", strtotime($auction_detail->auction_start_date))}}
                                                @ {{$auction_detail->auction_timezone}}
                                                Ends: {{date("l, F dS, Y", strtotime($auction_detail->auction_end_date))}}
                                                @ {{$auction_detail->auction_timezone}}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Preview Date/Time</th>

                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_detail->preview_date_time}}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Checkout Date/Time</th>

                                            <td class="col-sm-8 col-md-9 col-lg-10">{{$auction_detail->checkout_date_time}}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-sm-4 col-md-3 col-lg-2 text-right">Location</th>

                                            <td class="col-sm-8 col-md-9 col-lg-10">
                                                @if($seller)
                                                <a target="_blank"
                                                   href="https://maps.google.com/maps?q={{$seller->address_1}}">{{$seller->address_1}}
                                                    <br>
                                                    {{$seller->address_2}}</a>
                                                @endif
                                            </td>
                                        </tr>

                                        <th class="col-sm-4 col-md-3 col-lg-2 text-right">Description</th>

                                        <td class="col-sm-8 col-md-9 col-lg-10">
                                            <div class="text-pre-line">{!!$auction_detail->description!!}</div>
                                        </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- Accordion card -->
                    {{--
                      <!-- Accordion card-->
                      <div class="card">


                        <div class="card-header" role="tab" id="headingTwo2">
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                            aria-expanded="false" aria-controls="collapseTwo2">
                            <h5 class="mb-0">
                                Terms and Conditions <i class="fa fa-chevron-down rotate-icon"></i>
                            </h5>
                          </a>
                        </div>


                        <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                          data-parent="#accordionEx">
                          <div class="card-body">
                           </div>
                        </div>

                      </div>
                      <!-- Accordion card -->

                      <!-- Accordion card -->
                     <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree3">
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                            aria-expanded="false" aria-controls="collapseThree3">
                            <h5 class="mb-0">
                                Bid Increments <i class="fa fa-chevron-down rotate-icon"></i>
                            </h5>
                          </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                          data-parent="#accordionEx">
                          <div class="card-body">
                            <div>Your bid must adhere to the bid increment schedule.</div>
                            <table class="table table-no-border">
                                <tbody><tr>
                                    <th>Bid Amount</th>
                                    <th>Bid Increment</th>
                                </tr>


                                    <tr>
                                        <td>
                                            0.00
                                            <span>-</span>
                                            100.00
                                        </td>
                                        <td>
                                            5.00 USD
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            100.01
                                            <span>-</span>
                                            100,000.00
                                        </td>
                                        <td>
                                            25.00 USD
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            100,000.01
                                            <span>-</span>
                                            9,999,999.99
                                        </td>
                                        <td>
                                            10,000.00 USD
                                        </td>
                                    </tr>
                            </tbody></table>
                          </div>
                        </div>

                      </div>--}}
                    <!-- Accordion card -->

                        <!-- Accordion card -->
                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header" role="tab" id="headingFour4">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx"
                                   href="#collapseFour4"
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
                                    {{$auction_detail->payment_info}}
                                </div>
                            </div>

                        </div>
                        <!-- Accordion card -->

                        <!-- Accordion card -->
                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header" role="tab" id="headingFive5">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx"
                                   href="#collapseFive5"
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
                                    {{$auction_detail->shipping_pickup}}
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

    <!---- End of Information Accordion --->




    <div class="min-height"></div>


    <!--- End of  lot Box --->

@endsection
