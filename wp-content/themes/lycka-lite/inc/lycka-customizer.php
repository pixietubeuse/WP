<?php
/**
 * Lycka Theme Customizer
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function lycka_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'lycka_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lycka_lite_customize_preview_js() {
	wp_enqueue_script( 'lycka_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lycka_lite_customize_preview_js' );

/**-------------------------------
 * Lycka Customizer
 --------------------------------*/
 
add_action('customize_register', 'lycka_lite_theme_customizer');

function lycka_lite_theme_customizer( $wp_customize ) {

// Add_panel (requiere WP 4.0+)
$wp_customize->add_panel ('lycka_lite_panel', array(
	'title' => __('Lycka Options', 'lycka-lite'),
	'priority' => '10'));
	
	/**-------------------------------------------------------------
	 * Blog Layout
	--------------------------------------------------------------*/
	$wp_customize->add_section( 'lycka_lite_layout_section' , array(
			'title' => __( 'Sidebar Layout', 'lycka-lite' ),
			'panel' => 'lycka_lite_panel',
			'priority' => 20,
			'description' => __('Layout Customization', 'lycka-lite'),
		));

	$wp_customize->add_setting('lycka_lite_sidebar_position', array('default' => 'right', 'sanitize_callback' => 'lycka_lite_sanitize_sidebar_position' ));
	$wp_customize->add_control('lycka_lite_sidebar_position', array(
			'label' => __('Blog Sidebar Position', 'lycka-lite'),
			'section' => 'lycka_lite_layout_section',
			'settings' => 'lycka_lite_sidebar_position',
			'type' => 'select',
			'choices' => array(
				'right' => __('left', 'lycka-lite'),
				'left' => __('right', 'lycka-lite'),
			),
		));

	/**-------------------------------------------------------------
	 * Colors
	--------------------------------------------------------------*/
	$wp_customize->add_section('lycka_lite_color_settings' , array(
			'panel' => 'lycka_lite_panel',
			'title' => __(' Color Settings', 'lycka-lite'),
			'priority'    => 70,
		));
		
	/* Header Title Color */
    $wp_customize->add_setting( 'lycka_lite_header_title_color', array('default' => '#d1ddd4', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_header_title_color', array(
		'label' => __( 'Header Title Color', 'lycka-lite' ),
		'priority' => 1,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_header_title_color',
	) ) );

	/* Header Tagline Color */
    $wp_customize->add_setting( 'lycka_lite_header_tagline_color', array('default' => '#94AE99', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_header_tagline_color', array(
		'label' => __( 'Header Tagline Color', 'lycka-lite' ),
		'priority' => 2,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_header_tagline_color',
	) ) );

	/* Post Title Link Color */
    $wp_customize->add_setting( 'lycka_lite_post_color', array('default' => '#94AE99', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_post_color', array(
		'label' => __( 'Post Title Color', 'lycka-lite' ),
		'priority' => 3,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_post_color',
	) ) );

	/* Post Title Link Hover Color */
    $wp_customize->add_setting( 'lycka_lite_post_hover_color', array('default' => '#d1ddd4', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_post_hover_color', array(
		'label' => __( 'Post Title Hover Color', 'lycka-lite' ),
		'priority' => 4,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_post_hover_color',
	) ) );
	
	/* Link Color */
    $wp_customize->add_setting( 'lycka_lite_link_color', array('default' => '#94AE99', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_link_color', array(
		'label' => __( 'Link Color', 'lycka-lite' ),
		'priority' => 5,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_link_color',
	) ) );

	/* Link Hover Color */
    $wp_customize->add_setting( 'lycka_lite_hover_color', array('default' => '#d1ddd4', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lycka_lite_hover_color', array(
		'label' => __( 'Link Hover Color', 'lycka-lite' ),
		'priority' => 6,
		'section' => 'lycka_lite_color_settings',
		'settings' => 'lycka_lite_hover_color',
	) ) );
	
	/**-------------------------------------------------------------
	 * Font Size
	--------------------------------------------------------------*/
	$wp_customize->add_section( 'lycka_lite_fonts_section' , array(
		'panel' => 'lycka_lite_panel',
		'title' => __( 'Fonts', 'lycka-lite' ),
		'priority' => 30,
		'description' => __( 'Font Customization (Just if not use "Header image")', 'lycka-lite' ),
	) );

	class lycka_Customize_Fonts_Control extends WP_Customize_Control {
	    public $type = 'text';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <input type="text" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></input>
	            </label>
	        <?php
	    }
	}
	
	/* Site Title Font Size */
	$wp_customize->add_setting( 'lycka_lite_site_title_font_size', array('default' => '', 'sanitize_callback' => 'lycka_lite_sanitize_text'));
	$wp_customize->add_control(
	    new lycka_Customize_Fonts_Control(
	        $wp_customize,
	        'lycka_lite_site_title_font_size',
	        array(
				'label' => __( 'Site Title Font Size (ex: 15px)', 'lycka-lite' ),
	            'priority' => 1,
	            'section' => 'lycka_lite_fonts_section',
	            'settings' => 'lycka_lite_site_title_font_size'
	        )
	    )
	);
	
	/* Site Title Font Size */
	$wp_customize->add_setting( 'lycka_lite_site_tagline_font_size', array('default' => '', 'sanitize_callback' => 'lycka_lite_sanitize_text'));
	$wp_customize->add_control(
	    new lycka_Customize_Fonts_Control(
	        $wp_customize,
	        'lycka_lite_site_tagline_font_size',
	        array(
				'label' => __( 'Site Tagline Font Size (ex: 12px)', 'lycka-lite' ),
	            'priority' => 2,
	            'section' => 'lycka_lite_fonts_section',
	            'settings' => 'lycka_lite_site_tagline_font_size'
	        )
	    )
	);
	
	/**-------------------------------------------------------------
	 * Upgrade
	--------------------------------------------------------------*/
	class lycka_lite_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="vt-upgrade-thumb">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/lycka-premium.png" />
        	</p>
        	<p class="vt-upgrade-title">
        		<span class="customize-control-title">
        			<?php _e('Need more features and options?', 'lycka-lite'); ?>
        		</span>
        	</p>
        	<p class="vt-upgrade-text">
        		<span class="textfield">
        			<?php _e('Check out the premium version of this theme which comes with more features, additional widgets and advanced customization options for your website.', 'lycka-lite'); ?>
        		</span>
			</p>
			<p class="vt-upgrade-button">
				<a href="http://volthemes.com/theme/lycka/?utm_source=lycka+lite&amp;utm_campaign=WordPressOrg" target="_blank" class="button button-secondary">
					<?php _e('Learn more about premium version', 'lycka-lite'); ?>
				</a>
			</p><?php
        }
    }
	
	$wp_customize->add_section('vt_upgrade', array(
		'title' => __('Upgrade to Premium', 'lycka-lite'),
		'priority' => 83,
		'panel' => 'lycka_lite_panel',
	) );
		
	$wp_customize->add_setting('vt_options[premium_version_upgrade]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'sanitize_text_field'));
	$wp_customize->add_control(
		new lycka_lite_Customize_Upgrade_Control($wp_customize, 'premium_version_upgrade', 
		array(
		'section' => 'vt_upgrade',
		'settings' => 'vt_options[premium_version_upgrade]',
		'priority' => 81,
	) ));


}
add_action('customize_register', 'lycka_lite_theme_customizer');

/*
 * Sanitize functions.
 */
function lycka_lite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize sidebar for customizer
*/
function lycka_lite_sanitize_sidebar_position( $input ) {
    $valid = array(
        'left' => 'Left',
        'right' => 'Right',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}