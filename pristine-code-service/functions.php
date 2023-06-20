<?php
/**
 * Pristine Code Service functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pristine_Code_Service
 */

require_once( 'company-settings/company-settings.php' );

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pristine_code_service_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Pristine Code Service, use a find and replace
		* to change 'pristine-code-service' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pristine-code-service', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'pristine-code-service' ),
			'menu-2' => esc_html__( 'Secondary', 'pristine-code-service' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pristine_code_service_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pristine_code_service_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pristine_code_service_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pristine_code_service_content_width', 640 );
}
add_action( 'after_setup_theme', 'pristine_code_service_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pristine_code_service_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pristine-code-service' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pristine-code-service' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pristine_code_service_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pristine_code_service_scripts() {

	wp_enqueue_style( 'pristine-code-service-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', 'all');
	wp_enqueue_style( 'pristine-code-service-main', get_template_directory_uri() . '/assets/css/main.css');
	wp_enqueue_style( 'pristine-code-service-owl-carousel', get_template_directory_uri() . '/assets/lib/owlcarousel/assets/owl.carousel.min.css', 'all');
	wp_enqueue_style( 'pristine-code-service-animate', get_template_directory_uri() . '/assets/lib/animate/animate.min.css', 'all');
	wp_enqueue_style( 'pristine-code-service-tempusdominus-bootstrap', get_template_directory_uri() . '/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css');
	
	wp_enqueue_script( 'pristine-code-service-moment', get_template_directory_uri() . '/assets/lib/tempusdominus/js/moment.min.js', true );
	wp_enqueue_script( 'pristine-code-service-moment-timezone', get_template_directory_uri() . '/assets/lib/tempusdominus/js/moment-timezone.min.js', true);
	wp_enqueue_script( 'pristine-code-service-tempusdominus-bootstrap', get_template_directory_uri() . '/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js', true);
	wp_enqueue_script( 'pristine-code-service-owl-carousel', get_template_directory_uri() . '/assets/lib/owlcarousel/owl.carousel.min.js', true);
	wp_enqueue_script( 'pristine-code-service-waypoints', get_template_directory_uri() . '/assets/lib/waypoints/waypoints.min.js', true);
	wp_enqueue_script( 'pristine-code-service-easing', get_template_directory_uri() . '/assets/lib/easing/easing.min.js', true);
	wp_enqueue_script( 'pristine-code-service-wow', get_template_directory_uri() . '/assets/lib/wow/wow.min.js', true);
	wp_enqueue_script( 'pristine-code-service-main', get_template_directory_uri() . '/assets/js/main.js', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pristine_code_service_scripts' );


/**
 * Register a custom post type.
 *
 * This function makes it possible to create custom posts for services post entries.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 */
function pristine_code_service_services() {
    register_post_type( 'pristine-services', array(
        'labels'    => array(
            'name'  => __( 'Pristine Services' ),
			'singular_name' => __( 'Pristine Services' )
        ),
        'public'			=> true,
        'hierarchical'		=> true,
        'has_archive'		=> true,
		'menu_icon'			=> 'dashicons-performance',
		'show_in_rest'		=> true,
        'supports'			=> array(
            'title',
			'editor',
			'excerpt',
            'thumbnail',
        )
    ));
}
add_action( 'init', 'pristine_code_service_services', 0 );


/**
 * Register a custom post type.
 *
 * This function makes it possible to create custom posts for projects post entries.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 */
function pristine_code_service_projects() {
    register_post_type( 
		'pristine-projects', array(
			'labels'    => array(
				'name'  => __( 'Pristine Projects' ),
				'singular_name' => __( 'Pristine Projects' )
			),
			'public'			=> true,
			'hierarchical'		=> true,
			'has_archive'		=> true,
			'menu_icon'			=> 'dashicons-admin-generic',
			'show_in_rest'		=> true,
			'supports'			=> array(
				'title',
				'editor',
				'excerpt',
			),
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		),
	);
	register_taxonomy_for_object_type( 'category', 'your_post' );
	register_taxonomy_for_object_type( 'post_tag', 'your_post' );
}
add_action( 'init', 'pristine_code_service_projects', 0 );


function prfx_custom_meta() {
	add_meta_box( 'pee-meta', 'Pee Box', 'prfx_meta_callback', 'pristine-projects');
}

add_action( 'add_meta_boxes', 'prfx_custom_meta' );

function prfx_meta_callback( $post ) {
	echo 'Additional Fields';
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-text" class="prfx-row-title"><?php _e( 'Project ID', 'prfx-textdomain' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['meta-text'] ) ) echo $prfx_stored_meta['meta-text'][0]; ?>" />
    </p>

	<p>
    	<label for="meta-image" class="prfx-row-title"><?php _e( 'Image For Gallery', 'prfx-textdomain' )?></label>
    	<input type="text" name="meta-image" id="meta-image" value="<?php if ( isset ( $prfx_stored_meta['meta-image'] ) ) echo $prfx_stored_meta['meta-image'][0]; ?>" />
    	<input type="button" id="meta-image-button" class="button" value="<?php _e( 'Upload Image', 'prfx-textdomain' )?>" />
	</p>

	<p>
    	<label for="meta-image-one" class="prfx-row-title"><?php _e( 'Image For Gallery', 'prfx-textdomain' )?></label>
    	<input type="text" name="meta-image-one" id="meta-image-one" value="<?php if ( isset ( $prfx_stored_meta['meta-image-one'] ) ) echo $prfx_stored_meta['meta-image-one'][0]; ?>" />
	</p>

	<p>
    	<label for="meta-image-two" class="prfx-row-title"><?php _e( 'Image For Gallery', 'prfx-textdomain' )?></label>
    	<input type="text" name="meta-image-two" id="meta-image-two" value="<?php if ( isset ( $prfx_stored_meta['meta-image-two'] ) ) echo $prfx_stored_meta['meta-image-two'][0]; ?>" />
	</p>

	<p>
    	<label for="meta-image-three" class="prfx-row-title"><?php _e( 'Image For Gallery', 'prfx-textdomain' )?></label>
    	<input type="text" name="meta-image-three" id="meta-image-three" value="<?php if ( isset ( $prfx_stored_meta['meta-image-three'] ) ) echo $prfx_stored_meta['meta-image-three'][0]; ?>" />
	</p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }

	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-image' ] ) ) {
		update_post_meta( $post_id, 'meta-image', $_POST[ 'meta-image' ] );
	}

	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-image-one' ] ) ) {
		update_post_meta( $post_id, 'meta-image-one', $_POST[ 'meta-image-one' ] );
	}

	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-image-two' ] ) ) {
		update_post_meta( $post_id, 'meta-image-two', $_POST[ 'meta-image-two' ] );
	}

	// Checks for input and saves if needed
	if( isset( $_POST[ 'meta-image-three' ] ) ) {
		update_post_meta( $post_id, 'meta-image-three', $_POST[ 'meta-image-three' ] );
	}
 
}
add_action( 'save_post', 'prfx_meta_save' );

/**
 * Loads the image management javascript
 */
function prfx_image_enqueue() {
    global $typenow;
    if( $typenow == 'pristine-projects' ) {
        wp_enqueue_media();
 
        // Registers and enqueues the required javascript.
		wp_register_script( 'meta-box-image', get_template_directory_uri() .'/assets/js/meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Upload Image', 'prfx-textdomain' ),
                'button' => __( 'Use this image', 'prfx-textdomain' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );



add_filter( 'get_custom_logo', 'pristine_code_service_change_logo_class' );

function pristine_code_service_change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'navbar-brand d-flex align-items-center px-4 px-lg-5', $html );
    $html = str_replace( 'custom-logo-link', 'navbar-brand d-flex align-items-center px-4 px-lg-5', $html );

    return $html;
}


//THEME SETTINGS
function pristine_code_aboutpage_settings(){
	?>
	<div class="form-wrapper">
		<h1>About Page Setting</h1>
		<form method="post" action="options.php">
			<?php 
				settings_fields("about-pristine-code");
				do_settings_sections("pristine-code-details");
				submit_button()
			?>
		</form>
	</div>
	<?php
}

function pristine_code_abouttitle() { 
	?>
	<input type="text" name="abouttitle" id="abouttitle" value="<?php echo get_option('abouttitle'); ?>" />
	<?php 
}

function pristine_code_aboutsummary() { 
	?>
	<input type="text" name="aboutsummary" id="aboutsummary" value="<?php echo get_option('aboutsummary'); ?>" />
	<?php 
}

function pristine_code_point1() { 
	?>
	<input type="text" name="point1" id="point1" value="<?php echo get_option('point1'); ?>" />
	<?php 
}

function pristine_code_point2() { 
	?>
	<input type="text" name="point2" id="point2" value="<?php echo get_option('point2'); ?>" />
	<?php 
}

function pristine_code_point3() { 
	?>
	<input type="text" name="point3" id="point3" value="<?php echo get_option('point3'); ?>" />
	<?php 
}

function pristine_code_point4() { 
	?>
	<input type="text" name="point4" id="point4" value="<?php echo get_option('point4'); ?>" />
	<?php 
}

function pristine_code_point1details() { 
	?>
	<input type="text" name="point1details" id="point1details" value="<?php echo get_option('point1details'); ?>" />
	<?php 
}

function pristine_code_point2details() { 
	?>
	<input type="text" name="point2details" id="point2details" value="<?php echo get_option('point2details'); ?>" />
	<?php 
}

function pristine_code_point3details() { 
	?>
	<input type="text" name="point3details" id="point3details" value="<?php echo get_option('point3details'); ?>" />
	<?php 
}

function pristine_code_point4details() { 
	?>
	<input type="text" name="point4details" id="point4details" value="<?php echo get_option('point4details'); ?>" />
	<?php 
}

function pristine_code_settings_setup() {
	add_settings_section('about-pristine-code', 'Admin Only', null, 'pristine-code-details');
	add_settings_field('abouttitle', 'About Page Heading', 'pristine_code_abouttitle', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('aboutsummary', 'About Page Summary', 'pristine_code_aboutsummary', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point1', 'First Topic', 'pristine_code_point1', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point2', 'Second Topic', 'pristine_code_point2', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point3', 'Third Topic', 'pristine_code_point3', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point4', 'Fourth Topic', 'pristine_code_point4', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point1details', 'First Details', 'pristine_code_point1details', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point2details', 'Second Details', 'pristine_code_point2details', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point3details', 'Third Details', 'pristine_code_point3details', 'pristine-code-details', 'about-pristine-code');
	add_settings_field('point4details', 'Fourth Details', 'pristine_code_point4details', 'pristine-code-details', 'about-pristine-code');
	
	
	register_setting('about-pristine-code', 'abouttitle');
	register_setting('about-pristine-code', 'aboutsummary');
	register_setting('about-pristine-code', 'point1');
	register_setting('about-pristine-code', 'point2');
	register_setting('about-pristine-code', 'point3');
	register_setting('about-pristine-code', 'point4');
	register_setting('about-pristine-code', 'point1details');
	register_setting('about-pristine-code', 'point2details');
	register_setting('about-pristine-code', 'point3details');
	register_setting('about-pristine-code', 'point4details');

}
add_action( 'admin_init', 'pristine_code_settings_setup' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function pristine_code_service_add_li_class($classes, $pristine_service, $args) {
	if(isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}

add_filter('nav_menu_css_class', 'pristine_code_service_add_li_class', 1, 3);

function pristine_code_service_logo_class($html)
{
	$html = str_replace('class="custom-logo"', '', $html);
	$html = str_replace('class="custom-logo-link"', '', $html);
	return $html;
}

add_filter('get_custom_logo','pristine_code_service_logo_class');