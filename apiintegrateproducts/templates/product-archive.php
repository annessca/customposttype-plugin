<?php 

/* Template Name: Product List Template */

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

    <div class="filter-wrap">
        <div class="category">
            <div class="field-title">Category</div>
            <?php $get_categories = get_categories(array('hide_empty' => 0)); ?>
                <select class="js-category">
                    <option value="all">All</option>
                    <?php
                        if ( $get_categories ) :
                            foreach ( $get_categories as $cat ) :
                        ?>
                        <option value="<?php echo $cat->term_id; ?>">
                            <?php echo $cat->name; ?>
                        </option>
                        <?php endforeach; 
                            endif;
                        ?>
                </select>
        </div>

        <div class="date">
            <div class="field-title">Sort by</div>
            <select class="js-date">
                <option value="new">Newest</option>
                <option value="old">Oldest</option>
            </select>
        </div>
    </div>



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
            $args =  array(
                'post_type' => 'wp_computan_products',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );
            $wp_computan_custom_query = new WP_Query( $args );
            if ($wp_computan_custom_query->have_posts()) :
			    while ($wp_computan_custom_query->have_posts()) : $wp_computan_custom_query->the_post(); 
                    $meta = get_post_meta( $post->ID, 'product_fields', true ); ?>
                    <div class="col-4 themed-grid-col">
                        <div class="bg-light me-md-6 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                            <div class="my-2 p-2">
                                <h4 class="text-decoration-underline product-title"><?php the_title(); ?></h4>
                                <h6><strong class="badge text-bg-success">$<?php if (is_array($meta) && isset($meta['price'])){ echo $meta['price']; } ?></strong></h6>  
                            </div>
                            <?php
                            // Get Product categories
                            $prodcats = get_the_terms( $post->ID, 'customcategory', true );
                            if(!$prodcats) { ?>
                                <p><strong class="badge text-bg-warning"><?php if (is_array($meta) && isset($meta['category'])){ echo $meta['category']; } ?></strong></p>
                            <?php }
                            else {
                                foreach ( $prodcats as $prodcat ) { ?>
                                    <p><strong class="badge text-bg-warning"><?php echo $prodcat->name ?></strong></p>
                                <?php } 
                            }
                            
                            // Get Product categories
                            $prodbrands = get_the_terms( $post->ID, 'brand', true );
                            if(!$prodbrands) { ?>
                                <p><strong class="small mark"><?php if (is_array($meta) && isset($meta['brand'])){ echo $meta['brand']; } ?></strong></p>
                            <?php }
                            else {
                                foreach ( $prodbrands as $prodbrand ) { ?>
                                    <p><strong class="small mark"><?php echo $prodbrand->name ?></strong></p>
                                <?php } 
                            }
                            ?> 

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