<?php
/**
 * C
 *
 * @package Beercan
 */

/**
 * Callback function for displaying user's comments
 *
 * @param WP_comment $comment WordPress comment object.
 * @param array      $args array of arguments.
 * @param int        $depth The depth of the new comment. Must be greater than 0 and less than the value.
 */
function beercan_comment_callback( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}?>

	<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent nested-comment' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' !== $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php } ?>
			<div class="grid-x grid-padding-x">
			<div class="avatar cell small-1">
				<?php
				if ( 0 !== $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
				?>
				</div>
				<div class="cell auto">
					<?php
						printf( '<div class="comment-author">%s</div>', get_comment_author_link() );
					if ( '0' === (string) $comment->comment_approved ) :
						?>
					<em class="comment-awaiting-moderation"><?php echo esc_html_e( 'Your comment is awaiting moderation.', 'beercan' ); ?></em><br/>
					<?php endif; ?>
					<div class="comment-meta">
						<a href="<?php echo esc_attr( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
								printf(
									esc_html( '%1$s at %2$s' ),
									esc_html( get_comment_date() ),
									esc_html( get_comment_time() )
								);
							?>
					</a>
					<?php edit_comment_link( ( '(Edit)' ) ); ?>
				</div><!-- .comment-meta -->
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
			<div class="reply">
			<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => $add_below,
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							)
						)
					);
			?>
			</div>
			</div>
		</div>
		<?php if ( 'div' !== $args['style'] ) : ?>
			</div>
			<?php
			endif;
}
