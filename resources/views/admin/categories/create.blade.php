@extends('layouts.admin_layout', ['title' => __('Category Create')])

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create Category') }}</h3>
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{route('category.index')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('category.save') }}" autocomplete="off">
                            @csrf
                           
                            <h6 class="heading-small text-muted mb-4">{{ __('Category information') }}</h6>
       

                            <div class="pl-lg-4">
                                                 
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('parent') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-parent">{{ __('Parent') }}</label>
                                   <select name="parent" class="form-control">
                                   <option value="">Select</option>
                                        @foreach($allcat as $ac)
                                        <option value="{{$ac->id}}"  {{$ac->id == old('parent') ? 'selected':''}}>{{$ac->title}}</option>
                                        @endforeach
                                   </select>
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