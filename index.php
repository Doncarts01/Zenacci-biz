<?php

include("./backend/config/init.php");

$settings = Settings::findOrFail(1);
$services = Services::all();
$pricing = Pricing::all();
$partners = Partners::all();
?>

<!DOCTYPE html>
<html lang="en-US">

<head>

	<!-- Meta
	============================================= -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1, max-scale=1">

	<meta name="author" content="ExplicitConcepts">


	<!-- Stylesheets
	============================================= -->
	<link href="css/css-assets.css" rel="stylesheet">	<!-- description -->
<!-- Updated meta description -->
<meta name="description" content="ExplicitConcepts Agency helps businesses grow sales through proven strategies, scalable systems, and expert coaching. We specialize in lead generation, sales automation, and long-term profit growth.">

<!-- Updated meta keywords -->
<meta name="keywords" content="sales growth, lead generation, sales automation, marketing strategies, business growth, client acquisition, increase sales, digital marketing, sales systems, business coaching, high-converting strategies, sales funnel">

	<link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400i,400,700i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700i,700" rel="stylesheet">

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= $settings->imageShow() ?>">

	<!-- Title
	============================================= -->
	<title>Zenacci</title>

	<script type="text/javascript">
		// window.smartlook||(function(d) {
		// var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
		// var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
		// c.charset='utf-8';c.src='../../../rec.smartlook.com/recorder.js';h.appendChild(c);
		// })(document);
		// smartlook('init', 'd2e1a0babfc0afc3117db9c0a47d71ee3f16b12f');
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109302796-10"></script>
	<script>
		//   window.dataLayer = window.dataLayer || [];
		//   function gtag(){dataLayer.push(arguments);}
		//   gtag('js', new Date());

		//   gtag('config', 'UA-109302796-10');
	</script>
</head>

<body>

	<div id="scroll-progress">
		<div class="scroll-progress"><span class="scroll-percent"></span></div>
	</div>

	<!-- Loading Progress
	============================================= -->
	<!-- <div id="loading-progress">
		<a class="logo" href="#">
			<img src="" width="100px" data-logo-alt="images/files/logo-header-alt.png" alt="">
			<h3><span class="colored">Smiley</span></h3>
			<span>HTML Template</span>
		</a>
		<div class="lp-content">
			<div class="lp-counter">
				Loading
				<div id="lp-counter">0%</div>
			</div 
			<div class="lp-bar">
				<div id="lp-bar"></div>
			</div
		</div>
	</div> -->

	<!-- Document Full Container
	============================================= -->
	<div id="full-container">

		<!-- Header
		============================================= -->
		<header id="header">

			<div id="header-bar-1" class="header-bar">

				<div class="header-bar-wrap">

					<div class="container">
						<div class="row">
							<div class="col-md-12">

								<div class="hb-content">
									<a class="logo logo-header" href="./index.php">
										<img src="<?= $settings->imageShow() ?>" data-logo-alt="<?= $settings->imageShow() ?>" alt="" width="80px">
										<h3><span class="colored">Zenacci</span></h3>
										<span></span>
									</a><!-- .logo end -->
									<div class="hb-meta">
									</div><!-- .hb-meta end -->
								</div><!-- .hb-content end -->

							</div><!-- .col-md-12 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .header-bar-wrap -->

			</div><!-- #header-bar-1 end -->

		</header><!-- #header end -->

		<!-- Banner
		============================================= -->
		<section id="banner">

			<div class="banner-parallax" data-banner-height="930">
				<img src="./images/files/header.png" alt="">
				<div class="slide-content">

					<div class="container">
						<div class="row">
							<div class="col-md-6">

								<div class="banner-center-box">
									<span class="tag-label">Call Us: <?= $settings->phone ?></span>
									<span class="tag-label">Email Us: <?= $settings->email ?></span>
									<h1>
										<?php
										$parts = explode(' ', $settings->text);
										echo $parts[0] . ' ' . $parts[1] . '<br>' . $parts[2] . ' ' . $parts[3];
										?>
									</h1>
									<div class="description">
										<?= $settings->description ?>
									</div>
									<!-- <a class="btn popup-btn x-large colorful hover-colorful-darken mt-40" href="#header">Call To Action</a> -->
									<a class="btn x-large colorful hover-colorful-darken mt-40" href="#pricing-plans">Get Started</a>
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-6 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .slide-content end -->
				<div class="section-separator rounded bottom">
					<div class="ss-content">
						<img class="svg" src="images/general-elements/section-separators/rounded.svg" alt="">
					</div><!-- .ss-content -->
				</div><!-- .section-separator -->
			</div><!-- .banner-parallax end -->

		</section><!-- #banner end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div id="content-wrap">
				<!-- === Intro Features =========== -->
				<div id="intro-features" class="flat-section">
					<div class="section-content">
						<div class="container">
							<div class="row">
								<div class="col-12 col-md-12">
									<div class="slider-services">
										<div class="row">
											<?php
											if (!empty($services)):
												foreach ($services as $item): ?>
													<div class="col-12 col-md-12" style="margin-bottom: 10px;">
														<div class="slide">
															<div class="box-info box-info-1 <?= $item->color ?>">
																<div class="box-icon icon"><img src="<?= $item->imageShow() ?>" alt=""></div>
																<div class="box-content">
																	<h4>
																		<?= $item->title ?>
																	</h4>
																	<p>
																		<?= $item->description ?>
																	</p>
																	<?php
																	$tags = explode(',', $item->tags);
																	foreach ($tags as $item):
																	?>
																		<span class="tag-label">
																			<?= $item ?>
																		</span>
																	<?php endforeach;  ?>
																</div><!-- .box-content end -->
															</div><!-- .box-info end -->
														</div><!-- .slide end -->
													</div>
											<?php
												endforeach;
											endif;
											?>
										</div>
									</div><!-- .slider-services end -->

								</div><!-- .col-md-12 end -->

								<div class="divider-90"></div>

								<div class="col-md-12 ">

									<p class="font-size-14px text-center">
										Trusted by the world’s most innovative businesses – big and small
									</p>
									<div class="slider-clients">
										<ul class="owl-carousel">
											<?php
											if (!empty($partners)):
												foreach ($partners as $item):
											?>
													<li>
														<div class="slide">
															<div class="client-single"><a href="<?= $item->url ?>"><img src="<?= $item->imageShow() ?>"
																		alt=""></a></div>
														</div><!-- .slide end -->
													</li>
											<?php
												endforeach;
											endif;
											?>
										</ul>
									</div><!-- .slider-clients end -->

								</div><!-- .col-md-12 end -->

								<div class="divider-140 divider-md-100"></div>

								<div class="col-md-5 col-md-push-7 md-text-center">

									<div class="section-title">
										<span class="icon theme-color-3"><i class="flaticon-bulb"></i></span>
										<h2>
											Guaranteed Results
										</h2>
										<p class="description">
											Are you tired of chasing clients?
											Are you struggling with low sales?
											Are you wasting resources on strategies that don’t convert?
											We know how that feels, and this is where that ends. Guaranteed!
											Our proven growth systems, and expert coaching are designed for long-term sales growth.
											You’ll gain real strategies, support, and fast results.
										</p>
									</div><!-- .section-title end -->

								</div><!-- .col-md-5 end -->
								<div class="col-md-6 col-md-pull-5 mb-md-60 md-text-center align-items center">

									<img src="images/files/featured-img-1.png" alt="">

								</div><!-- .col-md-6 end -->

								<div class="divider-70 divider-md-40"></div>

								<div class="col-md-5 md-text-center">

									<div class="section-title">
										<span class="icon theme-color-4"><i class="flaticon-money"></i></span>
										<h2>
											Unlimited Growth Potential
										</h2>
										<p class="description">
											Once your sales start growing, our next step is to build sustainable momentum.

											We don’t believe in quick fixes or one-time wins.
											We create scalable systems designed to evolve with your business.
											This helps you:

										</p>
										<ul style="list-style-position: inside;">
											<li>Attract high-quality leads consistently</li>
											<li>Automate your sales processes</li>
											<li>Maximize every marketing effort for long-term profit</li>
											<li>Turn satisfied customers into loyal advocates</li>
										</ul>

										<p style="margin-top:10px;">
										Whether you’re aiming to 2X, 5X, or 10X your current results, the right systems and strategy make it achievable.

										You’ve seen what’s possible, now let’s make it happen.
										</p>
									</div><!-- .section-title end -->

								</div><!-- .col-md-5 end -->
								<div class="col-md-6 col-md-offset-1 md-text-center">

									<img src="images/files/featured-img-2.png" alt="" style="">

								</div><!-- .col-md-6 end -->

							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .row end -->
				</div><!-- .container end -->


			</div><!-- .section-content end -->

	</div><!-- .flat-section end -->



	<!-- === Pricing Plans =========== -->
	<div id="pricing-plans" class="flat-section">
		<div class="section-content">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="section-title text-center">
							<span class="icon theme-color-2"><i class="flaticon-target"></i></span>
							<h2>
								Pricing Plan
							</h2>
							<p class="description">
								Choose the perfect growth package for your business: our pricing plans offers flexible options, all designed to grow your business sales and deliver exceptional returns.

							</p>
						</div><!-- .section-title end -->

					</div><!-- .col-md-8 end -->
					<div class="col-md-12">

						<div class="pricing-table">

							<div class="row">
								<?php
								if (!empty($pricing)):
									$i = 0;
									foreach ($pricing as $item):
										$i++;
								?>
										<div class="col-md-4 col-sm-6">

											<div class="pt-column <?= ($i == 2) ? 'featured' : '' ?> ">
												<div class="pt-column-header">
													<div class="title">
														<span><?= $item->plan ?></span>
													</div><!-- .title end -->
													<div class="price">
														<h1 style="font-size: 3rem;"><span class="counter-stats">₦ <?= $item->price ?></span></h1>
														<span class="period"><?= $item->duration ?></span>
													</div><!-- .price end -->
												</div>
												<ul class="pt-column-content">
													<?php
													$features = explode("\n", trim($item->description));
													foreach ($features as $feature):
													?>
														<li style="font-size: 1.32rem;"><?= trim($feature) ?></li>
													<?php endforeach; ?>
												</ul>

												<div class="pt-column-footer">
													<?php
													if ($item->is_form == 0):
													?>
														<a class="btn colorful small hover-dark" href="<?= $item->url ?>" target="_blank">
															<?= $item->cta ?>
														</a>
													<?php
													else: ?>
														<a class="btn colorful small hover-dark" href="./form?package=<?= base64_encode($item->id) ?>" target="_blank">
															<?= $item->cta ?>
														</a>
													<?php
													endif;
													?>
												</div><!-- .pt-column-footer end -->
											</div><!-- .pt-column end -->

										</div><!-- .col-md-4 end -->
								<?php
									endforeach;
								endif;
								?>


							</div><!-- .row end -->

						</div><!-- .pricing-table end -->

					</div><!-- .col-md-12 end -->

				</div><!-- .row end -->
			</div><!-- .container end -->

		</div><!-- .section-content end -->

	</div><!-- .flat-section end -->


	<!-- === CTA Title 1 =========== -->
	<div id="cta-title-1" class="parallax-section">

		<div class="section-separator rounded top">
			<div class="ss-content">
				<img class="svg" src="images/general-elements/section-separators/rounded.svg" alt="">
			</div><!-- .ss-content -->
		</div><!-- .section-separator -->
		<div class="section-content">

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<span class="tag-label">Call Us: <?= $settings->phone ?></span>
						<span class="tag-label">Email Us: <?= $settings->email ?></span>
						<h1>
							<?php
							$parts = explode(' ', $settings->text);
							echo $parts[0] . ' ' . $parts[1] . '<br>' . $parts[2] . ' ' . $parts[3];
							?>
						</h1>
						<div class="description">
							<?= $settings->description ?>
						</div>
						<a class="btn scroll-to x-large colorful hover-colorful-darken mt-40" href="#header">Back To Top</a>

					</div><!-- .col-md-10 end -->
				</div><!-- .row end -->
			</div><!-- .container end -->

		</div><!-- .section-content end -->

	</div>
	<!-- .parallax-section end -->

	</div><!-- #content-wrap -->

	</section><!-- #content end -->

	<!-- Footer
		============================================= -->
	<footer id="footer">

		<div id="footer-bar-1" class="footer-bar" style="background-color:rgba(113, 97, 67, 0.09);">

			<div class="footer-bar-wrap">

				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<div class="fb-row">
								<div class="copyrights-message"><?= Date('Y') ?> © <a href=""><span class="colored">Zenacci</span></a>. All Rights Reserved.</div>
								<ul class="social-icons animated x4 grey hover-colorful icon-only">
									<li><a class="si-facebook" href="#"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a></li>
									<li><a class="si-twitter" href="#"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a></li>
									<li><a class="si-instagramorange" href="#"><i class="fa fa-instagram"></i><i class="fa fa-instagram"></i></a></li>
								</ul><!-- .social-icons end -->
							</div><!-- .fb-row end -->

						</div><!-- .col-md-12 end -->
					</div><!-- .row end -->
				</div><!-- .container end -->

			</div><!-- .footer-bar-wrap -->

		</div><!-- #footer-bar-1 end -->

	</footer><!-- #footer end -->

	</div><!-- #full-container end -->

	<a class="scroll-top-icon scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

	<div class="popup-preview">
		<div class="popup-bg"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">

					<div class="popup-content">
						<div class="cta-subscribe cta-subscribe-2 box-form">
							<div class="box-title">
								<div class="popup-close hamburger hamburger--slider is-active">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</div><!-- .popup-close -->
								<h3 class="title">Get Your Free Quote</h3>
								<p>Supporting Call to Action Goes Here</p>
							</div><!-- end .box-title -->
							<div class="box-content">
								<form id="form-cta-subscribe-2" class="form-inline" action="./backend/api/save.php" method="POST">
									<div class="cs-notifications">
										<div class="cs-notifications-content"></div>
									</div><!-- .cs-notifications end -->
									<div class="form-group">
										<input type="text" name="cs2Name" id="cs2Name" class="form-control" placeholder="Your Name">
									</div><!-- .form-group end -->
									<div class="form-group">
										<input type="text" name="cs2Email" id="cs2Email" class="form-control" placeholder="Your Email">
									</div><!-- .form-group end -->
									<div class="form-group">
										<input type="submit" class="form-control" value="Call To Action">
									</div><!-- .form-group end -->
								</form><!-- #form-cta-subscribe-1 end -->
							</div><!-- .box-content end -->
						</div><!-- .box-form end -->
					</div><!-- .popup-content end -->

				</div><!-- .col-md-6 end -->
			</div><!-- .row end -->
		</div><!-- .container end -->
	</div><!-- .popup-preview -->

	<!-- External JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/jRespond.min.js"></script>
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/jquery.waitforimages.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.fitvids.js"></script>
	<script src="js/simple-scrollbar.min.js"></script>
	<script src="js/jquery.stellar.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.mb.YTPlayer.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/simple-scrollbar.min.js"></script>
	<script src='js/functions.js'></script>



	<script>
		$(document).ready(function() {
			n("#form-cta-subscribe-2").validate({
				rules: {
					cs2Name: {
						required: !0,
						minlength: 3
					},
					cs2Email: {
						required: !0,
						email: !0
					},
				},
			});
			var e = n(".cs-notifications").data("error-msg"),
				s = e || "Please Follow Error Messages and Complete as Required";
			n("#form-cta-subscribe-2").on("submit", function(e) {
				if (e.isDefaultPrevented()) {
					var t = '<i class="cs-error-icon fa fa-close"></i>' + s;
					p(!1, t), f();
				} else
					e.preventDefault(),
					(a = n("#cs2Name").val()),
					(i = n("#cs2Email").val()),
					alert(a)
				n.ajax({
					type: "POST",
					url: "./backend/api/save.php",
					data: "cs2Name=" + a + "&cs2Email=" + i,
					success: function(e) {
						var t, a;
						"success" == e
							?
							((t = n(".cs-notifications").data("success-msg")),
								(a = t || "Thank you for your submission :)"),
								n("#form-cta-subscribe-2")[0].reset(),
								p(!0, '<i class="cs-success-icon fa fa-check"></i>' + a),
								n(".cs-notifications-content").addClass("sent"),
								n(".cs-notifications").css("opacity", 0),
								n(".cs-notifications")
								.slideDown(300)
								.animate({
									opacity: 1
								}, 300)
								.delay(5e3)
								.slideUp(400)) :
							(f(), p(!1, e));
					},
				});
				var a, i;
			});
		});
	</script>

</body>

</html>