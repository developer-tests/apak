@extends('layouts.admin_layout', ['title' => __('seller Edit')])

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Bidder') }}</h3>
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{route('bidder.index')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('bidder.editer', $bidder->id) }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Seller information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="row">
                                <div class="col-md-3">
                                <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('firstname') }}</label>
                                    <input type="text" name="firstname" id="input-name" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="{{ __('firstname') }}" value="{{ old('name',  $bidder->firstname) }}" required autofocus>

                                    @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('lastname') }}</label>
                                    <input type="text" name="lastname" id="input-name" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ __('lastname') }}" value="{{ old('name',  $bidder->lastname) }}" required autofocus>

                                    @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email',  $bidder->email) }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                    <div class="col-md-3">

                                <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-company">{{ __('company_name') }}</label>
                                    <input type="text" name="company_name" id="input-company" class="form-control form-control-alternative{{ $errors->has('company_name') ? ' is-invalid' : '' }}" placeholder="{{ __('company_name') }}" value="{{ old('company',  $bidder->company) }}" required>

                                    @if ($errors->has('company_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                        <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-country">{{ __('country') }}</label>
                                            <input type="text" name="country" id="input-country" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('country') }}" value="{{ old('country',  $bidder->country) }}" required>

                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-state">{{ __('state') }}</label>
                                            <input type="text" name="state" id="input-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="{{ __('state') }}" value="{{ old('state',  $bidder->state) }}" required>

                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-city">{{ __('city') }}</label>
                                            <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('city') }}" value="{{ old('city',  $bidder->city) }}" required>

                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('postal') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-postal">{{ __('postal') }}</label>
                                            <input type="text" name="postal" id="input-postal" class="form-control form-control-alternative{{ $errors->has('postal') ? ' is-invalid' : '' }}" placeholder="{{ __('postal') }}" value="{{ old('postal',  $bidder->postal_code) }}" required>

                                            @if ($errors->has('postal'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('postal') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('phone1') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-phone1">{{ __('phone1') }}</label>
                                            <input type="text" name="phone1" id="input-phone1" class="form-control form-control-alternative{{ $errors->has('phone1') ? ' is-invalid' : '' }}" placeholder="{{ __('phone1') }}" value="{{ old('phone1',  $bidder->phone1) }}" required>

                                            @if ($errors->has('phone1'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone1') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group{{ $errors->has('phone2') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-phone2">{{ __('phone2') }}</label>
                                            <input type="text" name="phone2" id="input-phone2" class="form-control form-control-alternative{{ $errors->has('phone2') ? ' is-invalid' : '' }}" placeholder="{{ __('phone2') }}" value="{{ old('phone2',  $bidder->phone2) }}" required>

                                            @if ($errors->has('phone2'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone2') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('fax') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-fax">{{ __('fax') }}</label>
                                            <input type="text" name="fax" id="input-fax" class="form-control form-control-alternative{{ $errors->has('fax') ? ' is-invalid' : '' }}" placeholder="{{ __('fax') }}" value="{{ old('fax',  $bidder->fax) }}" required>

                                            @if ($errors->has('fax'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fax') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
@endsection