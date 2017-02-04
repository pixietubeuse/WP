<?php
/**
 * @package lycka_lite
 */
add_action ('wp_head', 'lycka_lite_customizer_css');
function lycka_lite_customizer_css() {
	
/****************************************
* Styling
****************************************/
$site_title_font_size = esc_html(get_theme_mod('lycka_lite_site_title_font_size')); // Site Title Font Size
$header_title_color = esc_html(get_theme_mod('lycka_lite_header_title_color')); // Site Title Font Color
$site_description = esc_html(get_theme_mod('lycka_lite_header_tagline_color')); // Site Tagline color
$site_tagline_font_size = esc_html(get_theme_mod('lycka_lite_site_tagline_font_size')); // Site Title Font Size
$post_font_color = esc_html(get_theme_mod('lycka_lite_post_color')); // Post Font Color
$post_hover_color = esc_html(get_theme_mod('lycka_lite_post_hover_color')); // Post Font Color
$link_color = esc_html(get_theme_mod('lycka_lite_link_color')); // link color
$link_hover_color = esc_html(get_theme_mod('lycka_lite_hover_color')); // hover or active link color
$sidebar_position = esc_html(get_theme_mod('lycka_lite_sidebar_position')); // Sidebar
	
?>

<style id="lycka-lite-style-settings">
	<?php if ( get_theme_mod('lycka_lite_site_title_font_size') ) : ?>
		.site-title {
			font-size: <?php echo $site_title_font_size; ?>;
		}
	<?php endif; ?>
	
	<?php if ( get_theme_mod('lycka_lite_site_tagline_font_size') ) : ?>
		.site-description {
			font-size: <?php echo $site_tagline_font_size; ?>;
		}
	<?php endif; ?>
	
	<?php if ( get_theme_mod('lycka_lite_header_title_color') ) : ?>
		.site-title a {
			color: <?php echo $header_title_color; ?> !important;
		}
	<?php endif; ?>
	
	<?php if ( get_theme_mod('lycka_lite_header_tagline_color') ) : ?>
		.site-description {
			color: <?php echo $site_description; ?>;
		}
	<?php endif; ?>

	<?php if ( get_theme_mod('lycka_lite_link_color') ) : ?>
		a,
		a:visited {
			color: <?php echo $link_color; ?>;
		}
	<?php endif; ?>
			
	<?php if ( get_theme_mod('lycka_lite_hover_color') ) : ?>
		a:hover,
		a:focus,
		a:active {
			color: <?php echo $link_hover_color; ?> !important;
		}
	<?php endif; ?>

	<?php if ( get_theme_mod('lycka_lite_post_color') ) : ?>
		.entry-title,
		.entry-title a {
			color: <?php echo $post_font_color; ?> !important;
		}
	<?php endif; ?>

	<?php if ( get_theme_mod('lycka_lite_post_hover_color') ) : ?>
		.entry-title a:hover {
			color: <?php echo $post_hover_color; ?> !important;
		}
	<?php endif; ?>

	<?php if ( get_theme_mod('lycka_lite_sidebar_position') ) : ?>
		@media (min-width: 1024px) {
			.blog .column,
			.single .column {
				float: <?php echo $sidebar_position; ?>;
			}
		}
	<?php endif; ?>
	
</style>
	
<?php
}