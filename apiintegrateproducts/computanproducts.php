<?php
require( plugin_dir_path( __FILE__ ) . 'pagetemplater.php');
defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );
/*
Plugin Name: Computan Custom Post Type Plugin
Plugin URI:  https://github.com/Computan-Tests/wp--anne-essien
Description: Creates a custom post type with custom taxonomies and populates it by saving dummy json data to the database. Creates a page along with a page template to display products in a Bootstrap 5 grid.
Version:     1.0.0
Author:      Anne Essien
Author URI:  https://portfolio-of-anne.netlify.app/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');


function computan_register_taxonomy_brand() {
    $labels = array(
        'name'              => _x( 'Brand', 'taxonomy general name' ),
        'singular_name'     => _x( 'Brand', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Brands' ),
        'all_items'         => __( 'All Brands' ),
        'parent_item'       => __( 'Parent Brand' ),
        'parent_item_colon' => __( 'Parent Brand:' ),
        'edit_item'         => __( 'Edit Brand' ),
        'update_item'       => __( 'Update Brand' ),
        'add_new_item'      => __( 'Add New Brand' ),
        'new_item_name'     => __( 'New Brand Name' ),
        'menu_name'         => __( 'Brand' ),
    );
    $args   = array(
        'hierarchical'      => false, //(like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'brand' ],
    );
    register_taxonomy( 'brand', 'wp_computan_products', $args );
}
add_action( 'init', 'computan_register_taxonomy_brand' );

function computan_register_taxonomy_cstmcategory() {
    $labels = array(
        'name'              => _x( 'Customcategory', 'taxonomy general name' ),
        'singular_name'     => _x( 'Customcategory', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Customcategories' ),
        'all_items'         => __( 'All Customcategories' ),
        'parent_item'       => __( 'Parent Customcategory' ),
        'parent_item_colon' => __( 'Parent Customcategory:' ),
        'edit_item'         => __( 'Edit Customcategory' ),
        'update_item'       => __( 'Update Customcategory' ),
        'add_new_item'      => __( 'Add New Customcategory' ),
        'new_item_name'     => __( 'New Customcategory Name' ),
        'menu_name'         => __( 'Customcategory' ),
    );
    $args   = array(
        'hierarchical'      => false, //(like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'customcategory' ],
    );
    register_taxonomy( 'customcategory', 'wp_computan_products', $args );
}
add_action( 'init', 'computan_register_taxonomy_cstmcategory' );


add_post_type_support( 'wp_computan_products', 'thumbnail' ); 
//register the location content type
function computan_register_custom_product_type(){
    //Labels for post type
    $labels = array(
        'name'               => 'Product',
        'singular_name'      => 'Product',
        'menu_name'          => 'Products',
        'name_admin_bar'     => 'Product',
        'add_new'            => 'Add New', 
        'add_new_item'       => 'Add New Product',
        'new_item'           => 'New Product', 
        'edit_item'          => 'Edit Product',
        'view_item'          => 'View Product',
        'all_items'          => 'All Products',
        'search_items'       => 'Search Products',
        'parent_item_colon'  => 'Parent Product:', 
        'not_found'          => 'No Products found.', 
        'not_found_in_trash' => 'No Products found in Trash.',
    );
    //arguments for post type
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'publicly_queryable'=> true,
        'show_ui'           => true,
        'show_in_nav'       => true,
        'query_var'         => true,
        'hierarchical'      => true,
        'supports'          => array('title','thumbnail','editor'),
        'has_archive'       => true,
        'menu_position'     => 20,
        'show_in_admin_bar' => true,
        'menu_icon'         => 'dashicons-products',
        'rewrite'           => array('slug' => 'wp_computan_products', 'with_front' => 'true'),
        'taxonomies'        => array('brand', 'customcategory')
    );
    //register post type
    register_post_type('wp_computan_products', $args);
    register_taxonomy_for_object_type( 'customcategory', 'wp_computan_products' );
	register_taxonomy_for_object_type( 'brand', 'wp_computan_products' );
}

add_action('init', 'computan_register_custom_product_type');

function computan_products_meta_box() {
    add_meta_box(
        'products_meta_box',
        'Product Fields',
        'computan_display_fields_meta_box', // $callback 
        'wp_computan_products', 
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'computan_products_meta_box' );

function computan_display_fields_meta_box() {
    global $post;
    $meta = get_post_meta( $post->ID, 'product_fields', true ); ?>

    <input type="hidden" name="product_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
    <p>
        <label for="product_fields[apiid]">API ID</label>
        <br>
        <input type="text" name="product_fields[apiid]" id="product_fields[apiid]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['apiid'])){ echo $meta['apiid']; } ?>">
    </p>

    <p>
        <label for="product_fields[price]">Price</label>
        <br>
        <input type="text" name="product_fields[price]" id="product_fields[price]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['price'])){ echo $meta['price']; } ?>">
    </p>

    <p>
        <label for="product_fields[discount]">Discount Percentage</label>
        <br>
        <input type="text" name="product_fields[discount]" id="product_fields[discount]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['discount'])){ echo $meta['discount']; } ?>">
    </p>

    <p>
        <label for="product_fields[rating]">Rating</label>
        <br>
        <input type="text" name="product_fields[rating]" id="product_fields[rating]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['rating'])){ echo $meta['rating']; } ?>">
    </p>

    <p>
        <label for="product_fields[stock]">Stock</label>
        <br>
        <input type="text" name="product_fields[stock]" id="product_fields[stock]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['stock'])){ echo $meta['stock']; } ?>">
    </p>

    <p>
        <label for="product_fields[url]">Image URL</label>
        <br>
        <input type="hidden" name="product_fields[url]" id="product_fields[url]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['url'])){ echo $meta['url']; } ?>">
    </p>

    <p>
        <label for="product_fields[rating]">Rating</label>
        <br>
        <input type="hidden" name="product_fields[brand]" id="product_fields[brand]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['brand'])){ echo $meta['brand']; } ?>">
    </p>

    <p>
        <label for="product_fields[stock]">Stock</label>
        <br>
        <input type="hidden" name="product_fields[category]" id="product_fields[category]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['category'])){ echo $meta['customcat']; } ?>">
    </p>

    <?php 
}

function computan_save_product_fields_meta( $post_id ) {
    // verify nonce
    if ( !wp_verify_nonce( $_POST['product_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    $old = get_post_meta( $post_id, 'product_fields', true );
    $new = $_POST['product_fields'];

    if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'product_fields', $new );
    } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'product_fields', $old );
    }
}
add_action( 'save_post', 'computan_save_product_fields_meta' );

function get_attachment_url_by_title( $title ) {
    global $wpdb;

    $attachments = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = '$title' AND post_type = 'attachment' ", OBJECT );
    //print_r($attachments);
    if ( $attachments ){

        $attachment_id= $attachments[0]->ID;

    }else{
        return 'image-not-found';
    }

    return $attachment_id;
}


/**
 * Automatically create posts for the Product custom post type by reading dummy json data and saving it to the database.
 * 
 * @param null $name, $content, $template, $author_id, $status.
 * 
 * @return null
 */

function computan_create_custom_product_type(){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, 'https://dummyjson.com/product');
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json'
    ));

    $productList = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    $jsonArrayResponse = json_decode($productList);

    if ($jsonArrayResponse) {
        foreach($jsonArrayResponse->products as $product) {   
            $url = $product->thumbnail;
            $user_id = 1;
            $image_title = $product->title.'-'.$product->id;      
            $product_archive_post = array(
                'post_title'    => $product->title,
                'post_content'  => $product->description,
                'post_type'     => 'wp_computan_products',
                'post_status'   => 'publish',
                'post_author'   => $user_id,
                //'tax_input'     => array(
                    //'customcategory'  => $product->category,
                    //'brand'     => $product->brand
                //),   
                'meta_input'    => array(
                    'product_fields' => array(
                        'apiid' => "{$product->id}",
                        'price'     => (string) $product->price,
                        'discount'  => (string) $product->discountPercentage,
                        'rating'    => (string) $product->rating,
                        'stock'     => (string) $product->stock,
                        'url'       => $product->thumbnail,
                        'category'  => $product->category,
                        'brand'     => $product->brand
                    )
				),
            );
            if( !get_page_by_title( $product->title, OBJECT, 'wp_computan_products' ) ) {
                $post_id = wp_insert_post( $product_archive_post, true );
                //wp_set_object_terms($post_id, $product->category, 'customcategory', true);
                //wp_set_object_terms($post_id, $product->brand, 'brand', true);
                get_attachment_url_by_title($image_title);
                media_sideload_image( $url, $post_id, $image_title);
                $image_id = get_attachment_url_by_title( $image_title );
                set_post_thumbnail( $post_id, $image_id );
            }
        }
    }
}

//add_action('admin_init', 'computan_create_custom_product_type');


if (! function_exists('computan_page_creator')) {
    /**
     * Automatically create pages and link them to plugin-generated page templates
     * 
     * @param array $name, $content, $template, $author_id, $status.
     * 
     * @return NULL
     */
	function computan_page_creator($name, $content, $template, $author_id, $status) {
        $page_name = $name;
        $page_details = array(
            'post_title'	=> wp_strip_all_tags( $name ),
            'post_content'	=> $content,
            'post_status'	=> $status,
            'post_type'		=> 'page',
            'post_author'	=> $author_id,
            'page_template'	=> $template
        );
        if ( null == get_page_by_title($page_name, OBJECT, 'page') )  {
			wp_insert_post( $page_details, true );
		}        
	}
}


/**
 * Activate the plugin.
 */
function computan_plugin_activate() { 
	// Trigger our function that registers the custom post type plugin.
	computan_register_custom_product_type(); 
    // Create the custom post type for Products and three pages that will link to three different page templates
    computan_create_custom_product_type();
    computan_page_creator('Product Archive', '', 'Product Archive Template', 1, 'publish');
    computan_page_creator('Product Brand', '', 'Product Brand Template', 1, 'publish');
    computan_page_creator('Product Category', '', 'Product Category Template', 1, 'publish');
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'computan_plugin_activate' );

/**
 * Deactivation hook.
 */
function computan_plugin_deactivate() {
	// Unregister the post type, so the rules are no longer in memory.
	unregister_post_type( 'wp_computan_products' );
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'computan_plugin_deactivate' );

/**
 * Enqueue scripts
 */
function computan_scripts_and_styles(){

    // Enqueue stylesheets
    wp_register_style( 'grid', plugins_url( 'css/grid.css', __FILE__) );
    wp_register_style( 'bootstrap', plugins_url( 'css/bootstrap.min.css', __FILE__) );
    wp_enqueue_style( 'grid' );
    wp_enqueue_style( 'bootstrap' );

    // Enqueue Javascript
    wp_register_script( 'bootstrap.bundle', plugins_url('js/bootstrap.bundle.min.js', __FILE__) );
    wp_enqueue_style( 'bootstrap.bundle' );
}

add_action( 'wp_enqueue_scripts', 'computan_scripts_and_styles' );