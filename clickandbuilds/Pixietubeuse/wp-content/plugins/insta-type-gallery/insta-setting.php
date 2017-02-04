<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directlys

//load settings
$insta_setting = unserialize(base64_decode(get_post_meta( $post->ID, 'awl_itg_settings_'.$post->ID, true)));

//print_r($insta_setting);
$insta_gallery_id = $post->ID;

// CSS
wp_enqueue_style('awl-toogle-button-css', ITG_PLUGIN_URL . 'css/toogle-button.css');
wp_enqueue_style( 'itg-styles-css', ITG_PLUGIN_URL . 'css/styles.css' );
wp_enqueue_style( 'itg-bootstrap-css', ITG_PLUGIN_URL . 'css/bootstrap.css' );
wp_enqueue_style( 'itg-font-awesome-css', ITG_PLUGIN_URL . 'css/font-awesome.css' );
wp_enqueue_style( 'itg-go-to-top-css', ITG_PLUGIN_URL . 'css/go-to-top.css' );

//js
wp_enqueue_script('jquery');
wp_enqueue_script( 'itg-bootstrap-js', ITG_PLUGIN_URL  . 'js/bootstrap.js', array( 'jquery' ), '', true  );
wp_enqueue_script( 'itg-go-to-top-js', ITG_PLUGIN_URL . 'js/go-to-top.js', array( 'jquery' ), '', true  );
wp_enqueue_script( 'awl-itg-color-picker-js', plugins_url('js/itg-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
//uploader
wp_enqueue_media();
wp_enqueue_script('thickbox');
wp_enqueue_script('em-image-upload');
wp_enqueue_style('thickbox');

$col_large_desktops = $insta_setting['col_large_desktops'];
$col_desktops = $insta_setting['col_desktops'];
$col_tablets = $insta_setting['col_tablets'];
$col_phones = $insta_setting['col_phones'];
 /* echo "<pre>";
print_r($insta_setting);
echo "</pre>";  */
?>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<style>
.itg_settings {
	padding: 8px 0px 8px 8px !important;
	margin: 10px 10px 4px 0px !important;
}
.itg_settings label {
	font-size: 16px !important;
}
.be-right {
	float: right;
	text-align: right;
	text-decoration: none;
}

/*toogle-button css */
.setting-toggle-div {
	background-color: #FFFFFF;
	padding: 10px;
	margin-bottom: 15px;
	border: 2px solid #CCCCCC;
	border-radius: 3px;
}

.text-color {
	color:#0073AA !important;
}

</style>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<!--Profile Settings-->
	<div class="panel panel-default">
		<div class="panel-heading panel-heading-theme-1 icon-right" role="tab" id="heading1" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-controls="collapse1">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1"><i class="fa fa-chevron-down"></i>
				    1. Profile Settings
				</a>
			</h4>
		</div>
		<div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
			<div class="panel-body">
				<div class="itg_settings">
					<p class="bg-title"><?php _e('1. Show Profile', ITG_TXTDM); ?></p><br>
					<p class=" switch-field em_size_field"">
						<?php if(isset($insta_setting['show_pro'])) $show_pro = $insta_setting['show_pro']; else $show_pro = 0; ?>
						<input type="radio" name="show_pro" id="show_pro1" value="1" <?php if($show_pro == 1) echo "checked=checked"; ?>>
						<label for="show_pro1"><?php _e('Yes', ITG_TXTDM); ?></label>
						<input type="radio" name="show_pro" id="show_pro2" value="0" <?php if($show_pro == 0) echo "checked=checked"; ?>>
						<label for="show_pro2"><?php _e('No', ITG_TXTDM); ?></label>
					</p>
					<h4><?php //_e('Hide gap / margin / padding / spacing between gallery thumbnails', ITG_TXTDM); ?></h4>
				</div>
				<div class="profile_show">
				<div class="itg_settings" data-provides="fileinput">
					<label class="text-color"> 2.Profile Image</label><br><br>
					<?php if(isset($insta_setting['upload_image'])) $upload_image = $insta_setting['upload_image']; else $upload_image = ""; ?>
					<p><input id="upload_image_button" name="upload_image_button" class="btn btn-primary btn-file em-btn-uplode" type="button" value="Upload Image" /></p>
					<div class="thumbnail" style="width:130px; height: 130px;">
						<img id="upload_image_preview" src="<?php echo $upload_image; ?>">						
						<?php if(!$upload_image) { ?>
						<img id="upload_image_preview2" src="<?php echo ITG_PLUGIN_URL ?>/img/instagram-type-gallery-premium.png">
						<?php } ?>
					</div>
					<p><input type="button" id="remove_preview" name="remove_preview" value="Remove" class="btn btn-danger" style="display:none;"/></p>
					<!--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 120px; max-height: 80px;"></div>---
					<!--<span class="btn btn-primary btn-file em-btn-uplode">	<span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>-->
					<input id="upload_image" type="hidden" size="36" name="upload_image" value="<?php echo $upload_image; ?>" />
				</div>
			
				<div class="itg_settings">
					<label class="text-color"> 3.Profile Title</label><br><br>
					<?php if(isset($insta_setting['pro_title'])) $pro_title = $insta_setting['pro_title']; else $pro_title = "A WP Life"; ?>					
					<input type="text" id="pro_title" name="pro_title" value="<?php echo $pro_title; ?>"/>
				</div>
				
				<div class="itg_settings">
					<label class="text-color"> 4.Profile Description</label><br><br>
					<?php if(isset($insta_setting['pro_dec'])) $pro_dec = $insta_setting['pro_dec']; else $pro_dec = "A WP Life - We are a company of fourteen innovative and dynamic personality professionals. We build premium WordPress products."; ?>					
					<textarea  id="pro_dec" name="pro_dec" class="form-control" value=""><?php echo $pro_dec; ?></textarea>
				</div>
				
				<div class="itg_settings">
					<label class="text-color"> 5.Follow Button text</label><br><br>
					<?php if(isset($insta_setting['follow_btn_text'])) $follow_btn_text = $insta_setting['follow_btn_text']; else $follow_btn_text = "Follow"; ?>
					<input type="text" id="follow_btn_text" name="follow_btn_text" value="<?php echo $follow_btn_text; ?>"/>
				</div>
				
				<div class="itg_settings">
					<label class="text-color"> 6.Instragram Username</label><br><br>
					<?php if(isset($insta_setting['insta_user'])) $insta_user = $insta_setting['insta_user']; else $insta_user = "awplife"; ?>
					<input type="text" id="insta_user" name="insta_user" value="<?php echo $insta_user; ?>"/>
				</div>
			
				<div class="itg_settings">
					<label class="text-color"> 7.Number Of Post</label><br><br>					
					<?php if(isset($insta_setting['num_post'])) $num_post = $insta_setting['num_post']; else $num_post = 74 ; ?>
					<input type="number" id="num_post" name="num_post" value="<?php echo $num_post; ?>"/>
				</div>
				
				<div class="itg_settings">
					<label class="text-color"> 8.Number Of Followers</label><br><br>					
					<?php if(isset($insta_setting['num_folo'])) $num_folo = $insta_setting['num_folo']; else $num_folo = 10 ; ?>	
					<input type="number" id="num_folo" name="num_folo" value="<?php echo $num_folo; ?>"/>
				</div>
				
				<div class="itg_settings">
					<label class="text-color"> 9.Number Of Followings</label><br><br>					
					<?php if(isset($insta_setting['num_of_folo'])) $num_of_folo = $insta_setting['num_of_folo']; else $num_of_folo = 50 ; ?>	
					<input type="number" id="num_of_folo" name="num_of_folo" value="<?php echo $num_of_folo; ?>"/>
				</div>
				</div>
			</div>
		</div>
	</div>
	
<!--2 Gallery settings-->	
<div class="panel panel-default">
		<div class="panel-heading panel-heading-theme-1 icon-right" role="tab" id="heading2" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-controls="collapse2">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2"><i class="fa fa-chevron-down"></i>
				    2. Gallery Settings
				</a>
			</h4>
		</div>
<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
	<div class="panel-body">
			<div class="itg_settings">
				<p class="bg-title"><?php _e('1. Gallery Thumbnail Size', ITG_TXTDM); ?></p><br>
				<?php if(isset($insta_setting['gal_thumb_size'])) $gal_thumb_size = $insta_setting['gal_thumb_size']; else $gal_thumb_size = "thumbnail"; ?>
				<select id="gal_thumb_size" name="gal_thumb_size" class="selectpicker show-tick">
					<option value="thumbnail" <?php if($gal_thumb_size == "thumbnail") echo "selected=selected"; ?>>Thumbnail - 150  x 150</option>
					<option value="medium" <?php if($gal_thumb_size == "medium") echo "selected=selected"; ?>>Medium - 300 x 169</option>
					<option value="large" <?php if($gal_thumb_size == "large") echo "selected=selected"; ?>>Large - 840 x 473</option>
					<option value="full" <?php if($gal_thumb_size == "full") echo "selected=selected"; ?>>Full Size - 1280 x 720</option>
				</select>
				<h4><?php _e('Select gallery thumbnails size to display into gallery', ITG_TXTDM); ?></h4>
			</div>

			<!--Colums Layout Settings Start-->
				<div class="itg_settings">
					<p class="bg-title"><?php _e('2. Columns Layout Settings', ITG_TXTDM); ?></p><br>
					<p class="bg-lower-title">A .Columns On Large Desktops</p>
					<?php if(isset($insta_setting['col_large_desktops'])) $col_large_desktops = $insta_setting['col_large_desktops']; else $col_large_desktops = "col-lg-3"; ?>
					<select id="col_large_desktops" name="col_large_desktops">
						<option value="col-lg-12" <?php if($col_large_desktops == "col-lg-12") echo "selected=selected"; ?>>1 Column</option>
						<option value="col-lg-6" <?php if($col_large_desktops == "col-lg-6") echo "selected=selected"; ?>>2 Column</option>
						<option value="col-lg-4" <?php if($col_large_desktops == "col-lg-4") echo "selected=selected"; ?>>3 Column</option>
						<option value="col-lg-3" <?php if($col_large_desktops == "col-lg-3") echo "selected=selected"; ?>>4 Column</option>
						<option value="col-lg-2" <?php if($col_large_desktops == "col-lg-2") echo "selected=selected"; ?>>6 Column</option>
						<option value="col-lg-1" <?php if($col_large_desktops == "col-lg-1") echo "selected=selected"; ?>>12 Column</option>
					</select>
					<h4><?php _e('Select gallery column layout for large desktop devices', ITG_TXTDM); ?></h4><br><br>

					<p class="bg-lower-title">B. Colums On Desktops</p>
					<?php if(isset($insta_setting['col_desktops'])) $col_desktops = $insta_setting['col_desktops']; else $col_desktops = "col-md-4"; ?>
					<select id="col_desktops" name="col_desktops">
						<option value="col-md-12" <?php if($col_desktops == "col-md-12") echo "selected=selected"; ?>>1 Column</option>
						<option value="col-md-6" <?php if($col_desktops == "col-md-6") echo "selected=selected"; ?>>2 Column</option>
						<option value="col-md-4" <?php if($col_desktops == "col-md-4") echo "selected=selected"; ?>>3 Column</option>
						<option value="col-md-3" <?php if($col_desktops == "col-md-3") echo "selected=selected"; ?>>4 Column</option>
						<option value="col-md-2" <?php if($col_desktops == "col-md-2") echo "selected=selected"; ?>>6 Column</option>
						<option value="col-md-1" <?php if($col_desktops == "col-md-1") echo "selected=selected"; ?>>12 Column</option>
					</select>
					<h4><?php _e('Select gallery column layout for desktop devices', ITG_TXTDM); ?></h4><br><br>

					<p class="bg-lower-title">C. Colums On Tablets</p>
					<?php if(isset($insta_setting['col_tablets'])) $col_tablets = $insta_setting['col_tablets']; else $col_tablets = "col-sm-4"; ?>
					<select id="col_tablets" name="col_tablets">
						<option value="col-sm-12" <?php if($col_tablets == "col-sm-12") echo "selected=selected"; ?>>1 Column</option>
						<option value="col-sm-6" <?php if($col_tablets == "col-sm-6") echo "selected=selected"; ?>>2 Column</option>
						<option value="col-sm-4" <?php if($col_tablets == "col-sm-4") echo "selected=selected"; ?>>3 Column</option>
						<option value="col-sm-3" <?php if($col_tablets == "col-sm-3") echo "selected=selected"; ?>>4 Column</option>
						<option value="col-sm-2" <?php if($col_tablets == "col-sm-2") echo "selected=selected"; ?>>6 Column</option>
					</select>
					<h4><?php _e('Select gallery column layout for tablet devices', ITG_TXTDM); ?></h4><br><br>
						
					<p class="bg-lower-title">D. Colums On Phones</p>
					<?php if(isset($insta_setting['col_phones'])) $col_phones = $insta_setting['col_phones']; else $col_phones = "col-xs-6"; ?>
					<select id="col_phones" name="col_phones">
						<option value="col-xs-12" <?php if($col_phones == "col-xs-12") echo "selected=selected"; ?>>1 Column</option>
						<option value="col-xs-6" <?php if($col_phones == "col-xs-6") echo "selected=selected"; ?>>2 Column</option>
						<option value="col-xs-4" <?php if($col_phones == "col-xs-4") echo "selected=selected"; ?>>3 Column</option>
						<option value="col-xs-3" <?php if($col_phones == "col-xs-3") echo "selected=selected"; ?>>4 Column</option>
					</select>
					<h4><?php _e('Select gallery column layout for phone devices', ITG_TXTDM); ?></h4><br>
				</div>
				
			<!--Colums Layout Settings End-->

			<div class="itg_settings">
				<p class="bg-title"><?php _e('3. Light Box Style', ITG_TXTDM); ?></p></br>
				<?php if(isset($insta_setting['light_box'])) $light_box = $insta_setting['light_box']; else $light_box = 1; ?>
				<select name="light_box" id="light_box">	
					<option value="0" <?php if($light_box == 0) echo "selected=selected"; ?>>None</option>
					<option value="6" <?php if($light_box == 6) echo "selected=selected"; ?>>Bootstrap 3 Light Box</option>
				</select>
				<h4><?php _e('Select a light box style', ITG_TXTDM); ?></h4>
			</div><br>

			<!--Hover Effects Settings Start-->
			<div class="itg_settings ">	
				
				<p class="bg-title"><?php _e('4. Image Hover Effect Type', ITG_TXTDM); ?></p></br>
				<?php if(isset($insta_setting['image_hover_effect_type'])) $image_hover_effect_type = $insta_setting['image_hover_effect_type']; else $image_hover_effect_type = "2d"; ?>
				<p class="switch-field em_size_field">
					<input type="radio" name="image_hover_effect_type" id="image_hover_effect_type1" value="no" <?php if($image_hover_effect_type == "no") echo "checked=checked"; ?>>
					<label for="image_hover_effect_type1"><?php _e('None', ITG_TXTDM); ?></label>
					<input type="radio" name="image_hover_effect_type" id="image_hover_effect_type2" value="sg" <?php if($image_hover_effect_type == "sg") echo "checked=checked"; ?>>
					<label for="image_hover_effect_type2"><?php _e('2D Transitions', ITG_TXTDM); ?></label>
					<!--<input type="radio" name="image_hover_effect_type" id="image_hover_effect_type" value="cl" <?php if($image_hover_effect_type == "cl") echo "checked=checked"; ?>>&nbsp;Curls Transitions Effects<br>-->
				</p>
				<h4><?php _e('Select and Set a image hover effect type for Gallery', ITG_TXTDM); ?><h4>

				<!-- 4 -->
				<p class="he_four">
					<label><?php _e('Image Hover Effects', ITG_TXTDM); ?></label><br>
					<?php if(isset($insta_setting['image_hover_effect_four'])) $image_hover_effect_four = $insta_setting['image_hover_effect_four']; else $image_hover_effect_four = "hvr-box-shadow-outset"; ?>
					<select name="image_hover_effect_four" id="image_hover_effect_four">
						<optgroup label="Shadow and Glow Transitions Effects" class="sg">
							<option value="hvr-grow-shadow" <?php if($image_hover_effect_four == "hvr-grow-shadow") echo "selected=selected"; ?>>Grow Shadow</option>
							<option value="hvr-float-shadow" <?php if($image_hover_effect_four == "hvr-float-shadow") echo "selected=selected"; ?>>Float Shadow</option>
							<option value="hvr-glow" <?php if($image_hover_effect_four == "hvr-glow") echo "selected=selected"; ?>>Glow</option>
							<!--<option value="hvr-shadow-radial" <?php //if($image_hover_effect_four == "hvr-shadow-radial") echo "selected=selected"; ?>>Shadow Radial</option>-->
							<option value="hvr-box-shadow-outset" <?php if($image_hover_effect_four == "hvr-box-shadow-outset") echo "selected=selected"; ?>>Box Shadow Outset</option>
							<option value="hvr-box-shadow-inset" <?php if($image_hover_effect_four == "hvr-box-shadow-inset") echo "selected=selected"; ?>>Box Shadow Inset</option>
						</optgroup>
					</select><br>	
				</p>
			</div><br>
			<!--Hover Effects Settings End-->
			
			<!--Animation Effects Settings start-->
			<div class="itg_settings ">
				<p class="bg-title"><?php _e('5. Animation Eeffect', ITG_TXTDM); ?></p></br>
				<?php if(isset($insta_setting['animation_effect'])) $animation_effect = $insta_setting['animation_effect']; else $animation_effect = "none" ; ?>
				<select id="animation_effect" name="animation_effect">
					<optgroup label="animation effects" class="">
					  <option value="0" <?php if($animation_effect == 0) echo "selected=selected"; ?>>None</option>
					  <option value="bounce"<?php if($animation_effect == "bounce") echo "selected=selected"; ?>>bounce</option>
					  <option value="pulse"<?php if($animation_effect == "pulse") echo "selected=selected"; ?>>pulse</option>
					  <option value="rubberBand"<?php if($animation_effect == "rubberBand") echo "selected=selected"; ?>>rubberBand</option> 
					  <option value="wobble"<?php if($animation_effect == "wobble") echo "selected=selected"; ?>>wobble</option>
					  <option value="rotateIn"<?php if($animation_effect == "rotateIn") echo "selected=selected"; ?>>rotateIn</option>
					  
					</optgroup>
				</select>
			</div>
			<!--Animation Effects Settings End-->
			<div class="itg_settings">
				<p class="bg-title"><?php _e('6. Hide Thumbnails Spacing', ITG_TXTDM); ?></p><br>
				<p class=" switch-field em_size_field">
					<?php if(isset($insta_setting['no_spacing'])) $no_spacing = $insta_setting['no_spacing']; else $no_spacing = 0; ?>
					<input type="radio" name="no_spacing" id="no_spacing1" value="1" <?php if($no_spacing == 1) echo "checked=checked"; ?>>
					<label for="no_spacing1"><?php _e('Yes', ITG_TXTDM); ?></label>
					<input type="radio" name="no_spacing" id="no_spacing2" value="0" <?php if($no_spacing == 0) echo "checked=checked"; ?>>
					<label for="no_spacing2"><?php _e('No', ITG_TXTDM); ?></label>
				</p>
				<h4><?php _e('Hide gap / margin / padding / spacing between gallery thumbnails', ITG_TXTDM); ?></h4>
			</div>

			<div class="itg_settings">
				<p class="bg-title"><?php _e('7. Gallery Thumbnail Order', ITG_TXTDM); ?></p><br>
				<p class="switch-field em_size_field">	
					<?php if(isset($insta_setting['thumbnail_order'])) $thumbnail_order = $insta_setting['thumbnail_order']; else $thumbnail_order = "ASC"; ?>
					<input type="radio" name="thumbnail_order" id="thumbnail_order1" value="ASC" <?php if($thumbnail_order == "ASC") echo "checked=checked"; ?>>
					<label for="thumbnail_order1"><?php _e('Old First', ITG_TXTDM); ?></label>
					<input type="radio" name="thumbnail_order" id="thumbnail_order2" value="DESC" <?php if($thumbnail_order == "DESC") echo "checked=checked"; ?>>
					<label for="thumbnail_order2"><?php _e('New First', ITG_TXTDM); ?></label>
					<input type="radio" name="thumbnail_order" id="thumbnail_order3" value="RANDOM" <?php if($thumbnail_order == "RANDOM") echo "checked=checked"; ?>>
					<label for="thumbnail_order3"><?php _e('Random', ITG_TXTDM); ?></label><br><br>
					<h4><?php _e('Set a image order in which you want to display gallery thumbnails', ITG_TXTDM); ?></h4>
				</p>
			</div>

			<div class="itg_settings">
				<p class="bg-title"><?php _e('8. Custom CSS', ITG_TXTDM); ?></p></br>
				<?php if(isset($insta_setting['custom_css'])) $custom_css = $insta_setting['custom_css']; else $custom_css = ""; ?>
				<textarea name="custom_css" id="custom_css" style="width: 100%; height: 120px;" placeholder="Type direct CSS code here. Don't use <style>...</style> tag."><?php echo $custom_css; ?></textarea><br>
				<h4><?php _e('Apply own css on image gallery and dont use style tag', ITG_TXTDM); ?></h4>
			</div>	
		</div>
	</div>
</div>

<!--3 pagination Settings-->
	<div class="panel panel-default" style="display: none;">
		<div class="panel-heading panel-heading-theme-1 icon-right" role="tab" id="heading3" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-controls="collapse3">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3"><i class="fa fa-chevron-down"></i>
				    3. Pagination Settings
				</a>
			</h4>
		</div>
		<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
			<div class="panel-body">
					<div class="itg_settings">
						<p class="bg-title"><?php _e('1. Show Pagination', ITG_TXTDM); ?></p><br>
						<p class=" switch-field em_size_field"">
							<?php if(isset($insta_setting['show_pagination'])) $show_pagination = $insta_setting['show_pagination']; else $show_pagination = 0; ?>
							<input type="radio" name="show_pagination" id="show_pagination1" value="1" <?php if($show_pagination == 1) echo "checked=checked"; ?>>
							<label for="show_pagination1"><?php _e('Yes', ITG_TXTDM); ?></label>
							<input type="radio" name="show_pagination" id="show_pagination2" value="0" <?php if($show_pagination == 0) echo "checked=checked"; ?>>
							<label for="show_pagination2"><?php _e('No', ITG_TXTDM); ?></label>
						</p>
						<h4><?php //_e('Hide gap / margin / padding / spacing between gallery thumbnails', ITG_TXTDM); ?></h4>
					</div>
				<div class="pagination_show">
					<div class="itg_settings">
						<label class="text-color"> Show Per Page</label><br><br>
						<?php if(isset($insta_setting['show_query'])) $show_query = $insta_setting['show_query']; else $show_query = 10 ; ?>
						<input type="range"  id="show_query" name="show_query" min="1" max="100" step="1" value="<?php echo $show_query; ?>" onchange="updateRange(this.value, this.id);">
						<br>
						<input type="text" id="show_query_value" name="show_query_value" value="<?php echo $show_query; ?>" style="" readonly><br></br></br>		
					</div>
					
					<div class="itg_settings">
						<label class="text-color">Pagination Middle Range</label><br><br>
						<?php if(isset($insta_setting['mid_range'])) $mid_range = $insta_setting['mid_range']; else $mid_range = 1 ; ?>
						<input type="range" id="mid_range" name="mid_range" min="1" max="10" step="1" value="<?php echo $mid_range; ?>" onchange="updateRange(this.value, this.id);">
						<br>
						<input type="text" id="mid_range_value" name="mid_range_value" value="<?php echo $mid_range; ?>" style="" readonly><br></br></br>		
					</div>
					
					<div class="itg_settings">
						<label class="text-color"> Pagination Buttons Color</label></br><br>
						<?php if(isset($insta_setting['button_color'])) $button_color = $insta_setting['button_color']; else $button_color = "#CC181E"; ?>
						<input type="text" id="button_color" name="button_color"value="<?php echo $button_color; ?>">
					</div>
					
					<div class="itg_settings">
						<label class="text-color">Buttons Background Color</label></br><br>
						<?php if(isset($insta_setting['button_bg_color'])) $button_bg_color = $insta_setting['button_bg_color']; else $button_bg_color = "#23282D"; ?>
						<input type="text" id="button_bg_color" name="button_bg_color"value="<?php echo $button_bg_color; ?>">
					</div>
					
					<div class="itg_settings">
						<label class="text-color">Selected Page Color</label></br></br>
						<?php if(isset($insta_setting['sp_color'])) $sp_color = $insta_setting['sp_color']; else $sp_color = "#23282D"; ?>
						<input type="text" id="sp_color" name="sp_color"value="<?php echo $sp_color; ?>">
					</div>
					
					<div class="itg_settings">
						<label class="text-color">Select Page Background Color</label></br></br>
						<?php if(isset($insta_setting['spbg_color'])) $spbg_color = $insta_setting['spbg_color']; else $spbg_color = "#ffffff"; ?>
						<input type="text" id="spbg_color" name="spbg_color"value="<?php echo $spbg_color; ?>">
					</div>
					
					<div class="itg_settings">
						<label class="text-color">Next Button Text</label><br><br>
						<?php if(isset($insta_setting['neb_text'])) $neb_text = $insta_setting['neb_text']; else $neb_text = "Next"; ?>						
						<input type="text"  id="neb_text" name="neb_text" value="<?php echo $neb_text; ?>">
					</div>
				
					<div class="itg_settings">
						<label class="text-color">Previous button Text</label><br><br>
						<?php if(isset($insta_setting['prb_text'])) $prb_text = $insta_setting['prb_text']; else $prb_text = "Previous"; ?>						
						<input type="text" id="prb_text" name="prb_text" value="<?php echo $prb_text; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	
<input type="hidden" name="itg-settings" id="itg-settings" value="itg-save-settings">
</div>
<script>
// single image uploader
jQuery(document).ready( function( jQuery ) {

    jQuery('#upload_image_button').click(function() {

        formfield = jQuery('#upload_image').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        return false;
    });

    window.send_to_editor = function(html) {

        imgurl = jQuery(html).attr('src');
		if(!(imgurl)) {
			imgurl = jQuery('img', html).attr('src');
		}
        jQuery('#upload_image').val(imgurl);
        //jQuery('#upload_image').val(imgurl);
		jQuery("#upload_image_preview").attr("src", imgurl);
		jQuery("#upload_image_preview2").remove();
        tb_remove();
    }

});

/* //remove Button
jQuery('#remove_preview').click(function() {
	jQuery("#upload_image_preview").remove();
	jQuery("#upload_image").remove();
	jQuery("#upload_image_preview_show").show();
 }); */
  
 
 //image uploder
var effect_type = jQuery('input[name="image_hover_effect_type"]:checked').val();
//alert(effect_type);
if(effect_type == "no") {
	jQuery('.he_one').hide();
	jQuery('.he_four').hide();
}
if(effect_type == "2d") {
	jQuery('.he_one').show();
	jQuery('.he_four').hide();
}
if(effect_type == "sg") {
	jQuery('.he_one').hide();
	jQuery('.he_four').show();
}

//on change effect
jQuery(document).ready(function() {
	jQuery('input[name="image_hover_effect_type"]').change(function(){
		var effect_type = jQuery('input[name="image_hover_effect_type"]:checked').val();
		if(effect_type == "no") {
			jQuery('.he_one').hide();
			jQuery('.he_four').hide();
		}
		if(effect_type == "2d") {
			jQuery('.he_one').show();
			jQuery('.he_four').hide();		
		}
		if(effect_type == "sg") {
			jQuery('.he_one').hide();
			jQuery('.he_four').show();
		}	
	});
});

//show/hide profile
var effect_type1 = jQuery('input[name="show_pro"]:checked').val();
//alert(effect_type1);
if(effect_type1 == "0") {
	jQuery('.profile_show').hide();
}
if(effect_type1 == "1") {
	jQuery('.profile_show').show();
}


//on change effect
jQuery(document).ready(function() {
	jQuery('input[name="show_pro"]').change(function(){
		var effect_type1 = jQuery('input[name="show_pro"]:checked').val();
		if(effect_type1 == "0") {
			jQuery('.profile_show').hide();
		}
		if(effect_type1 == "1") {
			jQuery('.profile_show').show();
		}
	});
});


//pagination show/hide
var effect_type1 = jQuery('input[name="show_pagination"]:checked').val();
//alert(effect_type1);
if(effect_type1 == "0") {
	jQuery('.pagination_show').hide();
}
if(effect_type1 == "1") {
	jQuery('.pagination_show').show();
}


//on change effect
jQuery(document).ready(function() {
	jQuery('input[name="show_pagination"]').change(function(){
		var effect_type1 = jQuery('input[name="show_pagination"]:checked').val();
		if(effect_type1 == "0") {
			jQuery('.pagination_show').hide();
		}
		if(effect_type1 == "1") {
			jQuery('.pagination_show').show();
		}
	});
});



// start pulse on page load
function pulseEff() {
   jQuery('#shortcode').fadeOut(600).fadeIn(600);
};
var Interval;
Interval = setInterval(pulseEff,1500);

// stop pulse
function pulseOff() {
	clearInterval(Interval);
}
// start pulse
function pulseStart() {
	Interval = setInterval(pulseEff,1500);
}

//dropdown toggle on change effect
jQuery(document).ready(function() {
	//accordion icon
	jQuery(function() {
		function toggleSign(e) {
			jQuery(e.target)
			.prev('.panel-heading')
			.find('i')
			.toggleClass('fa fa-chevron-down fa fa-chevron-up');
		}
		jQuery('#accordion').on('hidden.bs.collapse', toggleSign);
		jQuery('#accordion').on('shown.bs.collapse', toggleSign);

		});
	});
	
		//color-picker
	(function( jQuery ) {
		jQuery(function() {
			// Add Color Picker to all inputs that have 'color-field' class
			jQuery('#button_color').wpColorPicker();
			jQuery('#button_bg_color').wpColorPicker();
			jQuery('#sp_color').wpColorPicker();
			jQuery('#spbg_color').wpColorPicker();
		});
	})( jQuery );
	jQuery(document).ajaxComplete(function() {
		jQuery('#button_color,#button_bg_color,#sp_color,#spbg_color').wpColorPicker();
	});	
	
// title size range settings.  on change range value
function updateRange(val, id) {
	jQuery("#" + id).val(val);
	jQuery("#" + id + "_value").val(val);	  
}
</script>
</script>
	<p class="text-center">
		<br>
		<a href="http://awplife.com/account/signup/instagram-type-gallery" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Buy Premium Version</a>
		<a href="http://demo.awplife.com/instagram-type-gallery-premium/" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Check Live Demo</a>
		<a href="http://demo.awplife.com/instagram-type-gallery-premium-admin-demo/" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Try Admin Demo</a>
	</p>	
	<hr>
	<style>
		.awp_bale_offer {
			background-image: url("<?php echo ITG_PLUGIN_URL ?>/img/awp-bale.jpg");
			background-repeat:no-repeat;
			padding:30px;
		}
		.awp_bale_offer h1 {
			font-size:35px;
			color:#006B9F;
		}
		.awp_bale_offer h3 {
			font-size:25px;
			color:#000000;
		}
	</style>
	<div class="row awp_bale_offer">
		<div class="">
			<h1>Plugin's Bale Offer</h1>
			<h3>Get All Premium Plugin ( Personal Licence) in just $99 </h3>
			<h3><strike>$149</strike> For $99 Only</h3>
		</div>
		<div class="">
			<a href="http://awplife.com/account/signup/all-premium-plugins" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">BUY NOW</a>
		</div>
	</div>
<hr>
<p class="">
	<h1><strong>Try Our Other Free Plugins:</strong></h1>
	<br>
	<a href="https://wordpress.org/plugins/new-grid-gallery/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Grid Gallery</a>
	<a href="https://wordpress.org/plugins/new-social-media-widget/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Social Media</a>
	<a href="https://wordpress.org/plugins/new-image-gallery/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Image Gallery</a>
	<a href="https://wordpress.org/plugins/new-photo-gallery/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Photo Gallery</a>
	<a href="https://wordpress.org/plugins/responsive-slider-gallery/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Responsive Slider Gallery</a>
	<a href="https://wordpress.org/plugins/new-contact-form-widget/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Contact Form Widget</a>
	<a href="https://wordpress.org/plugins/facebook-likebox-widget-and-shortcode/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Facebook Likebox Plugin</a>
	<a href="https://wordpress.org/plugins/slider-responsive-slideshow/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Slider Responsive Slideshow</a>
	<a href="https://wordpress.org/plugins/new-video-gallery/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Video Gallery</a><br><br>
	<a href="https://wordpress.org/plugins/new-facebook-like-share-follow-button/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Facebook Like Share Follow Button</a>
	<a href="https://wordpress.org/plugins/new-google-plus-badge/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Google Plus Badge</a>
	<a href="https://wordpress.org/plugins/media-slider/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Media Slider</a>
	<a href="https://wordpress.org/plugins/weather-effect/" target="_blank" class="button button-primary load-customize hide-if-no-customize">Weather Effect</a>
</p>
