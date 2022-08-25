<!--- Start Payment Method Form --->
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
            @if (session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            @endif
         <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card">
                  
               <!-- Card header -->
               @if(count($res) > 0)
               @foreach($res as $key => $r)
               <div class="card-header" role="tab" id="heading{{$r->id}}">
                  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapse{{$r->id}}" aria-expanded="true"
                     aria-controls="collapse{{$r->id}}">
                     <h5 class="mb-0">
                        Payment Method : {{$r->nickname}}<i class="fa fa-angle-down rotate-icon"></i>
                     </h5>
                  </a>
               </div>
               <div id="collapse{{$r->id}}" class="collapse {{$key == 0? 'show' : ''}}" role="tabpanel" aria-labelledby="heading{{$r->id}}"
                  data-parent="#accordionEx">
                  <div class="card-body">
                  <div class="row">
                        <div class="col-xs-3 col-sm-3">
                           <img src="https://bidera.hibid.com/Styles/images/pci.png" title="PCI Compliant" alt="PCI Compliant">

                        </div>
                        <div class="col-xs-9 col-sm-9">
                           <div class="form-row m-b-0">
                              <label class="col-sm-6 control-label" for="Nickname">Nickname</label>
                              <div class="col-sm-6">
                                 <p class="form-control-static">{{$r->nickname}}</p>					
                              </div>
                           </div>
                           <div class="form-row m-b-0">
                              <label class="col-sm-6 control-label" for="Name">Card Holder Name</label>
                              <div class="col-sm-6">
                                 <p class="form-control-static">{{$r->cardholdername}}</p>
                              </div>
                           </div>
                           <div class="form-row m-b-0">
                              <label class="col-sm-6 control-label" for="Number">Credit Card #</label>
                              <div class="col-sm-6">
                                 <p class="form-control-static">{{getTruncatedCCNumber($r->cardnumber)}}
                                 <img data-type="{{$r->card_type}}" class="" src="{{getCCImage($r->card_type)}}" alt="{{$r->card_type}}">
                  </p>
                              </div>
                           </div>
                           <div class="form-row m-b-0">
                              <label class="col-sm-6 control-label">Expiration Date</label>
                              <div class="col-sm-6">
                                 <p class="form-control-static">{{$r->monthexpiry}}/ {{$r->yearexpiry}}</p>
                              </div>
                           </div>
                           <div class="form-row m-b-0">
                              <label class="col-sm-6 control-label" for="BillAddress">Billing Address</label>
                              <div class="col-sm-6">
                                 <address class="form-control-static">
                                             <a target="_blank" href="https://maps.google.com/maps?q={{$r->billing_address}}">{{$r->billing_address}}</a>
                                 </address>
                              </div>
                           </div>
                        </div>
                     </div>
					 <div class="row">
						<div class="col-xs-12 justify-content-center">
                  <form method="post" action="{{route('deletepaymentmethod')}}">
                     <input type="hidden" value="{{$r->id}}" name="payment_id">
                     {{csrf_field()}}
							<div class="form-row">
								<button id="payment-delete" class="btn btn-danger">Delete Payment Method</button>
							</div>
                     </form>
						</div>
					</div>
                  </div>
               </div> 
               @endforeach
               @endif
               <div class="card-header" role="tab" id="headingOne1">
                  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                     aria-controls="collapseOne1">
                     <h5 class="mb-0">
                        Add a Payment Method <i class="fa fa-angle-down rotate-icon"></i>
                     </h5>
                  </a>
               </div>
                
               <!-- Card body -->
               <div id="collapseOne1" class="collapse in" role="tabpanel" aria-labelledby="headingOne1"
                  data-parent="#accordionEx">
                  <div class="card-body">
                     <form action="{{route('savepaymentmethod')}}" class="form-horizontal" id="payment-form-new" method="POST" novalidate="novalidate">
                        <input name="" type="hidden" value="">	<input type="hidden" id="payment-id-new" name="PaymentId" value="0">
                        {{csrf_field()}}
                        <input type="hidden" id="payment-isedit-new" name="isedit" value="false">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                              <img src="https://bidera.hibid.com/Styles/images/pci.png" title="PCI Compliant" alt="PCI Compliant">
                           </div>
                           <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Nickname">Nickname</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Maximum 30 Characters" data-val-length-max="30" data-val-required="Nickname is required" id="payment-nickname-new" name="Nickname" placeholder="Nickname" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Nickname" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Name">Card Holder Name</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Maximum 50 Characters" data-val-length-max="50" data-val-required="Card Holder Name is required" id="payment-name-new" name="Name" placeholder="Card Holder Name" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Number">Credit Card #</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input type="hidden" name="card_type" id="card_type" value="">
                                    <input autocomplete="off" class="form-control credit-card-type" data-val="true" data-val-bidopiacreditcard="Credit Card number is not valid." data-val-bidopiacreditcardtype="Credit Card type is not valid." data-val-required="Credit Card number is not valid." id="payment-number-new" maxlength="32" name="Number" placeholder="Credit Card #" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="Number" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-4 offset-lg-4 offset-xl-4">
                                    <div class="payment-types m-b-md">
                                       <img data-type="American Express" class="hidden" src="https://bidera.hibid.com/Styles/images/icons/cc-amex.png" alt="American Express">
                                       <img data-type="Visa" class="hidden" src="https://bidera.hibid.com/Styles/images/icons/cc-visa.png" alt="Visa">
                                       <img data-type="Mastercard" class="hidden" src="https://bidera.hibid.com/Styles/images/icons/cc-mastercard.png" alt="Mastercard">
                                       <img data-type="Discover" class="hidden" src="https://bidera.hibid.com/Styles/images/icons/cc-discover.png" alt="Discover">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="Month">Expiration Date</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <div class="input-group">
                                       <label class="hidden" for="Month">Months</label>
                                       <select class="form-control" data-val="true" data-val-required="Credit Card expiration month is not valid." id="Month" name="Month">
                                          <option value=""></option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                       </select>
                                       <span class="input-group-addon">/</span>
                                       <label class="hidden" for="Year">Years</label>
                                       <select class="form-control" data-val="true" data-val-required="Credit Card expiration year is not valid." id="Year" name="Year">
                                          <option value=""></option>
                                          @php
                                          $date = date("Y");
                                          $j = $date + 9;
                                          @endphp
                                          @for($i=$date; $i<=$j;$i++)
                                          <option value="{{$i}}">{{$i}}</option>
                                          @endfor
                                       </select>
                                    </div>
                                    <span class="field-validation-valid help-block" data-valmsg-for="Month" data-valmsg-replace="true"></span>
                                    <span class="field-validation-valid help-block" data-valmsg-for="Year" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="BillCountry">Billing Country</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <select class="form-control countrified" data-state="#payment-billing-state-new" data-statecontainer="#payment-billing-state-container-new" data-val="true" data-val-required="Billing Country is not valid." id="payment-billing-country-new" name="BillCountry">
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
                                    <span class="field-validation-valid help-block" data-valmsg-for="BillCountry" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="BillAddress">Billing Address</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Maximum 50 Characters" data-val-length-max="50" data-val-required="Billing Address is not valid." id="payment-billing-address-new" maxlength="50" name="BillAddress" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="BillAddress" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="BillCity">Billing City</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Maximum 25 Characters" data-val-length-max="25" data-val-required="Billing City is not valid." id="payment-billing-city-new" maxlength="50" name="BillCity" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="BillCity" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0" id="payment-billing-state-container-new">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="BillState">Billing Province / State</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input type="text"  class="form-control" id="payment-billing-state-new" name="BillState">
                                    <span class="field-validation-valid help-block" data-valmsg-for="BillState" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                              <div class="form-row m-b-0">
                                 <label class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 control-label" for="BillPostal">Billing Postal Code (Zip)</label>
                                 <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <input class="form-control" data-val="true" data-val-length="Maximum 10 Characters" data-val-length-max="10" data-val-required="Billing Postal Code is not valid." id="payment-billing-postal-new" maxlength="10" name="BillPostal" type="text" value="">
                                    <span class="field-validation-valid help-block" data-valmsg-for="BillPostal" data-valmsg-replace="true"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12">
                              <div class="payment-btn text-center">
                                 <button class="btn btn-primary m-b" type="submit">Save Payment Method</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- Accordion card -->
         </div>
         <!-- Accordion wrapper -->
      </div>
   </div>
</section>
<script type="text/javascript" src="{{ asset('frontend') }}/js/test.js"></script>
<!--- End of Payment Method Form --->
@endsection