@extends('layouts.admin_layout', ['title' => __('Wallet Update')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            @if(session('success'))
                    <div class="col-12">

                        <div class="alert alert-success alert-dismissible " role="alert">
                            <strong><i class="fa fa-info-circle"></i> Success:</strong>
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">


                            <h3 class="col-12 mb-0">{{ __('Entry Charge') }}</h3>


                        </div>

                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('entry.save') }}" autocomplete="off">
                            @csrf

                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-contact_number">{{ __('Amount') }}</label>
                                <input type="number" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Amount') }}" value="{{$amount}}" required>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection