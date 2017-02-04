<?php
/**
 * The main template file.
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area column three-fourths">
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; /* End of the Loop */ ?>

				<nav class="pagination"><?php the_posts_pagination(); ?></nav>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>