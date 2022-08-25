<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '254Bid Dashboard') }}</title>
        <!-- Favicon -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/cssmenucss.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/fonts/stylesheet.css">
           <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
     <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/js/galleria.azur.css" />

    <script type="text/javascript" src="{{ asset('frontend') }}/js/galleria.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/galleria.azur.js"></script>
    
    </head>
    <body>
       
    <a id="back2Top" title="Back to top" href="#" style="display: none;"><i class="fa fa-angle-right"></i></a>
            @include('layouts.navbars.feheader')
            @yield('content')
           @include('layouts.footers.fefooter')
        
        
	    <!-- The Modal -->
    <div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Login / New Bidder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form action="/api/v1/buyer/logon/" class="form" id="logon-form" method="POST" novalidate="novalidate"><input name="__RequestVerificationToken" type="hidden" value="eKw4Rtc4XnrBwnHDug30KES4v0dhtXb_kcTQJ0oSIg7tnmiJKatSriNFyHpfUEU7gS7mab-IGpGM7rXfEDyqUaJ4rM01"><input id="logon-return-url" name="ReturnUrl" type="hidden" value=""><div id="logon-password-caps-warning" class="alert alert-warning" style="display:none;">
                    <i class="fa fa-exclamation"></i>
                    Caps lock is on.
                </div>  <div id="logon-invalid-user-password" class="alert alert-danger text-center" style="display:none">
                        <i class="fa fa-exclamation"></i>
                        <span id="logon-invalid-user-password-message"></span>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="UserName">User Name or Email</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input class="form-control" data-val="true" data-val-required="User Name is required." id="logon-username" name="UserName" placeholder="User Name or Email" type="text" value="" aria-required="true">
                        </div>
                        <span class="field-validation-valid help-block" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Password">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input class="form-control" data-password-caps-warning="#logon-password-caps-warning" data-val="true" data-val-required="Password is required." id="Password" name="Password" placeholder="Password" type="password" aria-required="true">
                        </div>
                        <span class="field-validation-valid help-block" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                        <div class="help-block text-right">
                            <u><a href="/account/resetpassword/">Forgot your password?</a></u>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input checked="checked" data-val="true" data-val-required="The RememberMe field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true">
                        <label for="RememberMe">
                            Keep me signed in (Uncheck if you're on a shared computer)
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Log On</button>
                        <a class="btn btn-default" href="" id="new-account">New Bidder? Click Here</a>
                    </div>
                   
                </form>
            </div>
        </div>
        </div>
    </div>
<!--- End Modal --->
    
    <script type="text/javascript" src="{{ asset('frontend') }}/js/script.js"></script>
     

    </body>
</html>