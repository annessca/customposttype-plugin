<?php 

/* Template Name: Product Brand Template */

/**
 * The template for displaying all products pulled in through the Products post type
 *
 * @link https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/
 *
 * @package computan
 */

get_header();
?>

<main>
    <div class="container">
        <div class="px-4 py-5 my-5 text-center">
            <div class="col-lg-6 mx-auto">
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="<?php echo get_bloginfo( 'wpurl' );?>/product-brand" type="button" class="btn btn-outline-success btn-lg px-4 gap-3 h5">All Brands</a>
                    <a href="<?php echo get_bloginfo( 'wpurl' );?>/product-category" type="button" class="btn btn-outline-warning btn-lg px-4 gap-3 h5">All Categories</a>
                    <a href="<?php echo get_bloginfo( 'wpurl' );?>/product-archive" type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold h5">All Products</a>
                </div>
            </div>
        </div>

        <div class="row mb-3 text-center">
            <?php
            $brandargs = array(
                'post_type' => 'wp_computan_products',
                'post_status' => 'publish',
                'post_per_page' => 100,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'Brand',
                        'field' => 'slug',
                        'terms' => array( 'brand' ),
                        'operator' => 'IN'
                    )
                    
                ),
            );
            $brand_post_query = new WP_Query( $brandargs );
            if ($brand_post_query->have_posts()) :
			    while ($brand_post_query->have_posts()) : $brand_post_query->the_post(); 
                    $meta = get_post_meta( $post->ID, 'product_fields', true ); ?>
                    <div class="col-4 themed-grid-col">
                        <div class="bg-light me-md-6 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                            <div class="my-2 p-2">
                                <h4 class="text-decoration-underline product-title"><?php the_title(); ?></h4>
                                <h6><strong class="badge text-bg-success">$<?php if (is_array($meta) && isset($meta['price'])){ echo $meta['price']; } ?></strong></h6>  
                            </div>
                            <?php
                            $prodcats = get_the_terms( $post->ID, 'customcategory' );
                            foreach ( $prodcats as $prodcat ) { ?>
                                <p><strong class="badge text-bg-warning"><?php echo $prodcat->name ?></strong></p>
                            <?php } 

                            $prodbrands = get_the_terms( $post->ID, 'brand' );
                            foreach ( $prodbrands as $prodbrand ) { ?>
                                <p><strong class="small mark"><?php echo $prodbrand->name; ?></strong></p>
                            <?php } ?> 
                            <img class="bg-body shadow-sm mx-auto" style="width: 100%; height: auto; border-radius: 21px;" src="<?php if (is_array($meta) && isset($meta['url'])){ echo $meta['url']; } ?>">
                            <!--?php echo get_the_post_thumbnail(); ?-->
                        </div>
                    </div>
            <?php endwhile; endif; wp_reset_postdata() ?>
        </div>
    </div>
</main>

<?php
get_footer();