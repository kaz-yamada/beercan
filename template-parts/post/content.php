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
	<div class="post-inner grid-x grid-padding-x">		 
		<?php
		if ( ! is_singular() ) {
			beercan_post_thumbnail();
		}
		?>
		<div class="entry-content cell small-10">
			<?php
			if ( ! is_single() ) :
				the_title( '<h4 class="entry-title"><a href=" ' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			endif;

			if ( 'post' === get_post_type() && ! is_single() ) :
				?>
				<div class="entry-meta">
					<?php beercan_posted_on( false ); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;

			if ( ! beercan_is_a_loop() ) {
				the_content();
			}
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beercan' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div><!--.post-inner-->
</article><!-- #post-<?php the_ID(); ?> -->
