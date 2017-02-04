<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Insta Type Gallery  Shortcode
 *
 * @access    public
 * @since     3.0
 *
 * @return    Create Fontend Gallery Output
 */
add_shortcode('ITG', 'awl_insta_gallery_shortcode');
function awl_insta_gallery_shortcode($post_id) {
	
	ob_start();
	//js
	wp_enqueue_script('jquery');
	wp_enqueue_script('itg-bootstrap-js', ITG_PLUGIN_URL .'js/bootstrap.js', array('jquery'), '' , true);
	wp_enqueue_script('itg-jpages-js', ITG_PLUGIN_URL . 'js/itg-jPages.js', array('jquery'), '', true);	
	wp_enqueue_script('itg-imagesloaded-pkgd-js', ITG_PLUGIN_URL .'js/imagesloaded.pkgd.js', array('jquery'), '' , true);
	wp_enqueue_script('itg-isotope-js', ITG_PLUGIN_URL .'js/isotope.pkgd.js', array('jquery'), '', false);
	
	// awp custom bootstrap css
	wp_enqueue_style('itg-bootstrap-css', ITG_PLUGIN_URL .'css/itg-bootstrap.css');
	wp_enqueue_style( 'original-bootstrap-css', ITG_PLUGIN_URL . 'css/bootstrap.css' );
	wp_enqueue_style( 'itg-jpages-css', ITG_PLUGIN_URL . 'css/jPages.css' );
	wp_enqueue_style( 'itg-animate-css', ITG_PLUGIN_URL . 'css/animate.css' );
	wp_enqueue_style( 'itg-font-awesome-css', ITG_PLUGIN_URL . 'css/font-awesome.css' );
	$insta_setting = unserialize(base64_decode(get_post_meta( $post_id['id'], 'awl_itg_settings_'.$post_id['id'], true)));
	//print_r($insta_setting);
	$insta_gallery_id = $post_id['id'];
	
	//columns settings
	$gal_thumb_size = $insta_setting['gal_thumb_size'];
	$col_large_desktops = $insta_setting['col_large_desktops'];
	$col_desktops = $insta_setting['col_desktops'];
	$col_tablets = $insta_setting['col_tablets'];
	$col_phones = $insta_setting['col_phones'];
	
	// ligtbox style
	if(isset($insta_setting['light_box'])) $light_box = $insta_setting['light_box']; else $light_box = 0;
	
	//hover effect
	if(isset($insta_setting['image_hover_effect_type'])) $image_hover_effect_type = $insta_setting['image_hover_effect_type']; else $image_hover_effect_type = "2d";
	if($image_hover_effect_type == "no") {
		$image_hover_effect = "";
	} else {
		// hover csss
		wp_enqueue_style('itg-hover-css', ITG_PLUGIN_URL .'css/hover.css');
	}
	if($image_hover_effect_type == "sg")
		if(isset($insta_setting['image_hover_effect_four'])) $image_hover_effect = $insta_setting['image_hover_effect_four']; else $image_hover_effect = "hvr-box-shadow-outset";
	if($image_hover_effect_type == "cl")
		if(isset($insta_setting['image-hover-effect-5'])) $image_hover_effect = $insta_setting['image-hover-effect-5']; else $image_hover_effect = "hvr-curl-top-left";

	if(isset($insta_setting['no_spacing'])) $no_spacing = $insta_setting['no_spacing']; else $no_spacing = 1;
	if(isset($insta_setting['thumbnail_order'])) $thumbnail_order = $insta_setting['thumbnail_order']; else $thumbnail_order = "ASC";
	//if(isset($insta_setting['url_target'])) $url_target = $insta_setting['url_target']; else $url_target = "_new";
	if(isset($insta_setting['custom-css'])) $custom_css = $insta_setting['custom-css']; else $custom_css = "";
	if(isset($insta_setting['animation_effect'])) $animation_effect = $insta_setting['animation_effect']; else $animation_effect = "zoomInDown";
	?>
	<!-- CSS Part Start From Here-->
	<style>
	.loading {
		background: transparent url('<?php echo ITG_PLUGIN_URL.'img/loading-image.gif'; ?>') center no-repeat;
	}
	#insta_gallery_<?php echo $insta_gallery_id; ?> .thumbnail {
		width: 100% !important;
		height: auto !important;
		z-index: 999 !important;
		border-radius: 0px !important;
		background: transparent url('<?php echo ITG_PLUGIN_URL.'img/loading-image.gif'; ?>') center no-repeat;
	}
	<?php if($no_spacing) { ?>
	#insta_gallery_<?php echo $insta_gallery_id; ?> .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
		padding-right: 0px !important;
		padding-left: 0px !important;
	}
	#insta_gallery_<?php echo $insta_gallery_id; ?> .thumbnail {
		padding: 0px !important;
		margin-bottom: 0px !important;
		border: 0px !important;
	}	
	<?php } ?>
	<?php echo $custom_css; ?>
	</style>
	<?php
	
	// profile setting - 8
	$show_profile = $insta_setting['show_pro'];
	$upload_image = $insta_setting['upload_image'];
	//$remove_preview = $insta_setting['remove_preview'];
	$pro_title = $insta_setting['pro_title'];
	$pro_dec = $insta_setting['pro_dec'];
	$follow_btn_text = $insta_setting['follow_btn_text'];
	$insta_user = $insta_setting['insta_user'];
	$num_post = $insta_setting['num_post'];
	$num_folo = $insta_setting['num_folo'];
	$num_of_folo = $insta_setting['num_of_folo'];
	
	// gallery settings - 1
	$animation_effect = $insta_setting['animation_effect'];
	
	// pagination settings - 8
	$show_pagination = $insta_setting['show_pagination'];
	$show_query = $insta_setting['show_query'];
	$mid_range = $insta_setting['mid_range'];
	$button_color = $insta_setting['button_color'];
	$button_bg_color = $insta_setting['button_bg_color'];
	$sp_color = $insta_setting['sp_color'];
	$spbg_color = $insta_setting['spbg_color'];
	$neb_text = $insta_setting['neb_text'];
	$prb_text = $insta_setting['prb_text'];
	
	// load without lightbox gallery output
	if($light_box == 0) {
		require('itg-no-lightbox.php');
	}
	
	// load bootstrap 3 lightbox gallery output
	if($light_box == 6) {
		require('itg-bootstrap-lightbox.php');
	} 
	return ob_get_clean();
}
?>