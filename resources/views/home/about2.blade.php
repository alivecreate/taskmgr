@extends('home.layout.front-other')
@section('title','ABOUT US - WELCOME TO CCPL WORLD An ISO 9001 : 2008 certified company')
@section('content')
@section('breadcrumb-name', 'About Us2')
@section('breadcrumb-title', 'Everything you need to know about our Company')

<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row col-mb-80 mb-0">

						<div class="col-12">

							<div class="heading-block center border-bottom-0">
								<h2>Interactive Office Environment</h2>
								<span>We value Work Ethics &amp; Environment as it helps in creating a Creative Thinktank</span>
							</div>

							<div class="fslider" data-pagi="false" data-animation="fade">
								<div class="flexslider">
									<div class="slider-wrap">
										<div class="slide"><a href="#"><img src="{{url('home')}}/images/about/4.jpg" alt="About Image"></a></div>
										<div class="slide"><a href="#"><img src="{{url('home')}}/images/about/5.jpg" alt="About Image"></a></div>
										<div class="slide"><a href="#"><img src="{{url('home')}}/images/about/6.jpg" alt="About Image"></a></div>
										<div class="slide"><a href="#"><img src="{{url('home')}}/images/about/7.jpg" alt="About Image"></a></div>
									</div>
								</div>
							</div>

						</div>

						<div class="col-lg-3 center" data-animate="bounceIn">
							<i class="i-plain i-xlarge mx-auto mb-0 icon-users"></i>
							<div class="counter counter-large" style="color: #3498db;"><span data-from="100" data-to="8465" data-refresh-interval="50" data-speed="2000"></span></div>
							<h5>Clients Served</h5>
						</div>

						<div class="col-lg-3 center" data-animate="bounceIn" data-delay="200">
							<i class="i-plain i-xlarge mx-auto mb-0 icon-code"></i>
							<div class="counter counter-large" style="color: #e74c3c;"><span data-from="100" data-to="56841" data-refresh-interval="50" data-speed="2500"></span></div>
							<h5>Lines of Code</h5>
						</div>

						<div class="col-lg-3 center" data-animate="bounceIn" data-delay="400">
							<i class="i-plain i-xlarge mx-auto mb-0 icon-briefcase"></i>
							<div class="counter counter-large" style="color: #16a085;"><span data-from="100" data-to="2154" data-refresh-interval="50" data-speed="3500"></span></div>
							<h5>No. of Projects</h5>
						</div>

						<div class="col-lg-3 center" data-animate="bounceIn" data-delay="600">
							<i class="i-plain i-xlarge mx-auto mb-0 icon-cup"></i>
							<div class="counter counter-large" style="color: #9b59b6;"><span data-from="100" data-to="874" data-refresh-interval="30" data-speed="2700"></span></div>
							<h5>Cups of Coffee</h5>
						</div>

					</div>

					<div class="promo promo-light p-4 p-md-5 mb-5">
						<div class="row align-items-center">
							<div class="col-12 col-lg">
								<h3>Try Premium Free for <span>30 Days</span> and you'll never regret it!</h3>
								<span>Starts at just <em>$9.99/month</em> afterwards. No Ads, No Gimmicks and No SPAM. Just Real Content.</span>
							</div>
							<div class="col-12 col-lg-auto mt-4 mt-lg-0">
								<a href="#" class="button button-large button-circle button-black m-0">Start Trial</a>
							</div>
						</div>
					</div>

					<div class="heading-block center">
						<h2>Canvas Thinktank</h2>
						<span>Our Team Members who have contributed immensely to our Growth</span>
					</div>

					<div class="row col-mb-50 mb-0">

						<div class="col-lg-6">
							<div class="team team-list row align-items-center">
								<div class="team-image col-sm-6">
									<img src="{{url('home')}}/images/team/3.jpg" alt="John Doe">
								</div>
								<div class="team-desc col-sm-6">
									<div class="team-title"><h4>John Doe</h4><span>CEO</span></div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor freedom. Cesar Chavez empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-light si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="team team-list row align-items-center">
								<div class="team-image col-sm-6">
									<img src="{{url('home')}}/images/team/2.jpg" alt="Josh Clark">
								</div>
								<div class="team-desc col-sm-6">
									<div class="team-title"><h4>Josh Clark</h4><span>Co-Founder</span></div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor freedom. Cesar Chavez empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-light si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="team team-list row align-items-center">
								<div class="team-image col-sm-6">
									<img src="{{url('home')}}/images/team/8.jpg" alt="Mary Jane">
								</div>
								<div class="team-desc col-sm-6">
									<div class="team-title"><h4>Mary Jane</h4><span>Sales</span></div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor freedom. Cesar Chavez empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-light si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="team team-list row align-items-center">
								<div class="team-image col-sm-6">
									<img src="{{url('home')}}/images/team/4.jpg" alt="Nix Maxwell">
								</div>
								<div class="team-desc col-sm-6">
									<div class="team-title"><h4>Nix Maxwell</h4><span>Support</span></div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor freedom. Cesar Chavez empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-light si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-light si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

					</div>

				</div>

				<div class="section topmargin-sm footer-stick">

					<h4 class="text-uppercase center">What <span>Clients</span> Say?</h4>

					<div class="fslider testimonial testimonial-full" data-animation="fade" data-arrows="false">
						<div class="flexslider">
							<div class="slider-wrap">
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="{{url('home')}}/images/testimonials/3.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>
										<div class="testi-meta">
											Steve Jobs
											<span>Apple Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="{{url('home')}}/images/testimonials/2.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
										<div class="testi-meta">
											Collis Ta'eed
											<span>Envato Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="{{url('home')}}/images/testimonials/1.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
										<div class="testi-meta">
											John Doe
											<span>XYZ Inc.</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
        
@endsection

