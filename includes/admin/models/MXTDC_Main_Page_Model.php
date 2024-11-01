<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Main page Model
*/
class MXTDC_Main_Page_Model extends MXTDC_Model
{

	/*
	* Observe function
	*/
	public static function mxtdc_wp_ajax()
	{


		// upload image
		add_action( 'wp_ajax_mxtdc_upload_img_for_tdc', array( 'MXTDC_Main_Page_Model', 'prepare_uploading_image' ) );

		// remove image
		add_action( 'wp_ajax_mxtdc_remove_image_from_database', array( 'MXTDC_Main_Page_Model', 'prepare_removing_image' ) );

		// add url
		add_action( 'wp_ajax_mxtdc_add_url', array( 'MXTDC_Main_Page_Model', 'prepare_add_url' ) );

	}

	/*
	* Prepare for data updates
	*/
	public static function prepare_uploading_image()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxtdc_admin_nonce_request' ) ){

			// save image path
			self::uploading_image_path( $_POST );

		}

		wp_die();

	}

		// Update data
		public static function uploading_image_path( $_post_ )
		{

			global $wpdb;

			$table_name = $wpdb->prefix . MXTDC_TABLE_SLUG;

			$model_inst = new MXTDC_Main_Page_Model();

			$get_tdc_row = $model_inst->mxtdc_get_row( NULL, 'id', 1 );

			$upload_images_array = maybe_unserialize( $get_tdc_row->mx_three_d_cube );

			// $_POST
			// type of side
			$type_of_side = $_post_['type_of_side'];

			// $_FILE
			$_file_ = $_FILES['file'];

			// upload file
			if ( ! function_exists( 'wp_handle_upload' ) ) {

				require_once( ABSPATH . 'wp-admin/includes/file.php' );

			}
		
			$overrides = array(
				'test_form' => false,
				'unique_filename_callback' => array( 'MXTDC_Main_Page_Model', 'mx_change_img_name' ) 
			);

			$movefile = wp_handle_upload( $_file_, $overrides );

			if ( $movefile && empty($movefile['error']) ) {

				$img_url = $movefile['url'];

				// update array
				foreach ( $upload_images_array as $key => $value ) {

					if( $type_of_side == $key ) {

						$esc_img_url = esc_url( $img_url );

						$upload_images_array[$key]['img'] = $esc_img_url;

					}
					
				}

				$upload_images_array = serialize( $upload_images_array );

				$wpdb->update(

					$table_name, 
					array(
						'mx_three_d_cube' => $upload_images_array,
					), 
					array( 'id' => 1 ), 
					array( 
						'%s'
					)

				);

				echo $esc_img_url;

			} else {

				var_dump( $movefile );

			}			

		}

		// change img name
		public static function mx_change_img_name( $dir, $name, $ext ) {

			$new_name = time();

			return $new_name.$ext;

		}

	/*
	* Prepare for data remove
	*/
	public static function prepare_removing_image()
	{		

		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxtdc_admin_nonce_request' ) ){

			// save image path
			self::removing_image_from_dapabase( $_POST );

		}

		wp_die();

	}

		public static function removing_image_from_dapabase( $_post_ )
		{

			global $wpdb;

			$table_name = $wpdb->prefix . MXTDC_TABLE_SLUG;

			$model_inst = new MXTDC_Main_Page_Model();

			$get_tdc_row = $model_inst->mxtdc_get_row( NULL, 'id', 1 );

			$upload_images_array = maybe_unserialize( $get_tdc_row->mx_three_d_cube );

			// $_POST
			// type of side
			$type_of_side = $_post_['type_of_side'];

			// update array
			foreach ( $upload_images_array as $key => $value ) {

				if( $type_of_side == $key ) {

					$upload_images_array[$key]['img'] = 'NULL';

				}
				
			}

			$upload_images_array = serialize( $upload_images_array );

			$wpdb->update(

				$table_name, 
				array(
					'mx_three_d_cube' => $upload_images_array,
				), 
				array( 'id' => 1 ), 
				array( 
					'%s'
				)

			);

			echo MXTDC_PLUGIN_URL . 'assets/img/tdc.jpg';

		}

	/*
	* Prepare add url
	*/
	public static function prepare_add_url()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxtdc_admin_nonce_request' ) ){

			// save image path
			self::add_url_to_database( $_POST );

		}

		wp_die();

	}

		// set dataurl 
		public static function add_url_to_database( $_post_ )
		{

			// var_dump( $_POST );

			global $wpdb;

			$table_name = $wpdb->prefix . MXTDC_TABLE_SLUG;

			$model_inst = new MXTDC_Main_Page_Model();

			$get_tdc_row = $model_inst->mxtdc_get_row( NULL, 'id', 1 );

			$upload_images_array = maybe_unserialize( $get_tdc_row->mx_three_d_cube );

			// $_POST
			// type of side
			$type_of_side = $_post_['type_of_side'];

			$url = esc_url( $_post_['url'] );

			if( $url == NULL ) return;

			// update array
			foreach ( $upload_images_array as $key => $value ) {

				if( $type_of_side == $key ) {

					$upload_images_array[$key]['href'] = $url;

				}
				
			}

			$upload_images_array = serialize( $upload_images_array );

			$wpdb->update(

				$table_name, 
				array(
					'mx_three_d_cube' => $upload_images_array,
				), 
				array( 'id' => 1 ), 
				array( 
					'%s'
				)

			);

		}
	
}