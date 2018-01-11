<?php
/**
 * The template for displaying 404 pages
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Beercan
 */

get_header(); ?>
<div id="content-inner" class="grid-container">
	<div class="grid-x grid-padding-x grid-padding-y grid-margin-x">
		<div id="primary" class="content-area cell auto">
			<main id="main" class="site-main">
				<?php get_template_part( 'template-parts/page/content-404' ); ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<aside id="secondary" class="widget-area medium-3 large-4 cell">
			<div class="grid-y grid-padding-x grid-padding-y grid-margin-y grid-margin-x">
				<div class="widget widget_categories cell">
					<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'beercan' ); ?></h2>
					<ul>
					<?php
						wp_list_categories(
							array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							)
						);
					?>
					</ul>
				</div><!-- .widget_categories -->
				<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'beercan' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget(
						'WP_Widget_Archives',
						'dropdown=1',
						array(
							'before_widget' => '<div class="cell widget %s">',
							'after_title'   => "</h2>$archive_content",
						)
					);

					the_widget( 'WP_Widget_Tag_Cloud', '', array( 'before_widget' => '<div class="cell widget %s">' ) );
				?>
			</div><!-- .grid-y -->
		</aside><!-- #secondary -->
	</div><!-- .grid-x -->
</div><!-- #content-inner -->
<?php
get_footer();
