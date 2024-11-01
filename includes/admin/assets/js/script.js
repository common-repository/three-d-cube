jQuery( document ).ready( function( $ ){

	// add images
	$( '.mxtdc_form_upload_like_img' ).on( 'submit', function( e ){

		e.preventDefault();

		if( $( this ).find( '.lb_upload_img' ).val() !== '' ) {

			var files = $( this ).find( '.lb_upload_img' ).prop('files')[0]['name'];

			var type_of_side = $( this ).find( '.lb_upload_img' ).attr( 'data-type-side' );


			var data = new FormData();

			data.append( 'action', 'mxtdc_upload_img_for_tdc' );

			data.append( 'nonce', mxtdc_admin_localize.mxtdc_admin_nonce );

			data.append( 'mxtdc_upload_img', files );

			data.append( 'type_of_side', type_of_side );

			data.append( 'file', $( this ).find( '.lb_upload_img' ).prop('files')[0] );

			mxtdc_upload_new_image( data, $( this ) );

		}	

	} );

	// remove image that was uploaded
	$( '.mx-btn-remove-tdc' ).on( 'click', function() {

		var type_of_side = $( this ).attr( 'data-type-side' );

		// data
		var data = {

			'action'		: 'mxtdc_remove_image_from_database',
			'nonce'			: mxtdc_admin_localize.mxtdc_admin_nonce,
			'type_of_side' 	: type_of_side

		};

		mxtdc_remove_image( data, $( this ) );

	} );

	// add url
	$( '.mxtdc_form_upload_tdc_url' ).on( 'submit', function( e ) {

		e.preventDefault();		

		var type_of_side = $( this ).find( '.mxtdc_tdc_url_input' ).attr( 'data-type-side' );

		if( !$( this ).find( '.mxtdc_tdc_url_input' ).val().length ) {

			$( this ).find( '.mxtdc_tdc_url_input' ).css( 'border-color', 'red' );

			return false;

		} else {

			$( this ).find( '.mxtdc_tdc_url_input' ).css( 'border-color', 'green' );

		}

		var url = $( this ).find( '.mxtdc_tdc_url_input' ).val();

		// data
		var data = {

			'action'		: 'mxtdc_add_url',
			'nonce'			: mxtdc_admin_localize.mxtdc_admin_nonce,
			'url' 			: url,
			'type_of_side' 	: type_of_side

		};		

		mxtdc_add_url( data );

	} );

} );

// upload new image
function mxtdc_upload_new_image( data, form ) {

	jQuery.ajax( {

        type: 'POST',
        url: mxtdc_admin_localize.ajaxurl,
        data: data,
        contentType: false,
        processData: false,
        success: function( response ) {

            if( typeof response === 'string' ) {

            	mxtdc_success_uploading_img( form, response );

            }

        }

    } );

}

// success uploading of img
function mxtdc_success_uploading_img( form, response ) {

	form.find( '.lb_upload_img' ).val( '' );

	form.parent().find( '.mx-like-preview' ).attr( 'src', response );

	form.parent().find( '.mx-btn-remove-tdc' ).removeAttr( 'style' );

}

// remove image
function mxtdc_remove_image( data, form ) {

	jQuery.post( mxtdc_admin_localize.ajaxurl, data, function( response ) {

		if( typeof response === 'string' ) {

			mxtdc_success_removing_img( form, response );

		}

	} );

}

// success removing img
function mxtdc_success_removing_img( form, default_image ) {

	form.parent().find( '.mx-like-preview' ).attr( 'src', default_image );

	form.hide();

}

// add url
function mxtdc_add_url( data, form ) {

	jQuery.post( mxtdc_admin_localize.ajaxurl, data, function( response ) {

	} );

}