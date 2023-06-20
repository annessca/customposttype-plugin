<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pristine_Code_Service
 */

?>

	<!-- Footer Start -->
	<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Address</h4>
					<p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>10A Anjous Street, Lekki Phase 1, Lagos</p>
					<p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+234 703 552 9072</p>
					<p class="mb-2"><i class="fa fa-envelope me-3"></i>info@pristinecode.com</p>
					<div class="d-flex pt-2">
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Opening Hours</h4>
					<h6 class="text-light">Monday - Friday:</h6>
					<p class="mb-4">09.00 AM - 09.00 PM</p>
					<h6 class="text-light">Saturday - Sunday:</h6>
					<p class="mb-0">09.00 AM - 12.00 PM</p>
				</div>
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Services</h4>
					<a class="btn btn-link" href="">Diagnostic Test</a>
					<a class="btn btn-link" href="">Site Overhauling</a>
					<a class="btn btn-link" href="">UI/UX Review</a>
					<a class="btn btn-link" href="">Graphic Design & Animation</a>
					<a class="btn btn-link" href="">Technical Support</a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">
				<div class="row">
					<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
						&copy; <a class="border-bottom" href="#">Pristine Code</a>, All Right Reserved.

						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						Designed By <a class="border-bottom" href="https://htmlcodex.com">WEB EXPERT</a>
					</div>
					<div class="col-md-6 text-center text-md-end">
						<div class="footer-menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location'	=> 'menu-2',
									'container'			=> 'ul',
									'depth'				=> 1,
								)
							);
							?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer End -->


	<!-- Back to Top -->
	<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
