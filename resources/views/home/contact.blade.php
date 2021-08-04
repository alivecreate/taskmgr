@extends('home.layout.front-other')
@section('title','CONTACT US - WELCOME TO CCPL WORLD An ISO 9001 : 2008 certified company')
@section('content')
@section('breadcrumb-name', 'Contact Us')
@section('breadcrumb-title', 'Everything you need to know about our Company')

@section('custom-head')
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
@endsection

@section('custom-footer')
@endsection

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14766.397276532349!2d73.2357313!3d22.2931629!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe3ac5345b9e2eee6!2z4Kqa4Kq-4Kqw4KuB4Kqk4KqwIOCqleCri-CquOCrjeCqruCrh-Cqn-Cqv-CqleCrjeCquCDgqqrgq43gqrDgqr7gqofgqrXgq4fgqp8g4Kqy4Kq_4Kqu4Kq_4Kqf4KuH4Kqh!5e0!3m2!1sgu!2sin!4v1622117828840!5m2!1sgu!2sin"
 width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<!-- Postcontent
						============================================= -->
						<div class="postcontent col-lg-9">

							<h3>Send us an Email</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="row mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="col-md-4 form-group">
										<label for="template-contactform-name">Name <small>*</small></label>
										<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
									</div>

									<div class="col-md-4 form-group">
										<label for="template-contactform-email">Email <small>*</small></label>
										<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
									</div>

									<div class="col-md-4 form-group">
										<label for="template-contactform-phone">Phone</label>
										<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
									</div>

									<div class="w-100"></div>

									<div class="col-md-8 form-group">
										<label for="template-contactform-subject">Subject <small>*</small></label>
										<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
									</div>

									<div class="col-md-4 form-group">
										<label for="template-contactform-service">Services</label>
										<select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
											<option value="">-- Select One --</option>
											<option value="Wordpress">Wordpress</option>
											<option value="PHP / MySQL">PHP / MySQL</option>
											<option value="HTML5 / CSS3">HTML5 / CSS3</option>
											<option value="Graphic Design">Graphic Design</option>
										</select>
									</div>

									<div class="w-100"></div>

									<div class="col-12 form-group">
										<label for="template-contactform-message">Message <small>*</small></label>
										<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
									</div>

									<div class="col-12 form-group d-none">
										<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
									</div>

									<div class="col-12 form-group">

										<script src="https://www.google.com/recaptcha/api.js" async defer></script>
										<div class="g-recaptcha" data-sitekey="6LfijgUTAAAAACPt-XfRbQszAKAJY0yZDjjhMUQT"></div>

									</div>

									<div class="col-12 form-group">
										<button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>

							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">

							<address>
								<strong>Headquarters:</strong><br>
								Plot No-643,Waghodia GIDC ,<br>
								Waghodia, Dist- Vadodara, Gujarat , India<br>
							</address>
							<abbr title="Mobile Number"><strong>Mob No:</strong></abbr> (+91) 98795 93308<br>
							<abbr title="Phone Number"><strong>Phone:</strong></abbr> (+91) 2668 263010<br>
							
							<abbr title="Email Address"><strong>Email:</strong></abbr> charotarcos@gmail.com

							<div class="widget border-0 pt-0">

								<!-- <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="3" data-animation="fade" data-arrows="false">
									<i class="i-plain i-small color icon-twitter mb-0" style="margin-right: 15px;"></i>
									<div class="flexslider" style="width: auto;">
										<div class="slider-wrap">
											<div class="slide"></div>
										</div>
									</div>
								</div> -->

							</div>

							<div class="widget border-0 pt-0">

								<a href="#" class="social-icon si-small si-dark si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-dribbble">
									<i class="icon-dribbble"></i>
									<i class="icon-dribbble"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-forrst">
									<i class="icon-forrst"></i>
									<i class="icon-forrst"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-pinterest">
									<i class="icon-pinterest"></i>
									<i class="icon-pinterest"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-gplus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

							</div>

						</div>
					</div>

				</div>
			</div>
		</section>

@endsection

