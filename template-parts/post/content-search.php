<?php
/**
 * Template part for displaying results in search pages
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
			beercan_post_thumbnail( true, true, false );
		}
		?>
		<div class="entry-content cell small-10">
			<?php
				the_title( '<h4 class="entry-title"><a href=" ' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );


			if ( 'post' === get_post_type() && ! is_single() ) :
				?>
				<div class="entry-meta">
					<?php beercan_posted_on( false ); ?>
				</div><!-- .entry-meta -->
			<?php	endif; ?>
		</div><!-- .entry-content -->
	</div><!--.post-inner-->
</article><!-- #post-<?php the_ID(); ?> -->
