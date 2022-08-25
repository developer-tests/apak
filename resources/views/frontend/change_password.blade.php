<!--- Start Email Signup List--->
@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<section class="email-signup">
            <div class="inner-container">
                <div class="row">
                        <div class="signup-conts">
                            <h3>Change Password</h3>
                            <h4>Passwords can only contain numbers, letters, and characters ( ! @ # $ ...)</h4>
                            <div class="signup-form">
                                <form action="{{route('account.password')}}" class="form" id="subscribe-form" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="sr-only" for="Email">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input autocomplete="False" class="form-control" id="old-password" name="OldPassword" placeholder="Current Password" type="password">
                                        </div>
                                        <span class="field-validation-valid help-block" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="sr-only" for="ConfirmEmail">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                            <input class="form-control" id="change-password" name="password" placeholder="New Password" type="password">
                                        </div>
                                        <span class="field-validation-valid help-block" data-valmsg-for="ConfirmEmail" data-valmsg-replace="true"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="ConfirmEmail">Confirm New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input autocomplete="False" class="form-control" data-password-caps-warning="#change-password-caps-warning" data-val="true" data-val-equalto="The new password &amp; confirm new password that you entered do not match." data-val-equalto-other="*.Password" id="change-password-confirm-password" name="password_confirmation" placeholder="Confirm New Password" type="password">
                                        </div>
                                        <span class="field-validation-valid help-block" data-valmsg-for="ConfirmEmail" data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Save New Password</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                </div>
            </div>
        </section>

    <!--- End of Email Signup List--->
    @endsection