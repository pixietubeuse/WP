<?php

/* create theme options page */
function lycka_lite_register_theme_page(){
	add_theme_page( __('Lycka Dashboard', 'lycka-lite'), __('Lycka Dashboard', 'lycka-lite'), 'edit_theme_options', 'lycka_lite_options', 'lycka_lite_options_content'); 
}
add_action( 'admin_menu', 'lycka_lite_register_theme_page' );

/* callback used to add content to options page */
function lycka_lite_options_content(){
	// Add our CSS Styling
	wp_enqueue_style( 'lycka-lite-adminstyle', get_template_directory_uri() . '/css/style-admin.css' );
	?>

    <div id="lycka-lite-dashboard-wrap" class="wrap">
        <h2><?php _e('lycka-lite Dashboard', 'lycka-lite'); ?></h2>

        <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'dashboard'; ?>

        <h2 class="nav-tab-wrapper">
            <?php _e('Welcome To Lycka by VolThemes', 'lycka-lite'); ?>
         </h2>
        
            <div class="content-customization content">
                <h3><?php _e('Customization', 'lycka-lite'); ?></h3>
                <p><?php _e('Click the "Customize" link in your menu, or use the button below to get started customizing theme.', 'lycka-lite'); ?></p>
                <p>
                    <a class="button-primary" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Use Customizer', 'lycka-lite') ?></a>
                </p>
            </div>
	       	     
			<div class="content content-resources">
		        <h3><?php _e('Theme Demo', 'lycka-lite'); ?></h3>
		        <p><?php _e("View Official Demo - Lycka lite.", "lycka-lite"); ?></p>
		        <p>
			        <a target="_blank" class="button-primary" href="http://volthemes.com/demo/lycka-lite/"><?php _e('View Demo', 'lycka-lite'); ?></a>
		        </p>
	        </div>
			
			<div class="content content-resources">
		        <h3><?php _e('Theme Documentation', 'lycka-lite'); ?></h3>
		        <p><?php _e("Get the theme up and running in no time.", "lycka-lite"); ?></p>
		        <p>
			        <a target="_blank" class="button-primary" href="http://volthemes.com/kb/lycka-lite-documentation/"><?php _e('View Documentation', 'lycka-lite'); ?></a>
		        </p>
	        </div>
			
			<div class="content content-support">
				<h3><?php _e('Support', 'lycka-lite'); ?></h3>
				<p><?php _e("If you having any kind of trouble with this theme, Please visit support forum.", "lycka-lite"); ?></p>
				<p>
					<a target="_blank" class="button-primary" href="https://wordpress.org/support/theme/lycka-lite"><?php _e('Visit Support Forum', 'lycka-lite'); ?></a>
				</p>
			</div>
		
	        <div class="content content-resources">
		        <h3><?php _e('Rate this theme', 'lycka-lite'); ?></h3>
		        <p><?php _e('If you like this theme, we would greatly appreciate if you could', 'lycka-lite');?></p>
				<p>
					<a target="_blank" class="button-primary" href="https://wordpress.org/support/view/theme-reviews/lycka-lite?filter=5"><?php _e('Rate this theme', 'lycka-lite'); ?></a>
		        </p>
	        </div>
       
    </div>
<?php } 