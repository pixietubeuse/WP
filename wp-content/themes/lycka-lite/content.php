<?php
/**
 * The template used for displaying content
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lycka_lite_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'lycka-lite' ), __( '1 Comment', 'lycka-lite' ), __( '% Comments', 'lycka-lite' ) ); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
	<div class="entry-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
		
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Read more', 'lycka-lite' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lycka-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				$categories_list = get_the_category_list( __( ', ', 'lycka-lite' ) );
				if ( $categories_list ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'lycka-lite' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'lycka-lite' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '- Tagged %1$s', 'lycka-lite' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'lycka-lite' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

	<div class="entry-divider"></div>
</article><!-- #post-## -->
