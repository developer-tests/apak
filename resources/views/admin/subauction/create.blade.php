@extends('layouts.admin_layout', ['title' => __('Auction')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Create Auction Item') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('item.save') }}" autocomplete="off">
                        @csrf
                        
                        <h6 class="heading-small text-muted mb-4">{{ __('Auction item information') }}</h6>
                        <div class="col-12 text-right">
                        <a href="{{route('item.index', $auctionid)}}" class="btn btn-sm btn-primary">Back</a>
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
                            <div class="col-sm-6 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Auction Title') }}" value="{{ old('title') }}"  autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
					
                            <div class="col-sm-6 form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Category') }}</label>
        
                                <select name="category"  class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}">
                                <option value="">Select</option>
                                @foreach($category as $ct)
                                <option value="{{$ct->id}}" {{$ct->id == old('category') ? 'selected':''}}>{{$ct->title}}</option>
                                @endforeach
                                </select> 
                                @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
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
                                <input type="hidden" name="auctionid" value="{{$auctionid}}">
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
                            <div class="col-sm-12 form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-quantity">{{ __('Quantity') }}</label>
                                <input type="number" min="0" name="quantity" id="input-min_bidding_cost" class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}" placeholder="{{ __('Quantity') }}" value="{{ old('quantity') }}"  autofocus>

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-12 form-group{{ $errors->has('min_bidding_cost') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-min_bidding_cost">{{ __('Minimum Bidding Cost') }}</label>
                                <input type="number" min="0" name="min_bidding_cost" id="input-min_bidding_cost" class="form-control form-control-alternative{{ $errors->has('min_bidding_cost') ? ' is-invalid' : '' }}" placeholder="{{ __('Minimum Bidding Cost') }}" value="{{ old('min_bidding_cost') }}"  autofocus>

                                @if ($errors->has('min_bidding_cost'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_bidding_cost') }}</strong>
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
