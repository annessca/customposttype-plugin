<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pristine_Code_Service
 */

get_header();
?>

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
					<img class="w-100" src="<?php echo get_template_directory_uri() ?>/assets/img/web-3963945_1920.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
									<?php
									$pristine_code_service_description = get_bloginfo( 'description', 'display' );
									if ( $pristine_code_service_description || is_customize_preview() ) :
									?>
									<h6 class="text-white text-uppercase mb-3 animated slideInDown"><?php echo $pristine_code_service_description;?></h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Technical Support</h1>
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">About Us<i class="fa fa-arrow-right ms-3"></i></a>
									<?php endif; ?>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
									<img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/assets/img/laptop_PNGIMG.png" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
					<img class="w-100" src="<?php echo get_template_directory_uri() ?>/assets/img/software-developer-6521720_1920.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
									<?php
									$pristine_code_service_description = get_bloginfo( 'description', 'display' );
									if ( $pristine_code_service_description || is_customize_preview() ) :
									?>
									<h6 class="text-white text-uppercase mb-3 animated slideInDown"><?php echo $pristine_code_service_description;?></h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Technical Support</h1>
                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Contact Us<i class="fa fa-arrow-right ms-3"></i></a>
									<?php endif; ?>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
								<img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/assets/img/laptop_PNGIMG.png" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Blog Start -->
    <div class="container-xxl py-2">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">Latest Blog</h1>
            </div>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="row g-4">

                    <?php
                    if ( have_posts() ) :

                        if ( is_home() && ! is_front_page() ) :
                            ?>
                            <header>
                                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                            </header>
                            <?php
                        endif;

                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/content', get_post_type() );

                        endwhile;

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif;
                    ?>
                </div>
            </article><!-- #post-<?php the_ID(); ?> -->
		</div>
	</div>
<?php
get_footer();
