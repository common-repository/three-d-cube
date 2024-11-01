<div class="mx-main-page-text-wrap">
	
	<h1><?php echo __( 'Three D Cube settings', 'mxtdc-domain' ); ?></h1>

	<p><?php echo __( 'Recommended image size is 260x260 px.', 'mxtdc-domain' ); ?></p>

	<?php foreach( $data as $key => $value ) : ?>

		<?php

			$img_url = $value['img'] == 'NULL' ? MXTDC_PLUGIN_URL . 'assets/img/tdc.jpg' : $value['img'];

		?>

		<div class="mx-block_wrap">

			<h3><?php echo __( $key, 'mxtdc-domain' ); ?></h3>

			<div class="mx-like-preview-wrap">
				<img src="<?php echo $img_url; ?>" alt="" class="mx-like-preview" />
				<button data-type-side="<?php echo $key; ?>" class="mx-btn-remove-tdc" <?php echo $value['img'] == 'NULL' ? 'style="display: none;"' : ''; ?> title="<?php echo __( 'Remove this image', 'mxtdc-domain' ); ?>"><i class="fa fa-close"></i></button>
			</div>

			<!-- add img -->
			<form enctype="multipart/form-data" action="" method="POST" class="mxtdc_form_upload_like_img">

				<input name="bl_upload_<?php echo $key; ?>" data-type-side="<?php echo $key; ?>" class="lb_upload_img" type="file" />
				<input type="submit" value="<?php echo __( 'Upload Image', 'mxtdc-domain' ); ?>" />

			</form>

			<!-- add url -->
			<form action="" method="POST" class="mxtdc_form_upload_tdc_url">

				<input name="tdc_url_<?php echo $key; ?>" data-type-side="<?php echo $key; ?>" class="mxtdc_tdc_url_input" type="url" value="<?php echo $value['href']; ?>" />
				<input type="submit" value="<?php echo __( 'Add URL', 'mxtdc-domain' ); ?>" />

			</form>

		</div>

	<?php endforeach; ?>

	<div class="mx-block_wrap">

		<h2><?php echo __( 'Shortcode', 'mxtdc-domain' ); ?></h2>

		<p>
			<?php echo __( 'This short code can be placed on your website.', 'mxtdc-domain' ); ?>
		</p>

		<span>[mxtdc-three-d-cube box_width="100%" box_height="400px" bgc="000000"]</span>

	</div>

</div>