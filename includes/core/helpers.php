<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require class for admin panel
*/
function mxtdc_require_class_file_admin( $file ) {

	require_once MXTDC_PLUGIN_ABS_PATH . 'includes/admin/classes/' . $file;

}


/*
* Require class for frontend panel
*/
function mxtdc_require_class_file_frontend( $file ) {

	require_once MXTDC_PLUGIN_ABS_PATH . 'includes/frontend/classes/' . $file;

}

/*
* Require a Model
*/
function mxtdc_use_model( $model ) {

	require_once MXTDC_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';

}