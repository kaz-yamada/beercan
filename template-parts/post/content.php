<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'cell fade-in' ); ?> >
	<div class="post-inner grid-container grid-y grid-padding-x">
		<?php
			if ( ! is_singular() ) {
				beercan_post_thumbnail();
			}
		?>
		<div class="entry-content cell">
			<?php
			if ( ! is_singular() ) :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php beercan_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;
			if ( beercan_is_a_loop() ) :
				the_excerpt();
			else :
				the_content();
			endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beercan' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	</div><!--.post-inner-->
</article><!-- #post-<?php the_ID(); ?> -->
