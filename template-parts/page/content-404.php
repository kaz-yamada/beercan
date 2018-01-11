<?php
/**
 * Displays content for 404 Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 * @since 1.0
 * @version 1.0
 */

?>
<section class="error-404 not-found cell auto">
	<div class="grid-container grid-padding-x">
		<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'beercan' ); ?></h1>
		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'beercan' ); ?></p>

			<?php
				get_search_form();

				the_widget( 'WP_Widget_Recent_Posts' );
			?>
	</div>
</section><!-- .error-404 -->
