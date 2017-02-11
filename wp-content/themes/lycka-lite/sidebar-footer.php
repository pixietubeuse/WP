<?php
/**
 * The Sidebar containing the Footer Widgets
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */
?>

	<div class="sidebar-footer clear">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="sidebar-2" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div id="sidebar-3" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div id="sidebar-4" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
	</div><!-- #contact-sidebar -->