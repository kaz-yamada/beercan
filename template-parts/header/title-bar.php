<?php
/**
 * Template part for displaying the page title bar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

?>
<header class='page-header page-title-bar'>
	<div class='title-bar-content'>
		<?php
		beercan_get_post_title( '<h1 class="page-title">', '</h1>' );
		echo '<h2 class="page-subtitle">' . esc_html( beercan_post_subtitle() ) . '</h2>';

		if ( is_singular() && has_post_thumbnail() ) :
			beercan_post_thumbnail();
		endif;
		?>
	</div><!--.title-bar-content -->
</header><!-- .page-header -->
