<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_Main_Page_Controller extends MXTDC_Controller
{
	
	public function index()
	{

		$model_inst = new MXTDC_Main_Page_Model();

		$get_tdc_row = $model_inst->mxtdc_get_row( NULL, 'id', 1 );

		// unserialize data
		$data = maybe_unserialize( $get_tdc_row->mx_three_d_cube );

		return new MXTDC_View( 'main-page', $data );

	}


}