@extends('layouts.admin_layout', ['title' => __('Category Create')])

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create Partners Logo') }}</h3>
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{route('partnerslogo.index')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('partnerslogo.save') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                           
                            <h6 class="heading-small text-muted mb-4">{{ __('Partners Logo information') }}</h6>
       

                            <div class="pl-lg-4">
                                                 
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                                <div class="form-group{{ $errors->has('logo_title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-logo_title">{{ __('Logo Title') }}</label>
                                    <input type="text" name="logo_title" id="input-logo_title" class="form-control form-control-alternative{{ $errors->has('logo_title') ? ' is-invalid' : '' }}" placeholder="{{ __('Logo Title') }}" value="{{ old('logo_title') }}" required autofocus>

                                    @if ($errors->has('logo_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('logo_link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-parent">{{ __('Logo link(URL)') }}</label>
                                    <input type="text" name="logo_link" id="input-logo_link" class="form-control form-control-alternative{{ $errors->has('logo_link') ? ' is-invalid' : '' }}" placeholder="{{ __('Logo Link') }}" value="{{ old('logo_link') }}" autofocus>

                                    @if ($errors->has('logo_link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('logo_image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-logo_image">{{ __('Logo Image') }}</label>
                                    <input type="file" id="imgInp" name="logo_image" class="form-control form-control-alternative{{ $errors->has('logo_image') ? ' is-invalid' : '' }}">
                                    @if ($errors->has('logo_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo_image') }}</strong>
                                        </span>
                                    @endif
                                 
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
        
       
    </div>
@endsection