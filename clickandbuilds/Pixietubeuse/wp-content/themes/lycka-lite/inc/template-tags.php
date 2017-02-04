<?php
/**
 * Custom template tags for lycka-lite
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

if ( ! function_exists( 'the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function the_posts_pagination() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'lycka-lite' ); ?></h2>
		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'lycka-lite' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lycka-lite' ) ); ?></div>
		<?php endif; ?>
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'lycka-lite' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'lycka-lite' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'lycka-lite' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lycka_lite_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function lycka_lite_comment( $comment, $args, $depth ) {
	global $post;
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'lycka-lite' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'lycka-lite' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body clear<?php if ( '' == get_avatar( $comment ) ) echo ' no-avatar'; ?>">
			<?php if ( '' != get_avatar( $comment ) ) : ?>
			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->
			<?php endif; ?>

			<div class="comment-content">
				<footer class="comment-meta">
					<div>
						<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
					</div>
					<div class="comment-meta-details">
						<span class="comment-meta-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>"><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'lycka-lite' ), get_comment_date(), get_comment_time() ); ?></time></a></span>
						<?php
							if ( $comment->user_id === $post->post_author ) {
								echo '<span class="comment-bypostauthor">' . __( 'Author', 'lycka-lite' ) . '</span>';
							}
						?>
						<?php
							comment_reply_link( array_merge( $args, array(
								'add_below'  => 'div-comment',
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
								'before'     => '<span class="reply">',
								'after'      => '</span>',
							) ) );
						?>
						<?php edit_comment_link( __( 'Edit', 'lycka-lite' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</footer><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lycka-lite' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for lycka_lite_comment()

if ( ! function_exists( 'lycka_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lycka_lite_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span><span class="byline"> - %2$s</span>', 'lycka-lite' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Flush out the transients used in lycka_lite_categorized_blog.
 */
function lycka_lite_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'lycka_lite_categories' );
}
add_action( 'edit_category', 'lycka_lite_category_transient_flusher' );
add_action( 'save_post',     'lycka_lite_category_transient_flusher' );

/**
 * Footer info, copyright information
 */
if ( ! function_exists( 'lycka_lite_footer_copyright' ) ) :
function lycka_lite_footer_copyright() {
   $site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

   $wp_link = '<a href="'.esc_url("http://wordpress.org").'" target="_blank" title="' . esc_attr__( 'WordPress', 'lycka-lite' ) . '"><span>' . __( 'WordPress', 'lycka-lite' ) . '</span></a>';

   $tg_link =  '<a href="'.esc_url("http://volthemes.com/theme/lycka/").'" target="_blank" title="'.esc_attr__( 'VolThemes', 'lycka-lite' ).'"><span>'.__( 'VolThemes', 'lycka-lite') .'</span></a>';

   $default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'lycka-lite' ), date( 'Y' ), $site_link ).'<br>'.sprintf( __( 'Theme: %1$s by %2$s.', 'lycka-lite' ), 'lycka-lite', $tg_link ).' '.sprintf( __( 'Powered by %s.', 'lycka-lite' ), $wp_link );

   $lycka_lite_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
   echo $lycka_lite_footer_copyright;
}
endif;
add_action( 'lycka_lite_footer_copyright', 'lycka_lite_footer_copyright', 10 );
