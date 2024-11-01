<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* View class
*/
class MXTDC_View
{

	public function __construct( ...$args )
	{
		
		$this->mxtdc_render( ...$args );

	}
	
	// render HTML
	public function mxtdc_render( $file, $data = NULL )
	{

		// view content
		if( file_exists( MXTDC_PLUGIN_ABS_PATH . "includes/admin/views/{$file}.php" ) ) {

			// data from model
			$data = $data;

			require_once MXTDC_PLUGIN_ABS_PATH . "includes/admin/views/{$file}.php";

		} else { ?>

			<div class="notice notice-error is-dismissible">

			    <p>The view file "<b>includes/admin/views/<?php echo $file; ?>.php</b>" doesn't exists.</p>
			    
			</div>
		<?php }


	}
	
}