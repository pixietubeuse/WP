<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the #content and .container div elements.
 *
 * @package WordPress
 * @subpackage Lycka
 * @since Lycka 1.0
 */
?>

		</div><!-- #content -->

	</div><!-- .container -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">

			<?php get_sidebar('footer'); ?>
			
			<div class="site-info">

				<?php do_action( 'lycka_lite_footer_copyright' ); ?>

			</div><!-- .site-info -->

		</div><!-- .container -->
		
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>