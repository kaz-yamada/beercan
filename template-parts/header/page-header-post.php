<?php
/**
 * Template part for displaying the page header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

?>
<header class="page-header site-branding" >
	<div class='header-posts' >
		<?php beercan_post_thumbnail( true, false ); ?>
		<?php do_action( 'beercan_header_title' ); ?>
	</div>
</header><!-- .page-header -->
