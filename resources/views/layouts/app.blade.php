<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '254Bid Dashboard') }}</title>
    <!-- Favicon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cssmenucss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/stylesheet.css') }}">
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/js/galleria.classic.min.css') }}"/>

    <script type="text/javascript" src="{{ asset('frontend/js/galleria.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/galleria.classic.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.6/jquery.validate.unobtrusive.min.js"></script>
    <style>
        .help-blocks.field-validation-error, .field-validation-valid.help-block span {
            color: #da3015;
        }
    </style>
    @stack('frontend_css')
</head>
<body>

<a id="back2Top" title="Back to top" href="#" style="display: none;"><i class="fa fa-angle-right"></i></a>
@include('layouts.navbars.feheader')
@yield('content')
@include('layouts.footers.fefooter')


<!-- The Login Modal -->
<div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Login / New Bidder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form onsubmit="return false" action="<?php echo route('user.login'); ?>" class="form"
                      id="loginForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="sr-only" for="UserName">User Name or Email</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input class="form-control" autocomplete="off" id="email" name="email" placeholder="Email"
                                   type="text" value="" aria-required="true">
                        </div>
                        <span class="field-validation-valid error-block"></span>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Password">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input class="form-control" autocomplete="off" id="password" name="password"
                                   placeholder="Password" type="password" aria-required="true">
                        </div>
                        <span class="field-validation-valid error-block"></span>
                        <div class="help-block text-right">
                            <u><a href="{{ route('password.request') }}">Forgot your password?</a></u>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-login" type="submit" onClick="userLogin()">Log On</button>
                        <a class="btn btn-default" href="javascript:void(0);" id="new-account">New Bidder? Click
                            Here</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--- End Modal --->
<!-- The Login Modal -->
<div class="modal fade" id="add_wallet_amount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Coin in Wallet</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="form" id="add_wallet">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class=" wallet_amount">
                            <input type="text" class="form-control" id="process_payment"
                                   placeholder="Please Enter Amount" name="add_amount">
                            <hr>
                        </div>
                        <input type="hidden" id="prev_url" name="prev_url" value="{{base64_encode(url()->current())}}">

                        <div class="btn btn-primary" id="add_to_wallet" onclick="add_to_wallet();"> Add to
                            Wallet
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--- End Modal --->
<!-- The Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Step 1: Check Email Address... (Every account must use a unique email
                    address)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="regstep1">
                    <form onsubmit="return false" action="<?php echo route('user.register'); ?>" class="form"
                          id="registerForm" method="POST" novalidate="novalidate">
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                                <input class="form-control" id="useremail" name="email" placeholder="Email"
                                       type="text" value="" aria-required="true">
                            </div>
                            <span class="field-validation-valid error-block"></span>
                        </div>
                        <div class="form-group">

                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-check"></i>
                            </span>
                                <input class="form-control" id="useremail_confirmation" name="email_confirmation"
                                       placeholder="Confirm Email" type="text" aria-required="true">
                            </div>
                            <span class="field-validation-valid error-block"></span>

                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit" onclick="userRegister()">Check Email</button>

                        </div>

                        <div class="alert alert-info text-center">
                            <a class="alert-link" href="javascript:void(0);" id="check-email-logon">Click Here to
                                Logon</a>
                            (if you know your password)
                            <br>
                            <a class="alert-link" href="{{ route('password.request') }}">Click Here to Reset
                                Password</a>
                            (if you don't)
                        </div>

                    </form>
                </div>
                <div class="step2-new-account hidden">
                    <form action="<?php echo route('register.step'); ?>" onsubmit="return false"
                          class="form-horizontal" id="register_step2" method="POST">
                        <div class="form-title">
                            <h3>Tell us about yourself</h3>
                        </div>
                        {{csrf_field()}}
                        <div class="container">
                            <div class="form-row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="" for="Company">Company</label>
                                    <div class="form-div">
                                        <input class="form-control" id="company_name" name="company_name"
                                               placeholder="Company" type="text" value="">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="" for="Firstname">First Name</label>
                                    <div class="form-div">
                                        <input class="form-control" id="first_name" name="first_name"
                                               placeholder="First Name" type="text" value="" required>
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Lastname">Last Name</label>
                                    <div class="form-div">
                                        <input class="form-control" id="last_name" name="last_name"
                                               placeholder="Last Name" type="text" value="" required>
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Country">Country</label>
                                    <div class="form-div">
                                        <select class="form-control countrified" id="country" name="country"
                                                placeholder="Country" required>
                                            <option value=""> Select</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Columbia">Columbia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea">Korea</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao">Lao</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="MacaU">MacaU</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua new Guinea">Papua new Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovak Republic">Slovak Republic</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="St Helena">St Helena</option>
                                            <option value="St Pierre and Miquelon">St Pierre and Miquelon</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan Region">Taiwan Region</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option selected="selected" value="United States">United States</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Virgin Islands">Virgin Islands</option>
                                            <option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Yugoslavia">Yugoslavia</option>
                                            <option value="Zaire">Zaire</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Address">Address</label>
                                    <div class="form-div">
                                        <textarea class="form-control" cols="20" id="address" name="address"
                                                  placeholder="Address" rows="2" required></textarea>
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="City">City</label>
                                    <div class="form-div">
                                        <input class="form-control" id="city" name="city" placeholder="City" type="text"
                                               value="" required>
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0"
                                     id="editor-state-container">
                                    <label class="control-label" for="State">State / Province</label>
                                    <div class="form-div">
                                        <input type="text" class="form-control" id="state" name="state"
                                               placeholder="State / Province">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Postal">Postal Code (Zip)</label>
                                    <div class="form-div">
                                        <input class="form-control" id="postal" name="postal"
                                               placeholder="Postal Code (Zip)" type="text" value=""
                                               aria-required="true">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Phone1">Phone 1</label>
                                    <div class="form-div">
                                        <input class="form-control" id="phone1" name="phone1" placeholder="Phone 1"
                                               type="text" value="" aria-required="true">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Phone2">Phone 2</label>
                                    <div class="form-div">
                                        <input class="form-control" id="phone2" name="phone2" placeholder="Phone 2"
                                               type="text" value="">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Fax">Fax</label>
                                    <div class="form-div">
                                        <input class="form-control" id="fax" name="fax" placeholder="Fax" type="text"
                                               value="">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 form-group m-b-0">
                                    <div class="form-title">
                                        <h3>Choose your user ID and password</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Email">Email</label>
                                    <div class="form-div">
                                        <input class="form-control" id="regemail" name="regemail"
                                               placeholder="Email address" type="text"
                                               value="developertestnew@gmail.com" aria-required="true">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="ConfirmEmail">Confirm Email</label>
                                    <div class="form-div">
                                        <input name="regemail_confirmation" id="regemail_confirmation"
                                               class="form-control" placeholder="Confirm Email address" type="text">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="Password">Password</label>
                                    <div class="form-div">
                                        <input autocomplete="off" class="form-control" id="userpassword"
                                               name="userpassword" placeholder="Password" type="password">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 form-group m-b-0">
                                    <label class="control-label" for="ConfirmPassword">Confirm Password</label>
                                    <div class="form-div">
                                        <input id="userpassword_confirmation" name="userpassword_confirmation"
                                               class="form-control" placeholder="Confirm Password" type="password">
                                        <span class="field-validation-valid error-block"></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group text-center">
                                    <button class="btn btn-primary create_accountbtn" type="submit"
                                            onClick="registerStep2()">Create New Account
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- End Modal --->
<!-- The Register to Bid Modal --><!-- The Register for bid Modal -->

@php($auction_valid =  array_intersect(array_keys($errors->messages()),["item_id","auction_id","pay_type","payment_type","PaymentInfoId","Notes","term_condition"]))

<div class="modal fade" id="registerForBidModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="{{route('auction.bidplaced')}}" class="form-horizontal"
                  id="auction_register" method="POST" novalidate="novalidate">
                @csrf
                <input type="hidden" id="item_id" value="{{old('item_id')}}" name="item_id">
                <input type="hidden" id="auction_id" value="{{old('auction_id')}}" name="auction_id">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Register</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info"></i>
                        Register for this auction you must verify your account by buying/ adding coins into your
                        wallet. Please add to wallet, review and accept the terms and conditions, and
                        then click the submit button at the bottom.
                        <span class="text-danger">
                           Withdrawing of coins back to your account takes 3-7 business days after request.
                        </span>
                    </div>
                    <fieldset>
                        <label class="d-none">Payment Method Verification</label>
                        <label>Wallet Coin Verification</label>
                        <div class=" my-3 pay_type_wrap">
                            @php($balance = wallet_balance(\Illuminate\Support\Facades\Auth::id()))
                            @auth
                                <button class="btn btn-primary float-right" data-toggle="modal" id="add_to_wallet"
                                     data-target="#add_wallet_amount" data-dismiss="modal"> Add to Wallet
                                </button>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input payment_type" type="checkbox" name="payment_type" id="wallet" value="wallet">
                                    <label class="form-check-label text-primary h5" for="wallet">Wallet
                                        <span class="d-none wallet_balance">- {{$balance}}</span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input payment_type" type="checkbox" name="payment_type" id="paypal" value="paypal">
                                    <label class="form-check-label text-primary h5" for="paypal">PayPal</label>
                                </div>
                                <div class="alert alert-info insuficent_balance d-none">
                                   <span class="text-danger">
                                       You don't have sufficient Wallet Balance to place bid
                                   </span>
                                </div>
                                <hr>
                                @error('payment_type')
                                <div class="alert alert-info ">
                                   <span class="text-danger">
                                       {{$message}}
                                   </span>
                                </div>
                                @enderror


                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md">
                                 <span class="field-validation-valid help-block"
                                       data-valmsg-for="type" data-valmsg-replace="true"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="registration-csc-location" class="m-t text-center hidden">
                                    <img src="https://bidera.hibid.com/Styles/images/icons/cvv.gif"
                                         alt="Security Code Location" class="img-responsive center-block">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <label>Registration</label>
                        <div class="form-group">
                            <label class="sr-only" for="Notes">YOUR NOTES TO THE AUCTIONEER</label>
                            <textarea  cols="20" id="Notes" maxlength="400" name="Notes" style="display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"
                                      placeholder="YOUR NOTES TO THE AUCTIONEER"
                                      rows="2">{{old('Notes')}}</textarea>
                            <span class="field-validation-valid help-blocks" data-valmsg-for="Notes"
                                  data-valmsg-replace="true"></span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <label>Terms and Conditions</label>
                        <div class="form-group">
                            <div class="border rounded text-scroll p-2">Auction Terms &amp; Conditions 1- BIDERA
                                LLC reserves the right, at any time, within its sole discretion and without prior
                                notice
                                or liability to any person, to: (a) withdraw or cancel the sale of any or all Assets
                                prior to accepting a bid for such Asset or Assets; (b) refuse to issue a bidder's
                                number
                                to any person; (c) revoke the privilege of bidding to any person at this or any
                                future
                                sale (auction or otherwise); (d) refuse or reject any bid which it deems to be not
                                made
                                in good faith or an insignificant advance over the preceding bid; (e) refuse or
                                reject
                                any bid from any disqualified bidder; (f) offer any Assets in groups or in bulk; or;
                                (g)
                                impose any other conditions announced at the time of sale.
                                2- The City or County shall have the right to cancel any transaction executed or
                                not,
                                for any given reason. All sales through Bidera.com are (Subject to Confirmation) by
                                the
                                City/County/Law Enforcement Agency. There are (No Absolute Auctions) on Bidera.com,
                                nor
                                expressed, nor implied, nor publicized in any type advertisement whatsoever.
                                Bidera's
                                best interest is to sell it all, but the City/County/Law Enforcement have the final
                                say.
                                No bidder shall be liable for a (NO-SALE).
                                3- A Buyer is deemed to have accepted the Asset once the Buyer makes a bid. BIDERA
                                LLC
                                shall accept the highest bid and the highest bidder shall be considered the Buyer.
                                Once
                                a bid is accepted by Bidera and approved by the City or County, the Buyer may not
                                retract the bid. All sales are final once a successful bid is accepted.
                                4- Any dispute arising as to any bidding shall be settled by BIDERA LLC sole
                                discretion,
                                and BIDERA LLC may, immediately, put Assets in dispute up for sale again.
                                5- Buyer's Premium of 13% will be added to your invoice, a -3% discount will be
                                offered
                                for cash or wire transfer payment.
                                6- BIDERA LLC will, at its sole discretion, may collect from Buyers a non-refundable
                                25%
                                deposit toward the purchase price and Buyer's Premium immediately following
                                acceptance
                                of the successful bid or at any time deemed appropriate by BIDERA LLC.
                                7- The balance of the Purchase Price and Buyer's Premium shall be paid in full the
                                following day of the auction close or the following business day by 3 pm EST. No
                                physical work at the any Sale Site(s), including but not limited to the removal of
                                the
                                Assets purchased, may occur before BIDERA LLC has received payment in full.
                                8- Buyer's Premium is 13% of your total price will be added bill. You may pay with
                                the
                                Visa or Mastercard you registered with to participate or you can wire the funds or
                                pay
                                in cash at our office and get a -3% discount.
                                9- All applicable sales taxes shall be added to the purchase price of all taxable
                                purchases. Buyers who purchase for resale must provide a signed copy of their resale
                                tax
                                certificate in order to avoid paying the sales tax at the moment of payment. All
                                vehicle
                                purchasers will pay sales tax when transferring title at the tag agency suggested by
                                BIDERA.
                                10- By registering as a bidder and/or submitting a bid, each Buyer acknowledges that
                                the
                                Buyer has read, agrees to and shall be bound by these Terms of Sale.
                                11- Each Buyer acknowledges that prior to the auction all Assets may be viewed for
                                inspection. Inspection or Preview times will be announced under the description
                                section
                                of the online Auction. Unless otherwise.
                                12- In the event the Buyer fails to pay the full purchase price of any Assets within
                                the
                                prescribed time, or fails to comply with any other Terms of Sale, will lose the
                                deposit,
                                if any. BIDERA LLC shall retain a possessory lien on all Assets of the Buyer and
                                have
                                the right to resell such Assets for and on behalf of the Seller by public or private
                                sale without notice of any kind to the Buyer. Legal action may be persued in a Dade
                                County Court House.
                                13- Successful bidder immediately acquires possession of all items purchased. It
                                shall
                                be the sole responsibility of the Buyer to insure purchased Assets immediately upon
                                transfer of title and possession. BIDERA LLC, and the city shall not be responsible
                                for
                                any loss or damage to any Assets in transit.
                                14- All Assets must be removed from the Sale Site within the time announced, and all
                                costs, responsibility and risk of such removal shall be borne by the Buyer and, in
                                every
                                case, the Buyer shall use prudence in effecting such removal.
                                15- Buyer is responsible for compliance with all applicable government safety
                                standards
                                in connection with the removal and transportation of the Assets and for the actions
                                and
                                safety of all of its own employees or any third party brought onto the Sale Site.
                                16- Buyer and any third party engaged by Buyer to assist in the removal of the
                                Assets
                                that technical or professional assistance is required, (BIDERA'S DISCRETION) must
                                provide a certificate of insurance, including evidence of public liability insurance
                                of
                                at least $1,000,000 and worker's compensation insurance. Buyer agrees to indemnify
                                and
                                hold harmless BIDERA LLC, the City and/or County against any damage caused by the
                                acts
                                of the Buyer and/or agents of the Buyer in connection with the dismantling or
                                removal of
                                the Assets.
                                17- No sale shall be invalidated by reason of any defect or inaccuracy in any of the
                                Assets being incorrectly described in any catalog, on www.BIDERA.com, or elsewhere,
                                and
                                no liability shall be borne by BIDERA LLC with respect to any such fault or errors.
                                While descriptions are believed to be accurate, BIDERA LLC, the City /County and
                                make no
                                warranties or guarantees expressed or implied, as to the genuineness, authenticity
                                of,
                                or defect in any Assets and will not be held responsible for any advertising
                                discrepancies. The descriptions contained in any catalog and information posted on
                                www.BIDERA.com, has been prepared only as a guide based on information from sources
                                generally believed to be reliable and from the City, but the accuracy thereof cannot
                                be
                                guaranteed or warranted by BIDERA LLC. Bidder acknowledges responsibility to inspect
                                all
                                Assets and make independent inquiries.
                                18- BUYER ACKNOWLEDGES THAT PRIOR TO BIDDING, AN INSPECTION PERIOD IS AVAILABLE OF
                                THE
                                ITEMS UP FOR BIDS, THAT ALL STEPS NECESSARY TO INDEPENDENTLY SATISFY HIMSELF OR
                                HERSELF
                                REGARDING ANY CONDITION OR ASPECT OF ANY ASSET HAVE BEEN TAKEN, AND THAT BUYER IS
                                NOT
                                RELYING ON BIDERA LLC NOR IS BIDERA LLC LIABLE FOR ANY SUCH MATTER. BUYER FURTHER
                                ACKNOWLEDGES THAT THERE ARE NO GUARANTEES OR WARRANTIES, EXPRESSED OR IMPLIED,
                                STATUTORY
                                OR OTHERWISE, OF ANY NATURE WHATSOEVER MADE WITH RESPECT TO ANY ASSET. EACH AND
                                EVERY
                                ASSET IS SOLD "AS-IS, WHERE-IS." BIDDER'S BID AT THEIR OWN RISK! BIDERA LLC MAKES NO
                                REPRESENTATION OR WARRANTY AS TO THE CONDITION AND/OR OPERABILITY OF ANY ASSET NOR:

                                A) CONFORMS TO ANY SAFETY OF POLLUTION STANDARD OR TO ANY STANDARD OR REQUIREMENT OF
                                ANY
                                APPLICABLE AUTHORITY, LAW, OR REGULATION, OR
                                B) IS FIT FOR ANY PARTICULAR PURPOSE, OR
                                C) IS MERCHANTABLE OR FINANCEABLE, OR
                                D) IS OF ANY PARTICULAR AGE, YEAR OF MANUFACTURE, MODEL, MAKE OR CONDITION.

                                19- BUYER ACCEPTS THE ASSETS PURCHASED SUBJECT TO ALL TERMS OF SALE. BUYER DOES
                                HEREBY
                                WAIVE, RELEASE AND DISCHARGE ALL CLAIMS OF ANY KIND OR NATURE AGAINST BIDERA LLC OR
                                THE
                                CITY, ITS AGENTS AND EMPLOYEES FOR ANY DAMAGES OR INJURIES RESULTING FROM THE
                                PURCHASE,
                                POSSESSION OR USE OF THE PURCHASED ASSETS, OR CLAIMS FOR PROXIMATE OR CONSEQUENTIAL
                                DAMAGES ARISING THEREFROM.

                                20- If, for any reason whatsoever, BIDERA LLC is unable to make any purchased
                                Asset(s)
                                available to Buyer or otherwise effect delivery of any Asset(s) with clear title to
                                the
                                same, or any necessary documentation required in respect of any Asset(s) whether
                                before
                                or after delivery of such Asset(s), BIDERA LLC's sole liability shall be to return
                                to
                                Buyer any monies paid by Buyer for such Asset(s), upon return (if applicable) of the
                                Asset(s) by Buyer. (Only exception for titled items with non-documentation will sold
                                for
                                parts or scrap).
                                21- If any shortages exist on estimated counts, an adjustment to the purchase price
                                will
                                be made only if the claim is made at the time of the removal. No adjustment will be
                                allowed after any Assets are removed from the Sale Site.
                                22- Title transfers are a MUST! Regardless if you are a Licensed Dealer or Not. No
                                Exception! All necessary transfer documents, product manuals or other written
                                information pertaining to the Assets will, if available, be delivered immediately to
                                the
                                Buyer at the time of payment or pick up. Or will otherwise be mailed to Buyer if
                                subsequently made available to BIDERA LLC. Availability of these documents is
                                subject to
                                provision of the same by the City/County.
                                23- BIDERA LLC reserves the right to change any auction's ending time.
                                24- In addition to these Terms of Sale, Buyer agrees to the Terms and Conditions
                                that
                                govern the use of BIDERA LLC Services as defined on BIDERA's website at
                                www.BIDERA.com,
                                and those additional terms posted and announced at the time of sale and included
                                with
                                any catalog or other written information provided to all bidders at the Sale Site.
                                25- If any provision of these Terms of Sale is held by a court of competent
                                jurisdiction
                                to be invalid or unenforceable, then such provision shall be enforced to the maximum
                                extent permissible so as to affect the intent of this Agreement, and the remainder
                                of
                                this Agreement shall continue in full force and effect.
                                26- These Terms of Sale shall be interpreted and enforced under Florida law
                                regardless
                                of the location of the Sale Site.
                                27. Check out times may vary according to City or County, local bidders have (3)
                                consecutive days following the close of the online auction. Out of state bidders
                                will
                                have up to 7 business days following the close of the online auction.
                                If you cannot make it within these check out time periods, don't bid. This online
                                auction is Local pick up only and only the registered bidder or company may claim
                                their
                                items won. No third party pick up! No exceptions!
                                28. All items sold in this auction will be in Sold As-Is, Where-Is condition,
                                working or
                                not working. No Guarantees or Warranties Expressed nor Implied as to condition or
                                description of items being offered. Buyers are highly recommended to attend the
                                preview
                                prior to auction close and inspect the items they are bidding on or considering to
                                bid.
                                Preview is the day before the auction ends.
                                Check the auction notes for updated information.
                                (Any questions regarding the Terms &amp; Conditions, please Bidera Government
                                Auctions
                                at call 305-822-5000)
                                29. Police vehicles shall have all decals removed prior to sale at auction to the
                                general public, according to amendment of F.S. 319.14 USE OF THIS VEHICLE FOR THE
                                DELIBERATE IMPERSONATION OF A PUBLIC OFFICER OR EMPLOYEE IS A FELONY OF THE THIRD
                                DEGREE
                                , PUNISHABLE AS PROVIDED IN SECTION 843.0855, FLORIDA STATUE


                                ---------------------------------------------
                                ------------------------------------------

                                <a href="/home/termsofuse">Terms Of Use</a><a><br><br></a><a
                                        href="/home/selleruserterms">Seller User Terms</a><a><br><br></a><a
                                        href="/home/bidderuserterms">Bidder User Terms</a><a></a></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-11 col-xs-offset-1">
                                <input name="term_condition" class="form-control" type="checkbox" id="AcceptTermsAndConditions"
                                       data-val-mandatory="You must accept the Auctioneer's Terms and Conditions in order to register for this auction."
                                       data-val-required="The AcceptTermsAndConditions field is required."
                                       data-val="true"
                                        {{old('term_condition') == 'yes'?'checked':''}}>
                                <label for="AcceptTermsAndConditions">By checking here you acknowledge that you have
                                    read and accept the terms and conditions.</label>
                                    
                                <span class="field-validation-valid help-block"
                                      data-valmsg-for="AcceptTermsAndConditions" data-valmsg-replace="true">
                                    @error('term_condition')
                                    <span id="AcceptTermsAndConditions-error" class="">This field is required.</span>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group text-center submit_bid">
                            {{--<input type="hidden" id="pay_type" value="wallet" name="pay_type">--}}
                            <button type="submit" class="btn btn-primary">Submit Registration</button>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($auction_valid)>0)
    <script>
        $('#registerForBidModal').modal('show');
    </script>
    @endif

    </div>
    <!--- End Modal --->

    <div id="lowrb-registration-success-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">AUCTIONEER INFORMATION</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button id="lowrb-registration-success-ok" type="button" class="btn btn-primary">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div id="lowrb-registration-warning-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">AUCTIONEER INFORMATION</h4>
                </div>
                <div class="modal-body alert alert-danger">
                    <i class="fa fa-exclamation"></i>
                    <span id="lowrb-registration-warning-body">
					You have not registered for this auction. You will not be able to bid in this auction without registering.
				</span>
                </div>
                <div class="modal-footer">
                    <button id="lowrb-registration-warning-ok" type="button" class="btn btn-default">Ok</button>
                    <button id="lowrb-registration-warning-cancel" type="button" class="btn btn-primary">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('frontend') }}/js/script.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/owl.carousel.js"></script>
    {{-- <script src="{{ asset('frontend/js/jquery.min.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script> --}}


    @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'catalog')
        <script>
            $(document).ready(function () {
                $(".payment_type").change(function(){
                    $(".payment_type").prop('checked', false);
                    $(this).prop('checked', true);
                    $('.wallet_balance').addClass('d-none')
                    if ($(this).val() === 'wallet'){
                        $('.wallet_balance').removeClass('d-none')
                    }
                });
                $('#auction_register .form-control').each(function () {
                    $(this).rules('add', 'required');
                })
                $(".pay_type").change(function () {
                    $(".pay_type").prop('checked', false);
                    $(this).prop('checked', true);
                    var pay_method = $('.pay_method')
                    var credit_card = $('.pay_method .credit_card_wrap')
                    var mobile_money = $('.pay_method .mobile_money_wrap')
                    var bit_coin = $('.pay_method .bitcoin_wrap')
                    pay_method.addClass('d-none')
                    credit_card.addClass('d-none')
                    mobile_money.addClass('d-none')
                    bit_coin.addClass('d-none')

                    if ($(this).val() == 'credit_card') {
                        pay_method.removeClass('d-none')
                        credit_card.removeClass('d-none')
                    }
                    if ($(this).val() == 'mobile_money') {
                        pay_method.removeClass('d-none')
                        mobile_money.removeClass('d-none')
                    }
                    if ($(this).val() == 'bit_coin') {
                        pay_method.removeClass('d-none')
                        bit_coin.removeClass('d-none')
                    }
                });


            });

        </script>

    @endif
    <script>
        function add_to_wallet() {
            var amount = $('#process_payment').val();
            var prev_url = $('#prev_url').val();
            var url = '{{route('processTransaction')}}/' + amount+'/'+prev_url;

            if (!amount) {
                alert('Please Enter a valid amount');
            } else {
                if($('#auctionId').val()){
                    $.ajax({
                        url: "{!! route('session_data') !!}",
                        type: 'POST',
                        data: {
                            auction_id: $('#auctionId').val(),
                            _token: '{{csrf_token()}}'
                        },
                        success: function (result) {
                            if(result){
                                window.location = url;
                            }
                        }
                    });
                }else{
                    window.location = url;
                }
            }

        }
    </script>
    @yield('extraJS')
    @stack('frontend_script')
</body>
</html>