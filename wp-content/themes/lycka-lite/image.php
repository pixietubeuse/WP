<?php
/**
 * The template for displaying image attachments
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header(); ?>

	<div id="primary" class="content-area image-attachment column three-fourths">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

						<div class="entry-meta">
							<span class="entry-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>

							<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>

							<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
							<?php edit_post_link( __( 'Edit', 'lycka-lite' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<?php lycka_lite_the_attached_image(); ?>
							</div><!-- .attachment -->

							<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lycka-lite' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<nav id="image-navigation" class="navigation image-navigation">
					<div class="nav-links">
					<?php previous_image_link( false, '<div class="previous-image">' . __( 'Previous Image', 'lycka-lite' ) . '</div>' ); ?>
					<?php next_image_link( false, '<div class="next-image">' . __( 'Next Image', 'lycka-lite' ) . '</div>' ); ?>
					</div><!-- .nav-links -->
				</nav><!-- #image-navigation -->

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>