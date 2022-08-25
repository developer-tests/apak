@extends('layouts.admin_layout', ['title' => __('User Create')])

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create Role') }}</h3>
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{route('role.index')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('role.save') }}" autocomplete="off">
                            @csrf
                           
                            <h6 class="heading-small text-muted mb-4">{{ __('Role') }}</h6>
       

                            <div class="pl-lg-4">
                                                 
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                                <div class="form-group{{ $errors->has('role_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="role_name" id="input-role_name" class="form-control form-control-alternative{{ $errors->has('role_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('role_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-permissions">{{ __('Permissions') }}</label>
                                    <br/>
                                    <label class="form-check-label" for="all">
                                        <input type="checkbox" id="all" name="permissions[]" value="all">
                                        All
                                    </label>
                                    <label class="form-check-label" for="auction">
                                       <input type="checkbox" id="auction" name="permissions[]" value="auction">
                                        Auction
                                    </label>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-permissions">{{ __('Permissions') }}</label>
                                    <br/>
                                    <label class="form-check-label" for="all">
                                        <input type="checkbox" id="all" name="permissions[]" value="all">
                                        All
                                    </label>
                                    <label class="form-check-label" for="auction">
                                       <input type="checkbox" id="auction" name="permissions[]" value="auction">
                                        Auction
                                    </label>
                                    
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