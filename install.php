<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


class MXTDC_Basis_Plugin_Class
{

	private static $table_slug = MXTDC_TABLE_SLUG;

	public static function activate()
	{

		// set option for rewrite rules CPT
		// self::create_option_for_activation();

		// Create table
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . self::$table_slug;

		if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $table_name . "'" ) !=  $table_name ) {

			$sql = "CREATE TABLE IF NOT EXISTS `$table_name`
			(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`mx_three_d_cube` longtext NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$wpdb->charset AUTO_INCREMENT=1;";

			$wpdb->query( $sql );

			// Insert dummy data
			$three_d_cube_array = array(
				'right_side' 	=> array( 'img' => 'NULL', 'href' => '#' ),
				'left_side' 	=> array( 'img' => 'NULL', 'href' => '#' ),
				'top_side' 		=> array( 'img' => 'NULL', 'href' => '#' ),
				'bottom_side' 	=> array( 'img' => 'NULL', 'href' => '#' ),
				'front_side' 	=> array( 'img' => 'NULL', 'href' => '#' ),
				'back_side' 	=> array( 'img' => 'NULL', 'href' => '#' )
			);

			$three_d_cube_dummy = serialize( $three_d_cube_array );

			$wpdb->insert(

				$table_name,

				array(
					'mx_three_d_cube' => $three_d_cube_dummy,
				)

			);
		}

	}

	public static function deactivate()
	{

		// Rewrite rules
		flush_rewrite_rules();

	}

	/*
	* This function sets the option in the table for CPT rewrite rules
	*/
	public static function create_option_for_activation()
	{

		add_option( 'mxtdc_flush_rewrite_rules', 'go_flush_rewrite_rules' );

	}

}