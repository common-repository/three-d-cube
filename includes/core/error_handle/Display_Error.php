<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class MXTDC_Display_Error
{

	/**
	* Error notice
	*/
	public $mxtdc_error_notice = '';

	public function __construct( $mxtdc_error_notice )
	{

		$this->mxtdc_error_notice = $mxtdc_error_notice;

	}

	public function mxtdc_show_error()
	{
		add_action( 'admin_notices', function() { ?>

			<div class="notice notice-error is-dismissible">

			    <p><?php echo $this->mxtdc_error_notice; ?></p>
			    
			</div>
		    
		<?php } );
	}

}