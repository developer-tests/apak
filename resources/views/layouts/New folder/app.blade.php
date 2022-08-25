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
        .help-blocks.field-validation-error,.field-validation-valid.help-block span{
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
                <form onsubmit="return false" action="<?php echo route('userloginform'); ?>" class="form"
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
                    <form onsubmit="return false" action="<?php echo route('userregisterform'); ?>" class="form"
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
                    <form action="<?php echo route('userregisterstep2'); ?>" onsubmit="return false"
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
<!-- The Register to Bid Modal -->
<div class="modal fade" id="registerBidModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                In process
            </div>
        </div>
    </div>
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
            $('#auction_register .form-control').each(function () {
                $(this).rules('add','required');
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
        })

    </script>
@endif
@yield('extraJS')
@stack('frontend_script')
</body>
</html>