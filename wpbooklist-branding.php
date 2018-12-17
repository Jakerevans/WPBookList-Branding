<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: WPBookList Branding Extension
Plugin URI: https://www.jakerevans.com
Description: A WPBookList Extension that allows the site owner to brand the core WPBookList Plugin
Version: 1.0.0
Author: Jake Evans
Author URI: https://www.jakerevans.com
License: GPL2
*/ 

global $wpdb;
require_once('includes/branding-functions.php');
require_once('includes/branding-ajaxfunctions.php');

if ( ! defined('WPBOOKLIST_VERSION_NUM' ) ) {
	define( 'WPBOOKLIST_VERSION_NUM', '6.1.2' );
}

// This Extension's Version Number.
define( 'WPBOOKLIST_BRANDING_VERSION_NUM', '6.1.2' );

// Root plugin folder URL of this plugin
define('BRANDING_ROOT_URL', plugins_url().'/wpbooklist-branding/');

// Grabbing database prefix
define('BRANDING_PREFIX', $wpdb->prefix);

// Root plugin folder directory for this plugin
define('BRANDING_ROOT_DIR', plugin_dir_path(__FILE__));

// Root WordPress Plugin Directory.
define( 'BRANDING_ROOT_WP_PLUGINS_DIR', str_replace( '/wpbooklist-branding', '', plugin_dir_path( __FILE__ ) ) );

// Root WPBL Dir.
if ( ! defined('ROOT_WPBL_DIR' ) ) {
	define( 'ROOT_WPBL_DIR', BRANDING_ROOT_WP_PLUGINS_DIR . 'wpbooklist/' );
}

// Root WPBL Url.
if ( ! defined('ROOT_WPBL_URL' ) ) {
	define( 'ROOT_WPBL_URL', plugins_url() . '/wpbooklist/' );
}

// Root WPBL Classes Dir.
if ( ! defined('ROOT_WPBL_CLASSES_DIR' ) ) {
	define( 'ROOT_WPBL_CLASSES_DIR', ROOT_WPBL_DIR . 'includes/classes/' );
}

// Root WPBL Transients Dir.
if ( ! defined('ROOT_WPBL_TRANSIENTS_DIR' ) ) {
	define( 'ROOT_WPBL_TRANSIENTS_DIR', ROOT_WPBL_CLASSES_DIR . 'transients/' );
}

// Root WPBL Translations Dir.
if ( ! defined('ROOT_WPBL_TRANSLATIONS_DIR' ) ) {
	define( 'ROOT_WPBL_TRANSLATIONS_DIR', ROOT_WPBL_CLASSES_DIR . 'translations/' );
}

// Root WPBL Root Img Icons Dir.
if ( ! defined('ROOT_WPBL_IMG_ICONS_URL' ) ) {
	define( 'ROOT_WPBL_IMG_ICONS_URL', ROOT_WPBL_URL . 'assets/img/icons/' );
}

// Root WPBL Root Utilities Dir.
if ( ! defined('ROOT_WPBL_UTILITIES_DIR' ) ) {
	define( 'ROOT_WPBL_UTILITIES_DIR', ROOT_WPBL_CLASSES_DIR . 'utilities/' );
}

// Root Classes Directory for this plugin
define('BRANDING_CLASS_DIR', BRANDING_ROOT_DIR.'includes/classes/');

// Root Classes Directory for this plugin
define('BRANDING_INCLUDES_DIR', BRANDING_ROOT_DIR.'includes/');

// Root UI Admin directory
define('BRANDING_CLASSES_UI_ADMIN_DIR', BRANDING_CLASS_DIR.'ui/admin/');

// Root UI Display directory
define('BRANDING_CLASSES_UI_DISPLAY_DIR', BRANDING_CLASS_DIR.'ui/display/');

// Root Image Icons URL of this plugin
define('BRANDING_ROOT_IMG_URL', BRANDING_ROOT_URL.'assets/img/');

// Root Image Icons URL of this plugin
define('BRANDING_ROOT_IMG_ICONS_URL', BRANDING_ROOT_URL.'assets/img/icons/');

// Root CSS URL for this plugin
define('BRANDING_ROOT_CSS_URL', BRANDING_ROOT_URL.'assets/css/');

// Root JS URL for this plugin
define('BRANDING_ROOT_JS_URL', BRANDING_ROOT_URL.'assets/js/');

// Define the Uploads base directory
$uploads = wp_upload_dir();
$upload_path = $uploads['basedir'];
define('BRANDING_UPLOADS_BASE_DIR', $upload_path.'/');

$upload_url = $uploads['baseurl'];
define('BRANDING_UPLOADS_BASE_URL', $upload_url.'/');

// Adding the front-end ui css file for this plugin
add_action('wp_enqueue_scripts', 'branding_frontend_ui_style');

// Adding the admin css file for this plugin
add_action('admin_enqueue_scripts', 'branding_admin_style' );

// Adding admin page
//add_action( 'admin_menu', 'branding_admin_menu' );

// Registers table names
add_action( 'init', 'branding_register_table_name', 1 );

// Verifies that the core WPBookList plugin is installed and activated - otherwise, the Extension doesn't load and a message is displayed to the user.
register_activation_hook( __FILE__, 'wpbooklist_branding_core_plugin_required' );

// Creates tables upon activation
register_activation_hook( __FILE__, 'branding_create_tables' );

// Adding Ajax library
add_action( 'wp_head', 'branding_add_ajax_library' );

// For instructional admin pointers
add_action( 'admin_footer', 'branding_jre_admin_pointers_javascript' );

// For saving the branding options
add_action( 'admin_footer', 'branding_save_action_javascript' );
add_action( 'wp_ajax_branding_save_action', 'branding_save_action_callback' );
add_action( 'wp_ajax_nopriv_branding_save_action', 'branding_save_action_callback' );

/*
 * Function that utilizes the filter in the core WPBookList plugin, resulting in a new tab. Possible options for the first argument in the 'Add_filter' function below are:
 *  - 'wpbooklist_add_tab_books'
 *  - 'wpbooklist_add_tab_display'
 *
 *
 *
 * The instance of "Bulkbookupload" in the $extra_tab array can be replaced with whatever you want - but the 'bulkbookupload' instance MUST be your one-word descriptor.
*/
add_filter('wpbooklist_add_tab_display', 'wpbooklist_branding_tab');
function wpbooklist_branding_tab($tabs) {
 	$extra_tab = array(
		'branding'  => __("Branding", 'plugin-textdomain'),
	);
 
	// combine the two arrays
	$tabs = array_merge($tabs, $extra_tab);
	return $tabs;
}



?>