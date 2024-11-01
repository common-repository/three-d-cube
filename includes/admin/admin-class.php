<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_Admin_Main
{

	// list of model names used in the plugin
	public $models_collection = [
		'MXTDC_Main_Page_Model'
	];

	/*
	* MXTDC_Admin_Main constructor
	*/
	public function __construct()
	{

	}

	/*
	* Additional classes
	*/
	public function mxtdc_additional_classes()
	{

		// enqueue_scripts class
		mxtdc_require_class_file_admin( 'enqueue-scripts.php' );

		MXTDC_Enqueue_Scripts::mxtdc_register();

		// shortcode
		mxtdc_require_class_file_admin( 'add-shortcodes.php' );

		MXTDC_Add_shortcodes::init_mxtdc_three_d_cube();

	}

	/*
	* Models Connection
	*/
	public function mxtdc_models_collection()
	{

		// require model file
		foreach ( $this->models_collection as $model ) {
			
			mxtdc_use_model( $model );

		}		

	}

	/**
	* registration ajax actions
	*/
	public function mxtdc_registration_ajax_actions()
	{

		// ajax requests to main page
		MXTDC_Main_Page_Model::mxtdc_wp_ajax();

	}

	/*
	* Routes collection
	*/
	public function mxtdc_routes_collection()
	{

		// main menu item
		MXTDC_Route::mxtdc_get( 'MXTDC_Main_Page_Controller', 'index', '', [
			'page_title' => 'Three D Cube',
			'menu_title' => 'Three D Cube',
			'dashicons'  => MXTDC_PLUGIN_URL . '/assets/img/icon.png'
		] );

	}

}

// Initialize
$initialize_admin_class = new MXTDC_Admin_Main();

// include classes
$initialize_admin_class->mxtdc_additional_classes();

// include models
$initialize_admin_class->mxtdc_models_collection();

// ajax requests
$initialize_admin_class->mxtdc_registration_ajax_actions();

// include controllers
$initialize_admin_class->mxtdc_routes_collection();