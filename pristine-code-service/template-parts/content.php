<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pristine_Code_Service
 */

?>
	<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
		<div class="img-control img-border">
			<?php pristine_code_service_post_thumbnail(); ?>
		</div>
		<div class="d-flex bg-light py-5 px-4">
			<div class="ps-4">
				<?php the_title( '<h5 class="mb-3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );?>
				<?php the_excerpt(); ?>
				<a class="text-secondary border-bottom" href="<?php the_permalink(); ?>">Read More</a>
			</div>
		</div>
	</div>
