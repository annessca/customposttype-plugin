<?php
// Get all default theme setting options
function og_custom_get_default_options() {
	$options = array(
		'logo' => ''
	);
	return $options;
}

// Save options to DB
function og_custom_save_options() {
	$og_custom_options = get_option( 'theme_og_custom_options' );
	if ( false === $og_custom_options ) {
		$og_custom_options = og_custom_get_default_options();
		add_option( 'theme_og_custom_options', $og_custom_options );
	}
}
// Initialize all options 
add_action( 'after_setup_theme', 'og_custom_save_options' );


// Add "Company Profile" link to the Top-level menu 
function og_custom_add_menu_options() {
	add_theme_page('Pristine Code Profile', 'Pristine Code Profile', 'edit_theme_options', 'ogcustom-settings', 'og_custom_homepage_admin_options');
}
// Load the Admin Options page 
add_action('admin_menu', 'og_custom_add_menu_options');

function og_custom_homepage_admin_options() {
	?>
	<!-- WP CSS predefined styling for the Admin Panel viewing -->
		<div class="wrap">
			<div id="icon-themes" class="icon32"><br /></div>
			<h2><?php _e( 'About Pristine Code', 'og_custom' ); ?></h2>
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'homepage-settings-errors' ); ?>
			<form method="post" action="options.php">
				<?php 
					settings_fields("about-pristine-code");
					do_settings_sections("pristine-code-details");
					submit_button()
				?>
			</form>
			<div><hr></div>
			<form class="form-homepage-options" action="options.php" method="post" enctype="multipart/form-data">
				<?php
					settings_fields('theme_og_custom_options');
					do_settings_sections('og_custom');
				?>
				<p class="submit">
					<input name="theme_og_custom_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'og_custom'); ?>" />
					<input name="theme_og_custom_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'og_custom'); ?>" />
				</p>
			</form>
		</div>
	<?php
}


function  og_custom_image_settings_setup() {
	register_setting( 'theme_og_custom_options', 'theme_og_custom_options', 'og_custom_options_validate' );

	// Add form sections
	add_settings_section('about_image', __( 'Manage Image upload', 'og_custom' ), 'og_custom_settings_description', 'og_custom');
	
	// Add Fields to Section	
	add_settings_field('og_custom_logo',  __( 'About Image', 'og_custom' ), 'og_custom_set_logo', 'og_custom', 'about_image'); 
    add_settings_field('og_custom_logo_preview',  __( 'About Image Preview', 'og_custom' ), 'og_custom_logo_preview', 'og_custom', 'about_image');

}
add_action( 'admin_init', 'og_custom_image_settings_setup' );

function og_custom_settings_description() {
	?>
		<p><?php _e( 'Update About Image from Theme Settings', 'og_custom' ); ?></p>
	<?php
}

function og_custom_set_logo() {
	$og_custom_options = get_option( 'theme_og_custom_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_og_custom_options[logo]" value="<?php echo esc_url( $og_custom_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Image', 'og_custom' ); ?>" />
		<?php if ( '' != $og_custom_options['logo'] ): ?>
			<input id="delete_logo_button" name="theme_og_custom_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete', 'og_custom' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload About Page Image.', 'og_custom' ); ?></span>
	<?php
}

function og_custom_options_setup() {
	global $pagenow;
	if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
		add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
	}
}
add_action( 'admin_init', 'og_custom_options_setup' );

function replace_thickbox_text($translated_text, $text, $domain) {
	if ('Insert into Post' == $text) {
		$referer = strpos( wp_get_referer(), 'ogcustom-settings' );
		if ( $referer != '' ) {
			return __('Confirm this Image as ABOUT US Image!', $domain );
		}
	}
	return $translated_text;
}

function delete_image( $image_url ) {
	global $wpdb;
	// We need to get the image's meta ID. 
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";
	$results = $wpdb->get_results($query);
	// And delete it 
	foreach ( $results as $row ) {
		wp_delete_attachment( $row->ID );
	}
}

function og_custom_logo_preview() {
    $og_custom_options = get_option( 'theme_og_custom_options' ); ?>
    <div id="upload_logo_preview" style="min-height: 100px;">
        <img style="max-width:100%;" src="<?php echo esc_url( $og_custom_options['logo'] ); ?>" />
    </div>
    <?php
}

function og_custom_options_enqueue_scripts() {
	wp_register_script( 'ogcustom-image-upload', get_template_directory_uri() .'/company-settings/js/ogcustom-image-upload.js', array('jquery','media-upload','thickbox') );
	if ( 'appearance_page_ogcustom-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('ogcustom-image-upload');
	}
}
add_action('admin_enqueue_scripts', 'og_custom_options_enqueue_scripts');


function og_custom_options_validate( $input ){
    $default_options = og_custom_get_default_options();
	$valid_input = $default_options;
	$og_custom_options = get_option('theme_og_custom_options');
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	if ( $submit ) {
		if ( $og_custom_options['logo'] != $input['logo'] && $og_custom_options['logo'] != '' )
            delete_image( $og_custom_options['logo'] );
		$valid_input['logo'] = $input['logo'];

	}
	elseif ( $reset ) {
		    delete_image( $og_custom_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		    delete_image( $og_custom_options['logo'] );
		$valid_input['logo'] = '';
	}
	return $valid_input;
}
