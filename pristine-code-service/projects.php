<?php 

/* Template Name: Projects */

/**
 * The template for creating the Projecst page that contains a preview and images.
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Projects</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Projects</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<?php

$pristine_projects_count = intval(get_post_meta($post->ID, 'archived-posts-no', true));
if($pristine_projects_count > 200 || $pristine_projects_count < 2) $pristine_projects_count = 6;
$ppr_query = new WP_Query('post_type=pristine-projects&nopaging=1');
if($ppr_query->have_posts()) {
    $counter = 1;
    while($ppr_query->have_posts() && $counter <= $pristine_projects_count) {
        $ppr_query->the_post();

        ?>
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8 col-md-6">
                        <?php 
                        $meta_value = get_post_meta( get_the_ID(), 'meta-text', true ); 
                        if( !empty( $meta_value ) ) { 
                            ?>
                                <h6 class="text-primary text-uppercase" id="modal1-exit"><?php echo $meta_value; ?></h6>
                            <?php
                        } ?>
                        
                        <h1 class="mb-4"><?php the_title(); ?></h1>
                        <div class="mb-0">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bg-primary d-flex flex-column justify-content-center text-center h-100 p-4">
                            <a href="#modal1-content" class="btn btn-danger py-3 px-5">Preview<i class="fa fa-eye ms-3"></i></a>
                            <a href="" class="btn btn-secondary py-3 px-5">Project Details<i class="fa fa-arrow-right ms-3"></i></a>
                        </div>
                        <div class="prime-modal-container" id="modal1-content">
                            <div class="prime-modal">
                                <h1 class="prime-modal__title"><?php the_title(); ?></h1>
                                <!-- The four columns -->
                                <div class="row">
                                    <div class="column">
                                        <?php 
                                        $meta_image_value = get_post_meta( get_the_ID(), 'meta-image', true);
                                        if( !empty( $meta_image_value )) { ?>
                                            <img src="<?php echo $meta_image_value; ?>" style="width:100%">
                                        <?php } ?>    
                                    </div>
                                    <div class="column">
                                        <?php 
                                        $meta_image_value1 = get_post_meta( get_the_ID(), 'meta-image-one', true);
                                        if( !empty( $meta_image_value1 )) { ?>
                                            <img src="<?php echo $meta_image_value1; ?>" style="width:100%">
                                        <?php } ?>    
                                    </div>
                                    <div class="column">
                                        <?php 
                                        $meta_image_value2 = get_post_meta( get_the_ID(), 'meta-image-two', true);
                                        if( !empty( $meta_image_value2 )) { ?>
                                            <img src="<?php echo $meta_image_value2; ?>" style="width:100%">
                                        <?php } ?>    
                                    </div>
                                    <div class="column">
                                        <?php 
                                        $meta_image_value3 = get_post_meta( get_the_ID(), 'meta-image-three', true);
                                        if( !empty( $meta_image_value3 )) { ?>
                                            <img src="<?php echo $meta_image_value3; ?>" style="width:100%">
                                        <?php } ?>    
                                    </div>
                                </div>
                                <div class="prime-modal__text">
                                    <?php the_content(); ?>
                                </div>
                                <a href="http://localhost/tekexpert/projects/" class="link-2"></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php 
        $counter++;
    }
    wp_reset_postdata();
}

get_footer();