@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<section class="payment-method">
        <div class="inner-container">
            <div class="row">
                <!--Accordion wrapper-->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card">
                         <div class="card-body">
                                <form action="{{route('contact')}}" class="form-horizontal"
                                      id="" method="POST" novalidate="novalidate">
                                    {{csrf_field()}}
                                    
                                    <div class="row mobile_money_valid">
                                        <div class="col"></div>
                                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                                            <div class="form-row m-b-0  mt-4">
                                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label"
                                                       for="Month">Name</label>
                                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <div class="input-group">
                                                        <label class="hidden" for="type">Mobile Money Type</label>
                                                        <input class="form-control" name="name"
                                                            type="text" value=""
                                                           placeholder="Name" required>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-row m-b-0">
                                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label"
                                                       for="Nickname">Phone Number</label>
                                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <input class="form-control" data-val="true" id="phone_no"
                                                           data-val-length="Maximum 10 Characters" name="number"
                                                           data-val-length-max="10" type="text" value=""
                                                           data-val-required="Phone Number is required"
                                                           placeholder="Phone Number" required>
                                                    
                                                </div>
                                            </div><br>
                                            <div class="form-row m-b-0">
                                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label"
                                                       for="account_no">Email</label>
                                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <input class="form-control" data-val="true"name="email"
                                                           placeholder="Email" type="text" value="" required>
                                                    
                                                </div>
	                                        </div><br>
	                                        <div class="form-row m-b-0">
                                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label"
                                                       for="account_no">Subject</label>
                                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <input class="form-control" name="subject"
                                                           placeholder="Subject" type="text" value="" required>
                                                    
                                                </div>
	                                        </div><br>
	                                        <div class="form-row m-b-0">
                                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label"
                                                       for="account_no" >Text</label>
                                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                                    <textarea class="form-control" data-val="true"name="text"
                                                           placeholder="Text" type="text" value="" required></textarea>
                                                    
                                                </div>
	                                        </div>
	                                   </div>

                                    </div><br>
                                    
                                   
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="payment-btn text-center">
                                                <button class="btn btn-primary m-b" type="submit">Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
            </div>
        </div>
    </section>		

@endsection
