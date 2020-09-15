<?php 
/**
 * @package WP Exit Intent
 * @version 1.0.0
 */
/*
Plugin Name: WP Exit Intent
Plugin URI: https://iamwillard.com/wp-exit-intent
Description: Exit Intent for Wordpress
Author: Willard Macay
Version: 1.0.0
Author URI: https://iamwillard
*/


/**
 * Register and Enqueue Scripts.
 */
function wp_exit_intent_register_scripts() {
	$pages = esc_attr( get_option('wp_exit_intent_page_ids') );
	$ids = explode (",", $pages); 
	$current_id = get_the_ID();
	if(in_array($current_id, $ids)){
		wp_enqueue_style( 'wp-exit-intent-css', plugin_dir_url(__FILE__) . 'dist/main.css', null, 1 );
		wp_enqueue_script( 'wp-exit-intent-js', plugin_dir_url(__FILE__) . 'dist/main.js', array(), 1, true );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_exit_intent_register_scripts' );

function wp_exit_intent_render_element(){
	$pages = esc_attr( get_option('wp_exit_intent_page_ids') );
	$ids = explode (",", $pages); 
	$current_id = get_the_ID();
	if(in_array($current_id, $ids)){
		include( plugin_dir_path( __FILE__ ) . 'template.php');
	}
	
}
add_action('wp_footer', 'wp_exit_intent_render_element');






// create custom plugin settings menu
add_action('admin_menu', 'wp_exit_intent_create_menu');

function wp_exit_intent_create_menu() {

	//create new top-level menu
	add_menu_page('Exit Intent Settings', 'Exit Intent Settings', 'administrator', __FILE__, 'wp_exit_intent_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_wp_exit_intent_settings' );
}


function register_wp_exit_intent_settings() {
	//register our settings
	register_setting( 'wp-exit-intent-settings-group', 'wp_exit_intent_cf7_id' );
	register_setting( 'wp-exit-intent-settings-group', 'wp_exit_intent_page_ids' );
	register_setting( 'wp-exit-intent-settings-group', 'wp_exit_intent_download_link' );
	
}

function wp_exit_intent_settings_page() {
?>
<div class="wrap">
<h1>Exit Intent</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wp-exit-intent-settings-group' ); ?>
    <?php do_settings_sections( 'wp-exit-intent-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Contact Form 7 ID</th>
        <td><input type="text" name="wp_exit_intent_cf7_id" value="<?php echo esc_attr( get_option('wp_exit_intent_cf7_id') ); ?>" /></td>
				</tr>
				<tr valign="top">
        <th scope="row">Download Link</th>
        <td><input size="100" type="text" name="wp_exit_intent_download_link" value="<?php echo esc_attr( get_option('wp_exit_intent_download_link') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Pages (page id separatd by comma)</th>
        <td><input type="text" name="wp_exit_intent_page_ids" value="<?php echo esc_attr( get_option('wp_exit_intent_page_ids') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>