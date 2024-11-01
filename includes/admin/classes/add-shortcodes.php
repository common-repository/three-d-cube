<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXTDC_Add_shortcodes
{

	/*
	* MXTDC_Add_shortcodes
	*/
	public function __construct()
	{

	}

	public static function init_mxtdc_three_d_cube()
	{

		// register scripts and styles
		add_action( 'wp_enqueue_scripts', array( 'MXTDC_Add_shortcodes', 'mxtdc_enqueue' ) );

		// mxtdc-three-d-cube
		add_shortcode( 'mxtdc-three-d-cube', array( 'MXTDC_Add_shortcodes', 'mxtdc_three_d_cube' ) );

	}

	public static function mxtdc_three_d_cube( $atts )
	{

		$width = 400;

		$height = 400;

		$atts = shortcode_atts( array(

			'box_width' 	=> '100%',
			'box_height' 	=> '400px',
			'bgc' 			=> '000000'

		), $atts );

		//
		$model_inst = new MXTDC_Main_Page_Model();

		$get_tdc_row = $model_inst->mxtdc_get_row( NULL, 'id', 1 );

		// unserialize data
		$data = maybe_unserialize( $get_tdc_row->mx_three_d_cube );

		$html = '<div id="MxtdcThreeDCube" style="width: ' . $atts['box_width'] . '; height: ' . $atts['box_height'] . ';"></div>';

		// --- script ---
		$html .= '<script>';

			$html .= 'var scene = new THREE.Scene();';

			$html .= 'scene.background = new THREE.Color( 0x' . $atts['bgc'] . ' );';

			$html .= 'var box_width = document.getElementById( "MxtdcThreeDCube" ).offsetWidth;';

			$html .= 'var box_height = document.getElementById( "MxtdcThreeDCube" ).offsetHeight;';

			$html .= 'var camera = new THREE.PerspectiveCamera( 75, box_width / box_height, 0.1, 1000 );';

			$html .= 'var renderer = new THREE.WebGLRenderer();';			

			$html .= 'document.getElementById( "MxtdcThreeDCube" ).appendChild( renderer.domElement );';

			$html .= 'renderer.setSize( box_width, box_height );';

			// resize window
			$html .= 'window.addEventListener( "resize", function() {';
				$html .= 'var width = box_width;';
				$html .= 'var height = box_height;';
				$html .= 'renderer.setSize( width, height );';
				$html .= 'camera.aspect = width / height;';
				$html .= 'camera.updateProjectionMatrix();';
			$html .= '} );';

			// controls
			$html .= 'var controls = new THREE.OrbitControls( camera, renderer.domElement );';

			// geometry
			$html .= 'var geometry = new THREE.BoxGeometry( 2, 2, 2 );';
	 
			// img
			$html .= 'var cubeMaterials = ';
			$html .= '[';

				foreach( $data as $key => $value ) :

					$img_url = $value['img'] == 'NULL' ? MXTDC_PLUGIN_URL . 'assets/img/tdc.jpg' : $value['img'];

					$html .= 'new THREE.MeshBasicMaterial( { map: new THREE.TextureLoader().load( "' . $img_url . '" ), side: THREE.DoubleSide } )';

					// coma
					$html .= $key == 'back_side' ? '' : ',';


				endforeach;

			$html .= '];';

			$html .= 'var material = new THREE.MeshFaceMaterial( cubeMaterials );';

			$html .= 'var cube = new THREE.Mesh( geometry, material );';

			$html .= 'scene.add( cube );';

			// dblclick event ...

			$html .= 'var raycaster = new THREE.Raycaster();';

			$html .= 'var mxtdc_window_location = function( _href ) {';

				$html .= 'if( _href !== "#" ) {';

					$html .= 'window.location.href = _href;';

				$html .= '}';

			$html .= '};';

			$html .= 'window.addEventListener( "dblclick", function( event ) {';

			   $html .= 'var vector = new THREE.Vector3(';

			      $html .= '( event.clientX / window.innerWidth ) * 2 - 1,';

			      $html .= '- ( event.clientY / window.innerHeight ) * 2 + 1, 0.5 );';

			   $html .= 'vector.unproject( camera );';

			   $html .= 'raycaster.set( camera.position, vector.sub( camera.position ).normalize() );';

			   $html .= 'var intersects = raycaster.intersectObject( cube );';

			   $html .= 'if ( intersects.length > 0 ) {';

			    	$html .= 'var index = Math.floor( intersects[0].faceIndex / 2 );';

			    	$case_key = 0;

			    	$html .= 'switch (index) {';

			    		foreach( $data as $key => $value ) :

			    			$html .= 'case ' . $case_key . ': mxtdc_window_location("' . $value['href'] . '"); break;';

			    			$case_key++;

			    		endforeach;

			    	$html .= '}';

				$html .= '}';

			$html .= '} );';

			// ... dblclick event

			$html .= 'camera.position.z = 3;';

			// --- game logic ---
			$html .= 'var update = function() {';

				$html .= 'cube.rotation.x += 0.001;';

				$html .= 'cube.rotation.y += 0.003;';

			$html .= '};';

			// draw Scene
			$html .= 'var render = function() {';

				$html .= 'renderer.render( scene, camera );';

			$html .= '};';

			// run game loop (update, render, repeat)
			$html .= 'var GameLoop = function() {';

				$html .= 'requestAnimationFrame( GameLoop );';

				$html .= 'update();';

				$html .= 'render();';

			$html .= '};';

			$html .= 'GameLoop();';
			
		$html .= '</script>';

		return $html;

	}

	// enqueue
	public static function mxtdc_enqueue()
	{

		wp_enqueue_script( 'mxtdc_three', MXTDC_PLUGIN_URL . 'includes/admin/assets/js/three.min.js', array(), MXTDC_PLUGIN_VERSION, false );

		wp_enqueue_script( 'mxtdc_orbitcontrols', MXTDC_PLUGIN_URL . 'includes/admin/assets/js/OrbitControls.js', array( 'mxtdc_three' ), MXTDC_PLUGIN_VERSION, false );

		// wp_enqueue_script( 'mxtdc_eventdispatcher', MXTDC_PLUGIN_URL . 'includes/admin/assets/js/EventDispatcher.js', array( 'mxtdc_orbitcontrols' ), MXTDC_PLUGIN_VERSION, false );
		
	}

}