 <!--- Footer Section Start --->

        <section class="footer section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-cont">
						
                            <a  href="{{url('/')}}">{{$setting['site_name'] ?? ''}}</a>
                        </div>
                    </div>
					@php
						$info = getInfopages();
						@endphp
						@if(count($info) > 0)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-cont">
						
						
					
                            <h5>PAGES</h5>
                            <ul>
							@foreach($info as $in)
                            @if($in->active == 1)
                                <li><a href="{{route('info',$in['page_slug'])}}">{{$in['page_name']}}</a></li>
                                @endif
							@endforeach	
                            <li><a href="{{route('contact')}}">Contact us</a></li>
                            </ul>
						
                        </div>
                    </div>
					@endif	
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-cont">
                            <h5>MORE</h5>
                            <p>This is an auction platform for the public! Buy your local Government surplus. Police forfeiture & vehicles. Heavy equipment, Fire rescue and retired assets.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-cont">
                            <h5>Follow Us</h5>
                            <ul class="social-links">
                            @if(!empty($setting['facebook'] ?? ''))
                               <li><a href="{{$setting ?? ''['facebook']}}"><i class="fa fa-facebook-f"></i></a></li>
                            @endif
                            @if(!empty($setting['instagram'] ?? '')) 
                               <li><a href="{{$setting ?? ''['instagram']}}"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if(!empty($setting['twitter'] ?? ''))   
                               <li><a href="{{$setting ?? ''['twitter']}}"><i class="fa fa-twitter"></i></a></li>
                            @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="copyright">
                            <p>© {{date('Y')}} {{$setting['site_name'] ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!--- Footer Section End --->