<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_Enqueue_Scripts
{

	/*
	* MXTDC_Enqueue_Scripts
	*/
	public function __construct()
	{

	}

	/*
	* Registration of styles and scripts
	*/
	public static function mxtdc_register()
	{

		// register scripts and styles
		add_action( 'admin_enqueue_scripts', array( 'MXTDC_Enqueue_Scripts', 'mxtdc_enqueue' ) );

	}

		public static function mxtdc_enqueue()
		{

			wp_enqueue_style( 'mxtdc_font_awesome', MXTDC_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( 'mxtdc_admin_style', MXTDC_PLUGIN_URL . 'includes/admin/assets/css/style.css', array( 'mxtdc_font_awesome' ), MXTDC_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( 'mxtdc_admin_script', MXTDC_PLUGIN_URL . 'includes/admin/assets/js/script.js', array( 'jquery' ), MXTDC_PLUGIN_VERSION, false );

			// localize like object
			wp_localize_script( 'mxtdc_admin_script', 'mxtdc_admin_localize', array(

				'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
				'mxtdc_admin_nonce' 		=> wp_create_nonce( 'mxtdc_admin_nonce_request' )

			) );

		}

}