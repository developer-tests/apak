@extends('layouts.admin_layout', ['title' => __('Auction')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Create Auction') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('auction.save') }}" autocomplete="off">
                        @csrf
                        
                        <h6 class="heading-small text-muted mb-4">{{ __('Auction information') }}</h6>
                        <div class="col-12 text-right">
                        <a href="{{route('auction.index')}}" class="btn btn-sm btn-primary">Back</a>
                            </div>

                        <div class="pl-lg-4">
                                                
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="container">
                        <div class="row">
                            <div class="col-sm-12 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Auction Title') }}" value="{{ old('title') }}"  autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
					
              
                            <div class="col-sm-6 form-group{{ $errors->has('auction_type') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Auction type') }}</label>
        
                                <select name="auction_type"  class="form-control form-control-alternative{{ $errors->has('auction_type') ? ' is-invalid' : '' }}">
                                <option value="">Select Auction Type</option>
                                <option value="online" {{old('auction_type') == 'online'? 'selected':''}}>Online Auction</option>
                                <option value="live_webcast" {{old('auction_type') == 'live_webcast'? 'selected':''}}>Live Webcast Auction</option>
                                <option value="absentee" {{old('auction_type') == 'absentee'? 'selected':''}}>Absentee</option>
                                </select> 
                                @if ($errors->has('auction_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('seller') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Seller') }}</label>
        
                                <select name="seller"  class="form-control form-control-alternative{{ $errors->has('seller') ? ' is-invalid' : '' }}">
                                <option value="">Select</option>
                                @foreach($seller as $sel)
                                <option value="{{$sel->id}}" {{old('seller') == $sel->id ? 'selected':''}}>{{$sel->name}}</option>
                               @endforeach
                                </select> 
                                @if ($errors->has('seller'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('seller') }}</strong>
                                    </span>
                                @endif
                            </div>
                         
							<div class="col-sm-4  form-group{{ $errors->has('auction_start_date') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_start_date">{{ __('Auction Start Date') }}</label>
                                <input type="text" value="{{old('auction_start_date')}}" onkeydown="return false" placeholder="{{ __( 'Select Start Date' ) }}" name="auction_start_date" id="input-auction_start_date" class="form-control datepicker form-control-alternative{{ $errors->has('auction_start_date') ? ' is-invalid' : '' }}">
                                @if ($errors->has('auction_start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
							<div class="col-sm-4  form-group{{ $errors->has('auction_end_date') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_end_date">{{ __('Auction End Date') }}</label>
                                <input type="text"  value="{{old('auction_end_date')}}" onkeydown="return false" placeholder="{{ __( 'Select End Date' ) }}" name="auction_end_date" id="input-auction_end_date" class="form-control datepicker form-control-alternative{{ $errors->has('auction_end_date') ? ' is-invalid' : '' }}">
                                @if ($errors->has('auction_end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4  form-group{{ $errors->has('auction_timezone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_timezone">{{ __('Auction Timezone') }}</label>
                                <input type="text"  value="{{old('auction_timezone')}}"  placeholder="{{ __( 'Select Timezone' ) }}" name="auction_timezone" id="input-auction_timezone" class="form-control form-control-alternative{{ $errors->has('auction_timezone') ? ' is-invalid' : '' }}">
                                @if ($errors->has('auction_timezone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_timezone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-sm-4  form-group{{ $errors->has('auction_end_time') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_end_time">{{ __('End Time (Should be UTC Time)') }}</label>
                                <input type="text"  value="{{old('auction_end_time')}}"  placeholder="{{ __( 'Select End Time' ) }}" name="auction_end_time" id="input-auction_end_time" class="form-control form-control-alternative{{ $errors->has('auction_end_time') ? ' is-invalid' : '' }}">
                                @if ($errors->has('auction_end_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_end_time') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-12  form-group{{ $errors->has('auction_images') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_images">{{ __('Auction Image') }}</label>
                                <input type="file" id="imgInp" name="auction_images[]" multiple class="form-control">
                                @if ($errors->has('auction_images'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_images') }}</strong>
                                    </span>
                                @endif
                                <div class="uploaded-images d-flex">
                                
                                </div>
                            </div>     
                    
                            <div class="col-sm-6  form-group{{ $errors->has('preview_date_time') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-preview_date_time">{{ __('Preview Date/Time') }}</label>
                                <input type="text" name="preview_date_time"  value="{{old('preview_date_time')}}" id="input-preview_date_time" class="form-control form-control-alternative{{ $errors->has('preview_date_time') ? ' is-invalid' : '' }}">
                                @if ($errors->has('preview_date_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('preview_date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6  form-group{{ $errors->has('checkout_date_time') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-checkout_date_time">{{ __('Checkout Date/Time') }}</label>
                                <input type="text" name="checkout_date_time" value="{{old('checkout_date_time')}}" id="input-checkout_date_time" class="form-control form-control-alternative{{ $errors->has('checkout_date_time') ? ' is-invalid' : '' }}">
                                @if ($errors->has('checkout_date_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('checkout_date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                          
                            <div class="col-sm-12 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                <textarea name="description" id="input-description" class="form-control summernote form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                           {{-- <div class="col-sm-12 form-group{{ $errors->has('terms_condition') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-terms_condition">{{ __('Terms & conditions') }}</label>
                                <textarea name="terms_condition" id="input-terms_condition" class="form-control form-control-alternative{{ $errors->has('terms_condition') ? ' is-invalid' : '' }}">{{old('terms_condition')}}</textarea>
                                @if ($errors->has('terms_condition'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('terms_condition') }}</strong>
                                    </span>
                                @endif
                            </div>--}}
                            <div class="col-sm-12 form-group{{ $errors->has('payment_info') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-payment_info">{{ __('Payement Info') }}</label>
                                <textarea name="payment_info" id="input-payment_info" class="form-control form-control-alternative{{ $errors->has('payment_info') ? ' is-invalid' : '' }}">{{old('payment_info')}}</textarea>
                                @if ($errors->has('payment_info'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_info') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-12 form-group{{ $errors->has('shipping_pickup') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-shipping_pickup">{{ __('Shipping & pickup') }}</label>
                                <textarea name="shipping_pickup" id="input-shipping_pickup" class="form-control form-control-alternative{{ $errors->has('shipping_pickup') ? ' is-invalid' : '' }}">{{old('shipping_pickup')}}</textarea>
                                @if ($errors->has('shipping_pickup'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shipping_pickup') }}</strong>
                                    </span>
                                @endif
                            </div>
                          
                            
                            <div class="col-sm-12 form-group{{ $errors->has('bidding_notes') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-bidding_notes">{{ __('Bidding Notes') }}</label>
                                <input type="text" name="bidding_notes" id="input-bidding_notes" class="form-control form-control-alternative{{ $errors->has('bidding_notes') ? ' is-invalid' : '' }}" placeholder="{{ __('Bidding Notes') }}" value="{{ old('bidding_notes') }}" >

                                @if ($errors->has('bidding_notes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bidding_notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-12 form-group{{ $errors->has('auction_notice') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-auction_notice">{{ __('Auction Notice') }}</label>
                                <input type="text" name="auction_notice" id="input-auction_notice" class="form-control form-control-alternative{{ $errors->has('auction_notice') ? ' is-invalid' : '' }}" placeholder="{{ __('Auction Notice') }}" value="{{ old('auction_notice') }}"  autofocus>

                                @if ($errors->has('auction_notice'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('auction_notice') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-12 form-group{{ $errors->has('bidding_increment') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-bidding_increment">{{ __('Bidding Increment') }}</label>
                                <input type="number" min="0" name="bidding_increment" id="input-bidding_increment" class="form-control form-control-alternative{{ $errors->has('min_bidding_cost') ? ' is-invalid' : '' }}" placeholder="{{ __('Bidding Increment') }}" value="{{ old('bidding_increment') }}"  autofocus>

                                @if ($errors->has('bidding_increment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bidding_increment') }}</strong>
                                    </span>
                                @endif
                            </div>
                           
                            
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<link href="{{ asset('frontend') }}/summernote/summernote.min.css" rel="stylesheet">
<script src="{{ asset('frontend') }}/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height:300
        });
    });
  </script>
@endsection
