@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <section class="banner">
        <img src="{{ asset('siteimages/'.$setting['site_banner']) }}">
        <div class="banner-conts">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="inner-conts">
                            <h1>{{$setting['site_name']}}</h1>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="banner-form">
                            <i class="fa fa-envelope-o"></i>
                            <div class="alert-form">
                                <h4>{{$setting['contact_number']}}</h4>
                                <form id="subForm" action="<?php echo route('subscribe')?>" onsubmit="return false">
                                    {{csrf_field()}}
                                    <input type="email" placeholder="Enter Email for Auction Alerts..." requierd
                                           name="sub_email" id="sub_email">
                                    <input class="btn btn-sub" type="submit" onClick="subscribe()" value="SUBMIT">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--- End of Banner ---->

    <!--- Start Banner Strip --->

    <section class="strip-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="d-flex justify-content-around">
                        <h5>{{$setting['banner_heading']}}</h5>
                        <a href="{{route('auctions.type','current')}}" class="border-btn">SEE UPCOMING</a>
                        <a href="#"><img src="images/google-play.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--- End of Banner Strip --->
    <!--- Start Client Logo --->
    @if(count($partners_logos) > 0)
        <section class="client-logo">
            <div class="container">
                <div class="row">
                    @foreach($partners_logos as $p)
                        <div class="logo-item">
                            <a href="{{ !empty($p->logo_link) ? $p->logo_link:'#'}}"><img
                                        src="{{url('partnerlogos/'.$p->logo_image_name)}}"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--- End of Client Logo -->

    <!--- Start Upcoming Auction --->

    <section class="upcoming-auction">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="upcoming-hdng">

                        <h5>Upcoming Auctions</h5>
                        @foreach($upcoming as $key=> $up)
                            <div class="row mt-4">
                                <div class="col-12 shadow-sm">

                                    <a href="{{route('catalog', $up->slug)}}">Online, {{$up->title}} |
                                        ends {{date('m-d-Y', strtotime($up->auction_end_date))}}</a>
                                    @if($up->images)
                                        <div class="owl-carousel owl-theme autoplay-slider">
                                            @foreach($up->images as $im)
                                                <div class="item">
                                                    <img class="img-fluid" src="{{url('auctions/'.$im->image_name)}}">
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--- End of Upcoming Auction --->

@endsection
