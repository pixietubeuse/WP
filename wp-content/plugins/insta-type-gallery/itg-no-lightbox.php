<?php
/**
 * No Light Box Only Gallery
 */
$allslides = array(  'p' => $insta_gallery_id, 'post_type' => 'Insta_gallery', 'orderby' => 'ASC');
$loop = new WP_Query( $allslides );
while ( $loop->have_posts() ) : $loop->the_post();

	$post_id = get_the_ID();
	$insta_setting = unserialize(base64_decode(get_post_meta( $post_id, 'awl_itg_settings_'.$post_id, true)));
	count($insta_setting['slide-ids']);
	
	// start the image gallery contents
	?>
	<style>
	.loading {
		background: transparent url('<?php echo ITG_PLUGIN_URL.'img/loading-image.gif'; ?>') center no-repeat;
	}
	.img-circle {
		width: 150px !important;
		height: 150px !important;
		margin-left: 4% !important;
		margin-top: 2% !important;
		border-radius: 50% !important
	}
	
	.thumbnail-border{
		border:none !important;
	}
	<?php if($show_pagination) { ?>
	//pagination
	.holder-<?php echo $insta_gallery_id; ?> {
		margin: 15px 0;
	}

	.holder-<?php echo $insta_gallery_id; ?> a {
		font-size: 18px;
		font-weight: bolder;
		cursor: pointer;
		margin: 0 5px;
		padding: 10px !important;
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> a:hover {
		color: #FFF !important;
		background-color: #000 !important;
		padding: 10px !important;
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> a.jp-previous { 
		margin-right: 15px;
		color: <?php echo $button_color; ?> !important;
		background-color: <?php echo $button_bg_color; ?> !important;
		padding: 10px !important;
		text-decoration: none !important;
	}
	.holder-<?php echo $insta_gallery_id; ?> a.jp-next { 
		margin-left: 15px; 
		color: <?php echo $button_color; ?> !important;
		background-color: <?php echo $button_bg_color; ?> !important;
		padding: 10px !important;
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> a.jp-current, a.jp-current:hover {
		font-weight: bold;
		color: <?php echo $sp_color; ?>;
		background-color: <?php echo $spbg_color; ?>;
		padding: 10px !important;
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> a.jp-disabled, a.jp-disabled:hover {
		color: <?php echo $button_color; ?>;
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> a.jp-current, a.jp-current:hover,
	.holder-<?php echo $insta_gallery_id; ?> a.jp-disabled, a.jp-disabled:hover {
		cursor: default;
		/* background: none; */
		text-decoration: none !important;
	}

	.holder-<?php echo $insta_gallery_id; ?> span { 
		font-size: 18px;
		font-weight: bolder;
		margin: 0 5px; 
	}
	<?php } ?>
	#insta_gallery_<?php echo $insta_gallery_id; ?> {
		margin-top: 20px;
	}
	
	</style>
	
	<!-- insta Profile --->
	<?php if($show_profile) { ?>
	<div class="row">
		<div class="col-md-3 col-sm-3 itg-spacing">
			<img src="<?php echo $upload_image; ?>" class="img-circle">
		</div>
		<div class="col-md-9 col-sm-9 itg-spacing">
			<div class="col-md-6 col-sm-6 itg-spacing"><h1><?php echo $pro_title; ?></div></h1>
			<div class="col-md-6 col-sm-6 itg-spacing"><a href="https://www.instagram.com/<?php echo $insta_user; ?>/" target="_blank" class="btn btn-info"><?php echo $follow_btn_text; ?></a></div><br><br><br>
			
			<div class="col-md-12 col-sm-12 itg-spacing">
				<p class="text-justify"><?php echo $pro_dec; ?></p>
			</div>
			
			<div class="col-md-4 col-sm-4 itg-spacing">
				<strong><a href=""><?php echo $num_post; ?></a></strong>
				<label>Posts</label>
			</div>
			
			<div class="col-md-4 col-sm-4 itg-spacing">
				<strong><a href=""><?php echo $num_folo; ?></a></strong>
				<label>Followers</label>
			</div>
			
			<div class="col-md-4 col-sm-4 itg-spacing">
				<strong><a href=""><?php echo $num_of_folo; ?></a></strong>
				<label>Following</label>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<!-- insta Gallery --->
	<div id="insta_gallery_<?php echo $insta_gallery_id; ?>" class="row all-images">
		<?php 
		if(isset($insta_setting['slide-ids']) && count($insta_setting['slide-ids']) > 0) {
			$count = 0;
			if($thumbnail_order == "DESC") {
				$insta_setting['slide-ids'] = array_reverse($insta_setting['slide-ids']);
			}
			if($thumbnail_order == "RANDOM") {
				shuffle($insta_setting['slide-ids']);
			}			
			
			foreach($insta_setting['slide-ids'] as $attachment_id) {
				$image_link_url =  $insta_setting['slide-link'][$count];
				$thumb = wp_get_attachment_image_src($attachment_id, 'thumb', true);
				$thumbnail = wp_get_attachment_image_src($attachment_id, 'thumbnail', true);
				$medium = wp_get_attachment_image_src($attachment_id, 'medium', true);
				$large = wp_get_attachment_image_src($attachment_id, 'large', true);
				$full = wp_get_attachment_image_src($attachment_id, 'full', true);
				$postthumbnail = wp_get_attachment_image_src($attachment_id, 'post-thumbnail', true);
				$attachment_details = get_post( $attachment_id );
				$href = get_permalink( $attachment_details->ID );
				$src = $attachment_details->guid;
				$title = $attachment_details->post_title;
				if(isset($slidetext) == 'true') {
					if($slidetextopt == 'title') $text = $title;
				} else {
					$text = $title;
				}
				
				//set thumbnail size
				if($gal_thumb_size == "thumbnail") { $thumbnail_url = $thumbnail[0]; }
				if($gal_thumb_size == "medium") { $thumbnail_url = $medium[0]; }
				if($gal_thumb_size == "large") { $thumbnail_url = $large[0]; }
				if($gal_thumb_size == "full") { $thumbnail_url = $full[0]; }
					?>
					<div class="single-image <?php echo $col_large_desktops; ?> <?php echo $col_desktops; ?> <?php echo $col_tablets; ?> <?php echo $col_phones; ?>">
						<?php if($image_link_url) { ?>
						<a href="<?php echo $image_link_url; ?>" target="<?php echo $url_target; ?>" title="<?php echo $title; ?>">
							<img class="thumbnail loading <?php echo $image_hover_effect; ?>" src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>">
						</a>
						<?php } else { ?>
						<img class="thumbnail loading thumbnail-border animated <?php echo $animation_effect; ?> holder-<?php echo $insta_gallery_id; ?> <?php echo $image_hover_effect; ?>" src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>">
						<?php } ?>
					</div>
					<?php
				$count++;
			 ": [ITG id=$post_id]";
			}// end of attachment foreach
		} else {
			_e('Sorry! No image gallery found.', ITG_TXTDM);
		} // end of if esle of slides avaialble check into slider
		?>
	</div>
	<!-- navigation holder -->
	<div class='holder-<?php echo $insta_gallery_id; ?> text-center'></div>
<?php
endwhile;
wp_reset_query();
?>
<script>
jQuery(document).ready(function () {
	// isotope effect function
	 // Method 1 - Initialize Isotope, then trigger layout after each image loads.
	/* var $grid = jQuery('.all-images').isotope({
		// options...
		itemSelector: '.single-image',
	});
	// layout Isotope after each image loads
	$grid.imagesLoaded().progress( function() {
		$grid.isotope('layout');
	});  */
	
	/* 
	//Method 2 - initialize Isotope after all images have been loaded
	var $grid = jQuery('.all-images').imagesLoaded( function() {
		// init Isotope after all images have loaded
		$grid.isotope({
			// options...
			itemSelector: '.single-image',
		});
	});*/


	/* pagination */
	<?php if($show_pagination) { ?>
	jQuery(".holder-<?php echo $insta_gallery_id; ?>").jPages({
		containerID  : "insta_gallery_<?php echo $insta_gallery_id; ?>",
		perPage      : <?php echo $show_query; ?>,			// per page images
		startPage    : 2,										// start page of gallery
		startRange   : 1,	
		midRange     : <?php echo $mid_range; ?>,
		endRange     : <?php echo $mid_range; ?>,
		keyBrowse	: true,
		animation 	: '<?php echo $animation_effect; ?>',
		minHeight 	: false,
	});
	<?php } ?>
});

</script>