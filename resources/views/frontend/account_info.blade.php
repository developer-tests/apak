<!--- Start Account Info --->
@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<section class="account-info">
            <div class="inner-container">
                <div class="row">
                    <div class="account-info-form">
                        <form action="" class="form-horizontal" id="editor-form" method="PUT" novalidate="novalidate"><input id="Id" name="Id" type="hidden" value="4101548"><input data-val="true" data-val-required="The IsEdit field is required." id="IsEdit" name="IsEdit" type="hidden" value="True"><input id="editor-return-url" name="ReturnUrl" type="hidden" value="">
                            <h3>Edit Personal Info</h3>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Company">Company</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 50 Characters" data-val-length-max="50" id="editor-company" name="Company" placeholder="Company" type="text" value="adlivetech">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Company" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Firstname">First Name</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 20 Characters" data-val-length-max="20" data-val-required="First Name is required." id="editor-first-name" name="Firstname" placeholder="First Name" type="text" value="Priya">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Firstname" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Lastname">Last Name</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 30 Characters" data-val-length-max="30" data-val-required="Last Name is required." id="editor-last-name" name="Lastname" placeholder="Last Name" type="text" value="Aggarwal">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Lastname" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Country">Country</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <select class="form-control countrified" data-state="#editor-state" data-statecontainer="#editor-state-container" data-val="true" data-val-required="Country is required." id="editor-country" name="Country" placeholder="Country"><option value="Afghanistan">Afghanistan</option>
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
                                            <option selected="selected" value="India">India</option>
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
                                            <option value="United States">United States</option>
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
                                <span class="field-validation-valid help-block" data-valmsg-for="Country" data-valmsg-replace="true"></span>
                            </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Address">Address</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <textarea class="form-control" cols="20" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 200 Characters" data-val-length-max="200" data-val-required="Address is required." id="editor-address" name="Address" placeholder="Address" rows="2" aria-required="true" aria-invalid="false" aria-describedby="editor-address-error">Faridabad</textarea>
                                    <span class="help-block field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="City">City</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 25 Characters" data-val-length-max="25" data-val-required="City is required." id="editor-city" name="City" placeholder="City" type="text" value="faridabad">
                                    <span class="field-validation-valid help-block" data-valmsg-for="City" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0 hidden" id="editor-state-container">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="State">State / Province</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <select class="form-control" data-val="true" data-val-required="State is required." id="editor-state" name="State" placeholder="State / Province"><option value="">Please Select</option>
                                            <option value="">All Locations</option>
                                            <option selected="selected" value="--">Non-US/Canada</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AB">Alberta</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="BC">British Columbia</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FM">Federated States Of Micronesia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="GU">Guam</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MB">Manitoba</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NB">New Brunswick</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NF">Newfoundland</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NT">Northwest Territories</option>
                                            <option value="NS">Nova Scotia</option>
                                            <option value="NU">Nunavut</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="ON">Ontario</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PW">Palau</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="PE">Prince Edward Island</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QC">Quebec</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SK">Saskatchewan</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VI">Virgin Islands</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="YT">Yukon</option>
                                    </select>
                                    <span class="field-validation-valid help-block" data-valmsg-for="State" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Postal">Postal Code (Zip)</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Text can only contain numbers, letters, and characters - _ . ' ," data-val-bidopiatrimmingregex-pattern="^[A-Za-zÀ-ÖØ-öø-ÿ0-9 '\-_\,\.\r\n]+$" data-val-length="Maximum 10 Characters" data-val-length-max="10" data-val-required="Postal Code (Zip) is required." id="editor-postal" name="Postal" placeholder="Postal Code (Zip)" type="text" value="121002">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Postal" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Phone1">Phone 1</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Minimum 10 Numbers Maximum 25 Numbers" data-val-length-max="25" data-val-length-min="10" data-val-regex="Phone Not Valid" data-val-regex-pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})?[-. )]*(\d{3})?[-. ]*(\d{4})?(?: *x(\d+))?\s*$" data-val-required="Phone is required." id="editor-phone1" name="Phone1" placeholder="Phone 1" type="text" value="9876345261">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Phone1" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Phone2">Phone 2</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Minimum 10 Numbers Maximum 25 Numbers" data-val-length-max="25" data-val-length-min="10" data-val-regex="Phone Not Valid" data-val-regex-pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})?[-. )]*(\d{3})?[-. ]*(\d{4})?(?: *x(\d+))?\s*$" id="editor-phone2" name="Phone2" placeholder="Phone 2" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Phone2" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-row m-b-0">
                                <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Fax">Fax</label>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Minimum 10 Numbers Maximum 25 Numbers" data-val-length-max="25" data-val-length-min="10" data-val-regex="Phone Not Valid" data-val-regex-pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})?[-. )]*(\d{3})?[-. ]*(\d{4})?(?: *x(\d+))?\s*$" id="editor-fax" name="Fax" placeholder="Fax" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Fax" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                                <h3>Edit User ID or Email Address</h3>
                                <div class="form-row m-b-0">
                                    <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="UserName">User Name</label>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                        <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="User Name can only contain numbers, letters, and characters @ - _ ." data-val-bidopiatrimmingregex-pattern="^[a-zA-Z0-9@\-_\,\. ]+$" data-val-length="User Name must be at least 6 characters and no more than 20 characters." data-val-length-max="20" data-val-length-min="6" data-val-remote="User Name is not available." data-val-remote-additionalfields="*.UserName" data-val-remote-url="/api/v1/buyer/isuniqueusername/" data-val-required="User Name must be at least 6 characters and no more than 20 characters." id="editor-username" name="UserName" placeholder="User Name" type="text" value="priyaaggarwal">
                                        <span class="field-validation-valid help-block" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-row m-b-0">
                                    <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Email">Email</label>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                        <input class="form-control" data-val="true" data-val-bidopiatrimmingregex="Email is not valid." data-val-bidopiatrimmingregex-pattern="\w+([-+.']\w+)*\-*@\w+([-.]\w+)*\.\w+([-.]\w+)*" data-val-length="Maximum 100 Characters" data-val-length-max="100" data-val-length-min="6" data-val-required="Email is required." id="editor-email" name="Email" placeholder="Email address" type="text" value="learningpurpose04@gmail.com">
                                        <span class="field-validation-valid help-block" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-row m-b-0">
                                    <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="ConfirmEmail">Confirm Email</label>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                        <input autocomplete="off" class="form-control" data-val="true" data-val-equalto="Email &amp; Confirm Email do not match." data-val-equalto-other="*.Email" id="editor-confirm-email" name="ConfirmEmail" placeholder="Confirm Email address" type="text" value="learningpurpose04@gmail.com">
                                        <span class="field-validation-valid help-block" data-valmsg-for="ConfirmEmail" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-row m-b-0">
                                    <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label">Change Password</label>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                        <p class="form-control-static"><a href="{{route('account.password')}}">Click Here to Change Your Password</a></p>
                                    </div>
                                </div>
                            <h3>Edit Account Options</h3>
                            <div class="form-row m-b-0">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-4 offset-lg-4 4 offset-xl-4">
                                    <input checked="checked" data-val="true" data-val-required="The HideUsername field is required." id="HideUsername" name="HideUsername" type="checkbox" value="true">
                                    <label for="HideUsername">Hide Username From Public</label>
                                </div>
                            </div>
                        <input data-val="true" data-val-required="The SendConfirm field is required." id="SendConfirm" name="SendConfirm" type="hidden" value="True"><input data-val="true" data-val-required="The SendOutbid field is required." id="SendOutbid" name="SendOutbid" type="hidden" value="True"><input data-val="true" data-val-required="The SendReminders field is required." id="SendReminders" name="SendReminders" type="hidden" value="True"><input data-val="true" data-val-required="The SendConfirmSMS field is required." id="SendConfirmSMS" name="SendConfirmSMS" type="hidden" value="False"><input data-val="true" data-val-required="The SendOutbidSMS field is required." id="SendOutbidSMS" name="SendOutbidSMS" type="hidden" value="False"><input data-val="true" data-val-required="The SendRemindersSMS field is required." id="SendRemindersSMS" name="SendRemindersSMS" type="hidden" value="False">		<div class="form-row m-b-0">
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-4 offset-lg-4 4 offset-xl-4">
                                        <div class="form-control-static d-none">
                                            <a href="managesearches.html">Manage Searches &amp; Email</a>
                                        </div>
                                    </div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </div>
                            <div class="save-info text-center">
                                <button class="btn btn-primary" type="submit">Save Account Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection