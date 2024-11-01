<?php
/*
Plugin Name: Three D Cube
Plugin URI: https://github.com/Maxim-us/three-d-cube
Description: Brief description
Author: Marko Maksym
Version: 1.0
Author URI: https://github.com/Maxim-us
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Unique string - MXTDC
*/

/*
* Define MXTDC_PLUGIN_PATH
*
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\three-d-cube\three-d-cube.php
*/
if ( ! defined( 'MXTDC_PLUGIN_PATH' ) ) {

	define( 'MXTDC_PLUGIN_PATH', __FILE__ );

}

/*
* Define MXTDC_PLUGIN_URL
*
* Return http://my-domain.com/wp-content/plugins/three-d-cube/
*/
if ( ! defined( 'MXTDC_PLUGIN_URL' ) ) {

	define( 'MXTDC_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

}

/*
* Define MXTDC_PLUGN_BASE_NAME
*
* 	Return three-d-cube/three-d-cube.php
*/
if ( ! defined( 'MXTDC_PLUGN_BASE_NAME' ) ) {

	define( 'MXTDC_PLUGN_BASE_NAME', plugin_basename( __FILE__ ) );

}

/*
* Define MXTDC_TABLE_SLUG
*/
if ( ! defined( 'MXTDC_TABLE_SLUG' ) ) {

	define( 'MXTDC_TABLE_SLUG', 'mxtdc_table_slug' );

}

/*
* Define MXTDC_PLUGIN_ABS_PATH
* 
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\three-d-cube/
*/
if ( ! defined( 'MXTDC_PLUGIN_ABS_PATH' ) ) {

	define( 'MXTDC_PLUGIN_ABS_PATH', dirname( MXTDC_PLUGIN_PATH ) . '/' );

}

/*
* Define MXTDC_PLUGIN_VERSION
*/
if ( ! defined( 'MXTDC_PLUGIN_VERSION' ) ) {

	// version
	define( 'MXTDC_PLUGIN_VERSION', '1.0' ); // Must be replaced before production on for example '1.0'

}

/*
* Define MXTDC_MAIN_MENU_SLUG
*/
if ( ! defined( 'MXTDC_MAIN_MENU_SLUG' ) ) {

	// version
	define( 'MXTDC_MAIN_MENU_SLUG', 'mxtdc-three-d-cube-menu' );

}

/**
 * activation|deactivation
 */
require_once plugin_dir_path( __FILE__ ) . 'install.php';

/*
* Registration hooks
*/
// Activation
register_activation_hook( __FILE__, array( 'MXTDC_Basis_Plugin_Class', 'activate' ) );

// Deactivation
register_deactivation_hook( __FILE__, array( 'MXTDC_Basis_Plugin_Class', 'deactivate' ) );


/*
* Include the main MXTDCThreeDCube class
*/
if ( ! class_exists( 'MXTDCThreeDCube' ) ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/final-class.php';

	/*
	* Translate plugin
	*/
	add_action( 'plugins_loaded', 'mxtdc_translate' );

	function mxtdc_translate()
	{

		load_plugin_textdomain( 'mxtdc-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

}