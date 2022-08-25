@extends('layouts.admin_layout', ['title' => __('Wallet Update')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">


                            <h3 class="col-12 mb-0">{{ __('Wallet Update') }}</h3>


                        </div>

                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('balance_update') }}" autocomplete="off">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                                <div class="form-group{{ $errors->has('Users') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-site_name">{{ __('Users') }}</label>
                                    <select name="users" id="users" class="form-control form-control-alternative{{ $errors->has('Users') ? ' is-invalid' : '' }}">
                                        <option>Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>

<!--
                                    <input type="text" name="site_name" id="input-site_name" class="form-control form-control-alternative{{ $errors->has('site_name') ? ' is-invalid' : '' }}"placeholder="{{ __('Site Name') }}" value="{{!empty($data)?$data['site_name']: old('site_name')}}" required >
-->

                                    @if ($errors->has('Users'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Users') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('transaction_type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Transaction Type') }}</label>
<!--                                    <input type="email" name="contact_email" id="input-contact_email" class="form-control form-control-alternative{{ $errors->has('transaction_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Contact Email') }}" value="{{!empty($data)?$data['contact_email']:old('contact_email')}}" required>-->
                                    <select name="transaction_type" id="transaction_type" class="form-control form-control-alternative{{ $errors->has('transaction_type') ? ' is-invalid' : '' }}">
                                        <option>Credit</option>
                                        <option>Debit</option>
                                    </select>
                                    @if ($errors->has('transaction_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('transaction_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-contact_number">{{ __('Amount') }}</label>
                                    <input type="number" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Amount') }}">

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group{{ $errors->has('remark') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-contact_number">{{ __('Remark') }}</label>
                                <input type="text" name="remark" id="input-remark" class="form-control form-control-alternative{{ $errors->has('remark') ? ' is-invalid' : '' }}" placeholder="{{ __('Remark') }}">

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