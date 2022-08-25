<!--- Start Email Signup List--->
@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<section class="email-signup">
            <div class="inner-container">
                <div class="row">
                        <div class="signup-conts">
                            <h3>Change Password</h3>
                            <h4>Passwords can only contain numbers, letters, and characters ! @ # $ % ^ & * - _ , .</h4>
                            <div class="signup-form">
                                <form action="/email/subscribe/" class="form" id="subscribe-form" method="post" novalidate="novalidate"><input name="__RequestVerificationToken" type="hidden" value="kbm9nmotBOlOPzZeYB1m0RfayOKIqquYtwK-qmUX9W5Iw8UQJxmZEwTbdZJ2Cc5NJRpg51bWxu7l2zqTL61YC15duCk1">

                                    <div class="form-group">
                                        <label class="sr-only" for="Email">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input autocomplete="False" class="form-control" data-password-caps-warning="#change-password-caps-warning" data-val="true" data-val-required="Old password is required." id="change-password-old-password" name="OldPassword" placeholder="Current Password" type="password">
                                        </div>
                                        <span class="field-validation-valid help-block" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="sr-only" for="ConfirmEmail">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                            <input autocomplete="False" class="form-control" data-password-caps-warning="#change-password-caps-warning" data-val="true" data-val-bidopiapassword="Passwords can only contain numbers, letters, and characters ! @ # $ % ^ &amp; * - _ , ." data-val-bidopiapassword-pattern="^[a-zA-Z0-9!@\#\$%\^\&amp;\*\-_\,\. ]+$" data-val-length="Passwords must be at least 6 characters and no more than 20 characters." data-val-length-max="20" data-val-length-min="6" data-val-required="Passwords must be at least 6 characters and no more than 20 characters." id="change-password-password" name="Password" placeholder="New Password" type="password">
                                        </div>
                                        <span class="field-validation-valid help-block" data-valmsg-for="ConfirmEmail" data-valmsg-replace="true"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="ConfirmEmail">Confirm New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input autocomplete="False" class="form-control" data-password-caps-warning="#change-password-caps-warning" data-val="true" data-val-equalto="The new password &amp; confirm new password that you entered do not match." data-val-equalto-other="*.Password" id="change-password-confirm-password" name="ConfirmPassword" placeholder="Confirm New Password" type="password">
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