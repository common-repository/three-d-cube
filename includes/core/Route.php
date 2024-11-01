<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// require Route-Registrar.php
require_once MXTDC_PLUGIN_ABS_PATH . 'includes/core/Route-Registrar.php';

/*
* Routes class
*/
class MXTDC_Route
{

	public function __construct()
	{
		// ...
	}
	
	public static function mxtdc_get( ...$args )
	{

		return new MXTDC_Route_Registrar( ...$args );

	}
	
}