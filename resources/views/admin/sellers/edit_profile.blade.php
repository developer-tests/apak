@extends('layouts.admin_layout', ['title' => __('Seller Edit')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('My Profile') }}</h3>
                        </div>

                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('seller.update',$user->id) }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Your Information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('Display name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-display_name">{{ __('Name') }}</label>
                                    <input type="text" name="display_name" id="input-display_name"
                                           class="form-control form-control-alternative{{ $errors->has('display_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Display Name') }}"
                                           value="{{!empty($user)?$user->name:old('display_name')}}" required
                                           autofocus>

                                    @if ($errors->has('display_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('contact_email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="contact_email" id="input-contact_email"
                                           class="form-control form-control-alternative{{ $errors->has('contact_email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Contact Email') }}"
                                           value="{{!empty($user)?$user->email:old('contact_email')}}" required>

                                    @if ($errors->has('contact_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} d-none" >
                                    <label class="form-control-label"
                                           for="input-contact_number">{{ __('Password') }}</label>
                                    <input type="text" name="password" id="input-contact_number"
                                           class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Password') }}" disabled
                                           value="{{!empty($user)?$user->contact:old('password')}}">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-role">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="autocomplete_search"
                                           class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Address') }}"
                                           value="{{!empty($user)&&$user->seller?$user->seller->address_1:old('address')}}">


                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">

                                    <input type="hidden" name="lattitude" id="input-lattitude"
                                           class="form-control form-control-alternative{{ $errors->has('lattitude') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Lattitude') }}"
                                           value="{{!empty($user)?$user->lattitude:old('lattitude')}}">
                                    @if ($errors->has('lattitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lattitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">

                                    <input type="hidden" name="longitude" id="input-longitude"
                                           class="form-control form-control-alternative{{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Longitude') }}"
                                           value="{{!empty($user)?$user->longitude:old('longitude')}}">

                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM3RUZl8MZdhQTsZlUAj-613rkiW6ExvE&libraries=places"></script>

        <script>
            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {
                var input = document.getElementById('autocomplete_search');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                    $('#input-lattitude').val(place.geometry['location'].lat());
                    $('#input-longitude').val(place.geometry['location'].lng());
                });
            }
        </script>

    </div>
@endsection