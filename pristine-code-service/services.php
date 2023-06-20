<?php 

/* Template Name: Services */

/**
 * The template for creating an index page for all services and their summary.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pristine_code_service
 */

get_header();
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/img/web-3963945_1920.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<section id="content">
    <div class="aside">
        <div class="container_12">
            <div class="grid_12">
                <div class="pad-2 wrap">
                    <h3 class="p5">Our Services</h3>
                    <div class="wrap block-4">
                        
                            <?php
                            $pristine_services_count = intval(get_post_meta($post->ID, 'archived-posts-no', true));
                            if($pristine_services_count > 200 || $pristine_services_count < 2) $pristine_services_count = 6;
                            $psc_query = new WP_Query('post_type=pristine-services&nopaging=1');
                            if($psc_query->have_posts()) {
                                $counter = 1;
                                while($psc_query->have_posts() && $counter <= $pristine_services_count) {
                                    $psc_query->the_post();
                            ?>
                                <div> 
                                    <div class="service-image">
                                        <?php pristine_code_service_post_thumbnail(); ?>
                                    </div>
                                    <p><a href="<?php the_permalink(); ?>" class="link"><strong><?php the_title(); ?></strong></a></p>
                                    <?php the_excerpt(); ?>
                                    <small><a href="<?php the_permalink(); ?>">Read More</a></small>
                                </div>
                            <?php 
                            $counter++;
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>

<?php
get_footer();