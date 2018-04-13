<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Harvest Live - Farm Management Systems </title>		
		<meta name="keywords" content="quoting, estimating, job tracking, staff management, tradie app" />
		<meta name="description" content="Harvest Live - Quotation and Job Tracking Made Easy - Tradie Work Apps">
		<meta name="author" content="ABL IT Business IT Specialists">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Libs CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css" media="screen">
		<link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css" media="screen">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" media="screen">
		<link rel="stylesheet" href="vendor/isotope/jquery.isotope.css" media="screen">
		<link rel="stylesheet" href="vendor/mediaelement/mediaelementplayer.css" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Responsive CSS -->
		<link rel="stylesheet" href="css/theme-responsive.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr.js"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="vendor/respond.js"></script>
		<![endif]-->

	</head>
	<body>
<?php include_once("analytics.php") ?>
		<div class="body">
			<header id="header">
				<div class="container">
					<h1 class="logo">
						<a href="index.php">
							<img alt="ABLWorks" width="250" height="38" data-sticky-width="130" data-sticky-height="20" src="img/logo.png">
						</a>
					</h1>
					<div class="search">
						<form id="searchForm" action="page-search-results.html" method="get">
							<div class="input-group">
								<input type="text" class="form-control search" name="q" id="q" placeholder="Search...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
								</span>
							</div>
						</form>
					</div>
					<ul class="social-icons">
						<li class="facebook"><a href="https://www.facebook.com/harvestlive" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/harvestlive" target="_blank" title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="https://www.linkedin.com/company/harvest-live" target="_blank" title="Linkedin">Linkedin</a></li>
					</ul>
					<nav>
						<ul class="nav nav-pills nav-top">
							<li>
								<a href="http://www.ablit.com.au" target="_blank"><i class="icon icon-angle-right"></i>ABL IT</a>
							</li>
							<li>
								<a href="ablit.com.au/contact"><i class="icon icon-angle-right"></i>Contact Us</a>
							</li>
							<li class="phone">
								<span><a href="tel:1300133317"><i class="icon icon-phone"></i>1300 133 317</a></span>
							</li>
						</ul>
					</nav>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="icon icon-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">
								<li>
									<a class="dropdown-toggle" href="#">About Us</a>
								</li>
								<li>
									<a class="dropdown-toggle" href="#">Contact Us</a>
								</li>
								<li class="dropdown mega-menu-item mega-menu-signin signin" id="headerAccount">
									<a class="dropdown-toggle" href="page-login.html">
										<i class="icon icon-user"></i> Sign In
										<i class="icon icon-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-12">

														<div class="signin-form">

															<span class="mega-menu-sub-title">Sign In</span>

															<form action="" id="" type="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>E-mail Address</label>
																			<input type="text" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<a class="pull-right" id="headerRecover" href="#">(Lost Password?)</a>
																			<label>Password</label>
																			<input type="password" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<span class="remember-box checkbox">
																			<label for="rememberme">
																				<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																			</label>
																		</span>
																	</div>
																	<div class="col-md-6">
																		<input type="submit" value="Login" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																	</div>
																</div>
															</form>

															<p class="sign-up-info">Don't have an account yet? <a href="#" id="headerSignUp">Sign Up!</a></p>

														</div>

														<div class="signup-form">
															<span class="mega-menu-sub-title">Create Account</span>

															<form action="" id="" type="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>E-mail Address</label>
																			<input type="text" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-6">
																			<label>Password</label>
																			<input type="password" value="" class="form-control input-lg">
																		</div>
																		<div class="col-md-6">
																			<label>Re-enter Password</label>
																			<input type="password" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<input type="submit" value="Create Account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																	</div>
																</div>
															</form>

															<p class="log-in-info">Already have an account? <a href="#" id="headerSignIn">Log In!</a></p>
														</div>

														<div class="recover-form">
															<span class="mega-menu-sub-title">Reset My Password</span>
															<p>Complete the form below to receive an email to confirm how to reset your account.</p>

															<form action="" id="" type="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>E-mail Address</label>
																			<input type="text" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<input type="submit" value="Submit" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																	</div>
																</div>
															</form>

															<p class="log-in-info">Already have an account? <a href="#" id="headerRecoverCancel">Log In!</a></p>
														</div>

													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>

			<div role="main" class="main">
				
				<div class="container">
				
					<div class="row center">
						<div class="col-md-12">
							<h2 class="short word-rotator-title">
								Harvest Live is
								<strong class="inverted">
									<span class="word-rotate">
										<span class="word-rotate-items">
											<span>simple</span>
											<span>powerful</span>
											<span>awesome</span>
										</span>
									</span>
								</strong>
							</h2>
							<p class="featured lead">
								Manage & Grow your Farm. Picking, Packing & Inventory. Fully integrated with Xero.
							</p>
						</div>
					</div>
				
				</div>
				
				<div class="home-concept">
					<div class="container">
				
						<div class="row center">
							<span class="sun"></span>
							<span class="cloud"></span>
							<div class="col-md-2 col-md-offset-1">
								<div class="process-image" data-appear-animation="bounceIn">
									<img src="img/home-concept-item-1.png" alt="" />
									<strong>Schedule Work</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
									<img src="img/home-concept-item-2.png" alt="" />
									<strong>Manage Staff</strong>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
									<img src="img/home-concept-item-3.png" alt="" />
									<strong>Track Invoices</strong>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-1">
								<div class="project-image">
									<div id="fcSlideshow" class="fc-slideshow">
										<ul class="fc-slides">
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-1.jpg" /></a></li>
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" /></a></li>
											<li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-3.png" /></a></li>
										</ul>
									</div>
									<strong class="our-work">Get Paid.</strong>
								</div>
							</div>
						</div>
				
					</div>
				</div>
                <p>&nbsp;</p>
                <div class="home-intro">
					<div class="container">
				
						<div class="row">
							<div class="col-md-8">
								<p>
									The fastest way to grow your business with <em>farm management</em>
									<span>Check out our options and features included.</span>
								</p>
							</div>
							<div class="col-md-4">
								<div class="get-started">
									<a href="#" class="btn btn-lg btn-primary">Get Started Now!</a>
									<div class="learn-more">or <a href="index.html">learn more.</a></div>
								</div>
							</div>
						</div>
				
					</div>
				</div>
				
				<div class="container">
				
					<div class="row">
						<hr class="tall" />
					</div>
				
				</div>
				
				<div class="container">
				
					<div class="row">
						<div class="col-md-8">
							<h2><strong>Features</strong></h2>
							<div class="row">
								<div class="col-md-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-group"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Quick Quote / Full Estimation</h4>
											<p class="tall">Whether you are quoting a leaking sink or a complete bathroom reno. Works has the power to make your life easier.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-calendar-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Calendar System</h4>
											<p class="tall">Daily, Weekly or Monthly - Know what is happening at any time. Fully integrates with Google Calendars.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-plan-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Planning Ahead</h4>
											<p class="tall">Plan your work ahead of schedule and easily find room for more work.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-invoice-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Useful Invoicing</h4>
											<p class="tall">Automatically create Invoices, Print to PDF, and send to a client. Fully integrated with Xero Accounting.</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-xero-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Xero Integration</h4>
											<p class="tall">Synchronize your Invoices with Xero in one click. Then let Xero do the hard work for you.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-folder-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Job and Quote Archive</h4>
											<p class="tall">You will never forget what jobs you had on, or what jobs you didn't quite get. All of this information will always be available to you.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-map-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Interactive Map</h4>
											<p class="tall">A completely interactive map using Google Maps to help you visualize all of your current and past jobs. Get directions to the next job with ease.</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon icon-user-w"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="shorter">Manage Staff</h4>
											<p class="tall">Assign your work load to your staff and they will receive constant updates via email and push notifications for where they should be.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h2>& heaps more...</h2>
				
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												<i class="icon icon-usd"></i>
												Full Support
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="accordion-body collapse in">
										<div class="panel-body">
											ABL IT Staff are available directly from within the App to assist you with any enquiries you may have. ABL IT maintain developers and database engineers to quickly resolve any issues that you may come across.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
												<i class="icon icon-comment"></i>
												Business Reporting
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="accordion-body collapse">
										<div class="panel-body">
											Harvest Live generates the reporting that you need to know, and doesn't overcomplicate anything. It will send you simple reports that are easy to understand - so that you can focus on what matters.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
												<i class="icon icon-laptop"></i>
												Automated Systems
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="accordion-body collapse">
										<div class="panel-body">
											You don't need to work 24 hours a day. Let Harvest Live handle all of your updating and emailing clients. You put in the basics and Harvest Live will do the rest. 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				
					<hr class="tall" />
				
					<div class="row center">
						<div class="col-md-12">
							<h2 class="short word-rotator-title">
								We're not the only ones
								<strong>
									<span class="word-rotate">
										<span class="word-rotate-items">
											<span>excited</span>
											<span>stoked</span>
										</span>
									</span>
								</strong>
								about Harvest Live...
							</h2>
							<h4 class="lead tall">Hundreds are starting out with Harvest Live. Join them and never look back.</h4>
						</div>
					</div>
					<div class="row center">
						<div class="owl-carousel" data-plugin-options='{"items": 6, "singleItem": false, "autoPlay": true}'>
							<div>
								<img class="img-responsive" src="img/logos/logo-1.jpg" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-2.jpg" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-3.jpg" alt="">
							</div>
							<!-- <div>
								<img class="img-responsive" src="img/logos/logo-4.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-5.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-6.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-4.png" alt="">
							</div>
							<div>
								<img class="img-responsive" src="img/logos/logo-2.png" alt="">
							</div> -->
						</div>
					</div>
				
				</div>
				
				<div class="map-section">
					<section class="featured footer map">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="recent-posts push-bottom">
										<h2>Latest <strong>Blog</strong> Posts</h2>
										<div class="row">
											<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true}'>
												<div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">Harvest Live Website Live!</a></h4>
															<p>Ten ways to make your business clear and effective. <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">How to make Harvest Live work for you</a></h4>
															<p>Ten ways Harvest Live can make a difference to your business. <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
												</div>
												<div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">Sneak Peak</a></h4>
															<p>Our App is nearly ready for the masses. Here's a sneak peak. <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">The Ultimate Tool for Tradies</a></h4>
															<p>............ <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
												</div>
												<div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">Earn More by Working Less</a></h4>
															<p>............. <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
													<div class="col-md-6">
														<article>
															<div class="date">
																<span class="day">22</span>
																<span class="month">Oct</span>
															</div>
															<h4><a href="blog-post.html">Helping Small Business Grow</a></h4>
															<p>............. <a href="/" class="read-more">read more <i class="icon icon-angle-right"></i></a></p>
														</article>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<h2><strong>What</strong> Our Client’s Say</h2>
									<div class="row">
										<div class="owl-carousel push-bottom" data-plugin-options='{"items": 1, "autoHeight": true}'>
											<div>
												<div class="col-md-12">
													<blockquote class="testimonial">
													<p>My business was struggling to gain momentum in the industry. We've been around for years, grown to over 10 staff and then downsized. I've seen the ups and downs of small business. </p>
                                                    <p>Harvest Live was exactly what we needed to get our team organised, know our harvest schedule and exactly what we had to actually get out and do.
                                                    The proof is in the pudding, this thing works.</p>
													</blockquote>
													<div class="testimonial-arrow-down"></div>
													<div class="testimonial-author">
														<div class="img-thumbnail img-thumbnail-small">
															<img src="img/clients/client-1.jpg" alt="">
														</div>
														<p><strong>.</strong><span>Brisbane, Australia</span></p>
													</div>
												</div>
											</div>
											<div>
												<div class="col-md-12">
													<blockquote class="testimonial">
													<p>This App is exactly what I was looking for. Now I know exactly what stage every block of dirt is sitting at. Simple.</p>
													</blockquote>
													<div class="testimonial-arrow-down"></div>
													<div class="testimonial-author">
														<div class="img-thumbnail img-thumbnail-small">
															<img src="img/clients/client-1.jpg" alt="">
														</div>
														<p><strong>.</strong><span>Brisbane, Australia</span></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>

			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="col-md-3">
							<div class="newsletter">
								<h4>Newsletter</h4>
								<p>If you're interested in receiving updates on our product, subscribe to our newsletter.</p>
			
								<div class="alert alert-success hidden" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our emailing list. You might even hear from us!
								</div>
			
								<div class="alert alert-danger hidden" id="newsletterError"></div>
			
								<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
									<div class="input-group">
										<input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							<h4>Latest Tweet</h4>
							<div id="tweet" class="twitter" data-account-id="harvestlive">
								<p>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Contact Us</h4>
								<ul class="contact">
									<li><p><i class="icon icon-map-marker"></i> <strong>Address:</strong> Unit 4, 255 Leitchs Road<br> Brendale QLD 4500</p></li>
									<li><p><i class="icon icon-phone"></i> <strong>Phone:</strong> 1300 133 317</p></li>
									<li><p><i class="icon icon-envelope"></i> <strong>Email:</strong> <a href="mailto:support@ablit.com.au">support@ablit.com.au</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<h4>Follow Us</h4>
							<div class="social-icons">
								<ul class="social-icons">
									<li class="facebook"><a href="http://www.facebook.com/harvestlive" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">Facebook</a></li>
									<li class="twitter"><a href="http://www.twitter.com/harvestlive" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">Twitter</a></li>
									<li class="linkedin"><a href="https://www.linkedin.com/company/harvest-live" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">LinkedIn</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								&nbsp;
							</div>
							<div class="col-md-7">
								<p>© Copyright 2014-2018 ABL IT Business IT Specialists. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									<ul>
										<li><a href="#">FAQ</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Libs -->
		<script src="vendor/jquery.js"></script>
		<script src="vendor/jquery.appear.js"></script>
		<script src="vendor/jquery.easing.js"></script>
		<script src="vendor/jquery.cookie.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/jquery.validate.js"></script>
		<script src="vendor/jquery.stellar.js"></script>
		<script src="vendor/jquery.knob.js"></script>
		<script src="vendor/jquery.gmap.js"></script>
		<script src="vendor/twitterjs/twitter.js"></script>
		<script src="vendor/isotope/jquery.isotope.js"></script>
		<script src="vendor/owl-carousel/owl.carousel.js"></script>
		<script src="vendor/jflickrfeed/jflickrfeed.js"></script>
		<script src="vendor/magnific-popup/magnific-popup.js"></script>
		<script src="vendor/mediaelement/mediaelement-and-player.js"></script>
		
		<!-- Theme Initializer -->
		<script src="js/theme.plugins.js"></script>
		<script src="js/theme.js"></script>
		
		<!-- Current Page JS -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="js/views/view.home.js"></script>
		
		<!-- Custom JS -->
		<script src="js/custom.js"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script type="text/javascript">
		
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-12345678-1']);
			_gaq.push(['_trackPageview']);
		
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		
		</script>
		 -->

	</body>
</html>
