<header class="bidera-header">
    <div class="inner-container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <h1><a href="{{url('/')}}">{{$setting['site_title'] ?? '254 Bid'}}</a></h1>
            </div>
            <span class="toggle-btn"></span>
            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                <div class="menu-link">
                    <ul>
                        @guest()

                        @endguest
                        @auth()
                            @if(in_array(\Illuminate\Support\Facades\Auth::user()->role_id,[1,3]))
                            @else
                                <li class="d-none"><a href="#">Saller</a></li>
                            @endif
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="nav-buyer-menu"
                                       aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}} <i
                                                class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="nav-buyer-menu">

                                        <a href="{{asset('/currentbids')}}" class="dropdown-item">Current Bids</a>


                                        <a href="{{asset('/watchlist')}}" class="dropdown-item">Watch List</a>

                                        <a href="#" class="dropdown-item d-none">Top Picks</a>

                                        <a href="{{route('myauction')}}" class="dropdown-item">My Auctions</a>

                                        <a href="#" class="dropdown-item">Past Bids</a>

                                        <a href="{{route('watchlist.type','past')}}" class="dropdown-item">Past Watch List</a>

                                        <a href="{{route('payment_methods')}}" class="dropdown-item d-none">Payment Methods</a>

                                        <a href="{{route('editinfo')}}" class="dropdown-item">Account Info</a>

                                        <a href="{{route('user.logout')}}" class="dropdown-item">Logout</a>

                                    </div>
                                </li>

                            @else
                                <li>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginRegisterModal">
                                        Login / New Bidder
                                    </a>
                                </li>
                        @endauth

                        <li><a href="{{route('auctions.type','current')}}">Current Auctions</a></li>
                        <li><a href="{{route('auctions.type','past')}}">Past Auctions</a></li>
                        <!-- <li><a href="javascript:void(0);" data-toggle="modal" data-target="#registerForBidModal" >Test</a></li>  -->
                        @auth()
                            <li><a href="{{route('payment_methods')}}">
                                    Wallet : {{wallet_balance(\Illuminate\Support\Facades\Auth::id())}} Coins
                                </a></li>

                        @else
                            <li><a href="{{route('sellerlogin')}}">Seller Login</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
@if($errors->any())
<div class="alert alert-danger">
  <strong>Warning!</strong> {{$errors->first()}}
</div>
@endif
@if(session('success'))

    <div class="alert alert-success">
        <strong>Success!</strong> {{session('success')}}
    </div>
@endif