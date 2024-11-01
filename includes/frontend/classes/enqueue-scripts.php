<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_Enqueue_Scripts_Frontend
{

	/*
	* MXTDC_Enqueue_Scripts_Frontend
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
		add_action( 'wp_enqueue_scripts', array( 'MXTDC_Enqueue_Scripts_Frontend', 'mxtdc_enqueue' ) );

	}

		public static function mxtdc_enqueue()
		{

			wp_enqueue_style( 'mxtdc_font_awesome', MXTDC_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );
			
			wp_enqueue_style( 'mxtdc_style', MXTDC_PLUGIN_URL . 'includes/frontend/assets/css/style.css', array( 'mxtdc_font_awesome' ), MXTDC_PLUGIN_VERSION, 'all' );
			
			wp_enqueue_script( 'mxtdc_script', MXTDC_PLUGIN_URL . 'includes/frontend/assets/js/script.js', array( 'jquery' ), MXTDC_PLUGIN_VERSION, false );
		
		}

}