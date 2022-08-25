
@extends('layouts.app', ['class' => 'bg-default'])
@section('content')
    <section class="auctions-list collapse-btn">
        <div class="inner-container">
            <div class="row">
                <div class="col" style="min-height: 240px">
                    <span class="h5"> Your Wallet Balance : {{$balance}} Coins</span>
                    <button class="btn btn-primary float-right" data-toggle="modal" id="add_to_wallet"
                            data-target="#add_wallet_amount" data-dismiss="modal"> Add to Wallet
                    </button>
                </div>
            </div>
        </div>
    </section>

@endsection