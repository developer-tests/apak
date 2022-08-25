<div id="sub-header">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="social-icons">
									<ul>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="#"><i class="fa fa-rss"></i></a></li>
										<li><a href="#"><i class="fa fa-behance"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 hidden-sm">
								<div class="right-info">
									<ul>
										<li>Call us: <em>570-694-4002</em></li>
										<li><a href="#">Get Free Appointment →</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<header class="site-header">
					<div id="main-header" class="main-header header-sticky">
						<div class="inner-header container clearfix">
							<div class="logo">
								<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
							</div>
							<div class="header-right-toggle pull-right hidden-md hidden-lg">
								<a href="javascript:void(0)" class="side-menu-button"><i class="fa fa-bars"></i></a>
							</div>
							<nav class="main-navigation text-left hidden-xs hidden-sm">
								<ul>
									<li><a href="#">{{ __('home') }}</a></li>
									<li><a href="#">{{ __('About Us') }}</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#" class="has-submenu">{{ __('Categories') }}</a>
										<ul class="sub-menu">
											<li><a href="#"></a>{{ __('Single Post') }}</li>
											<li><a href="">{{ __('Single Post') }}</a></li>
											<li><a href="#">{{ __('Single Post') }}</a></li>
										</ul>
									</li>
									<li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>

									<li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
									
									<li>
										<p><a href="#" id="example-show" class="showLink" onclick="showHide('example');return false;"><i class="fa fa-search"></i></a></p>
										<div id="example" class="more">
											<form method="get" id="blog-search" class="blog-search">
												<input type="text" class="blog-search-field" name="s" placeholder="Type to search" value="">
											</form>
											<p><a href="#" id="example-hide" class="hideLink" 
											onclick="showHide('example');return false;"><i class="
											fa fa-close"></i></a></p>
										</div>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</header>