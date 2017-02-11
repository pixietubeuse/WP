<?php
/**
 * The template for displaying Archive pages.
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area column three-fourths">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php if (is_archive()) : ?>
				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<nav class="pagination"><?php the_posts_pagination(); ?></nav>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>