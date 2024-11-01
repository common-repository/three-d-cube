<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_FrontEnd_Main
{

	/*
	* MXTDC_FrontEnd_Main constructor
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
		mxtdc_require_class_file_frontend( 'enqueue-scripts.php' );

		MXTDC_Enqueue_Scripts_Frontend::mxtdc_register();

	}

}

// Initialize
$initialize_admin_class = new MXTDC_FrontEnd_Main();

// include classes
$initialize_admin_class->mxtdc_additional_classes();