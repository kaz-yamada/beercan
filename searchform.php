<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * Please browse readme.txt for credits and forking information
 *
 * @package beercan
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'beercan' ); ?></span>
			<input
				type="search"
				class="search-field"
				placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'beercan' ); ?>"
				value="<?php echo get_search_query(); ?>"
				name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'beercan' ); ?>" />
	</label>
	<button type="submit" class="search-submit dashicons dashicons-search"><span class="screen-reader-text"></span></button>
</form>
