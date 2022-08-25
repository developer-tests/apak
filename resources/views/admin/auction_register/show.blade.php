@extends('layouts.admin_layout')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8"><h3 class="mb-0">Show Auction Registers</h3></div>
                            <div class="col-4 text-right">
                                <a href="{{route('auction.register.index')}}" class="btn btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row pr-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6 mb-3">User :</div>
                                    <div class="col-6 mb-3">{{$auctionRegister->user?$auctionRegister->user->name:''}}</div>
                                    <div class="col-6 mb-3">Auction :</div>
                                    <div class="col-6 mb-3">{{$auctionRegister->auction?$auctionRegister->auction->title:''}}</div>
                                    <div class="col-6 mb-3">Item :</div>
                                    <div class="col-6 mb-3">{{$auctionRegister->item?$auctionRegister->item->title:''}}</div>


                                </div>
                                <div class="row px-3">
                                    <div class="col-12 card py-3 shadow-sm">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="h4">Item Details :</span>
                                            </div>
                                            @if($auctionRegister->item)
                                                @foreach($auctionRegister->item->toArray() as $key=> $item)
                                                    @php($data = ['title','min_bidding_cost','quantity'])
                                                    @if(in_array($key,$data))
                                                        <div class="col-6 mb-3">{{$key}}</div>
                                                        <div class="col-6 mb-3">{!! $item !!}</div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-3 mt-3">
                                    <div class="col-12 card py-3 shadow-sm">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="h4">Payment Method Details :</span>
                                            </div>
                                            <div class="col-6 mb-3">Payment Method :</div>
                                            <div class="col-6 mb-3">{{ucfirst(str_replace('_',' ',$auctionRegister->payment_method))}}</div>
                                            <div class="col-6 mb-3">Payment Detail :</div>
                                            @php($payment_detail = explode(',',$auctionRegister->payment_detail))

                                            @if(count($payment_detail)>0 && paymentMethod_by_id($payment_detail[0]))
                                                @if($auctionRegister->payment_method == 'credit_card')
                                                    <div class="col-6 mb-3">{{paymentMethod_by_id($payment_detail[0])->cardnumber.' | ',paymentMethod_by_id($payment_detail[1])}}</div>
                                                @endif
                                                @if($auctionRegister->payment_method == 'mobile_money')
                                                    <div class="col-6 mb-3">{{paymentMethod_by_id($payment_detail[0])->phone_no.' | '.paymentMethod_by_id($payment_detail[0])->account_no}}</div>
                                                @endif
                                                @if($auctionRegister->payment_method == 'bit_coin')
                                                    <div class="col-6 mb-3">{{paymentMethod_by_id($payment_detail[0])->wallet_id}}</div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 card py-3 shadow-sm">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="h4">Auction Details :</span>
                                    </div>
                                    @if($auctionRegister->auction)
                                        @foreach($auctionRegister->auction->toArray() as $key=> $auction)
                                            @php($data = ['title','auction_type','auction_start_date','auction_end_date','bid_increment'])
                                            @if(in_array($key,$data))
                                                <div class="col-6 mb-3">{{$key}}</div>
                                                <div class="col-6 mb-3">{!! $auction !!}</div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('backend_css')

@endpush
@push('backend_script')

@endpush
