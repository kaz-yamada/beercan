<?php
/**
 * Functions for the portfolio custom post type.
 * Based off the jetpack portfolio post type.
 *
 * @package Beercan
 */

/**
 * Class to handle portfolio custom post type.
 */
class Beercan_Portfolio {
	const CUSTOM_POST_TYPE       = 'beercan-portfolio';
	const CUSTOM_TAXONOMY_TYPE   = 'beercan-portfolio-type';
	const CUSTOM_TAXONOMY_TAG    = 'beercan-portfolio-tag';
	const OPTION_NAME            = 'beercan_portfolio';
	const OPTION_READING_SETTING = 'beercan_portfolio_posts_per_page';

	/**
	 * Initialise class.
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new Beercan_Portfolio();
		}

		return $instance;
	}


	/**
	 * Conditionally hook into WordPress.
	 *
	 * Setup user option for enabling CPT
	 * If user has CPT enabled, show in admin
	 */
	public function __construct() {
		$this->register_custom_post();

		// Register beercan_portfolio & portfolio shortcode.
		add_shortcode( 'portfolio', array( $this, 'portfolio_shortcode' ) );
		add_shortcode( 'beercan_portfolio', array( $this, 'portfolio_shortcode' ) );
	}

	/**
	 * Register custom post type.
	 */
	private function register_custom_post() {
		if ( post_type_exists( self::CUSTOM_POST_TYPE ) ) {
			return;
		}

		// Register Post Type.
		register_post_type(
			 self::CUSTOM_POST_TYPE, array(
				 'description' => __( 'Portfolio Items', 'beercan' ),
				 'labels' => array(
					 'name'                  => esc_html__( 'Projects', 'beercan' ),
					 'singular_name'         => esc_html__( 'Project', 'beercan' ),
					 'menu_name'             => esc_html__( 'Portfolio', 'beercan' ),
					 'all_items'             => esc_html__( 'All Projects', 'beercan' ),
					 'add_new'               => esc_html__( 'Add New', 'beercan' ),
					 'add_new_item'          => esc_html__( 'Add New Project', 'beercan' ),
					 'edit_item'             => esc_html__( 'Edit Project', 'beercan' ),
					 'new_item'              => esc_html__( 'New Project', 'beercan' ),
					 'view_item'             => esc_html__( 'View Project', 'beercan' ),
					 'search_items'          => esc_html__( 'Search Projects', 'beercan' ),
					 'not_found'             => esc_html__( 'No Projects found', 'beercan' ),
					 'not_found_in_trash'    => esc_html__( 'No Projects found in Trash', 'beercan' ),
					 'filter_items_list'     => esc_html__( 'Filter projects list', 'beercan' ),
					 'items_list_navigation' => esc_html__( 'Project list navigation', 'beercan' ),
					 'items_list'            => esc_html__( 'Projects list', 'beercan' ),
				 ),
				 'supports' => array(
					 'title',
					 'editor',
					 'thumbnail',
					 'author',
					 'comments',
					 'publicize',
					 'wpcom-markdown',
					 'revisions',
				 ),
				 'rewrite' => array(
					 'slug'       => 'portfolio',
					 'with_front' => false,
					 'feeds'      => true,
					 'pages'      => true,
				 ),
				 'public'          => true,
				 'show_ui'         => true,
				 'menu_position'   => 20,                    // below Pages
				 'menu_icon'       => 'dashicons-portfolio', // 3.8+ dashicon option.
				 'capability_type' => 'page',
				 'map_meta_cap'    => true,
				 'taxonomies'      => array( self::CUSTOM_TAXONOMY_TYPE, self::CUSTOM_TAXONOMY_TAG ),
				 'has_archive'     => true,
				 'query_var'       => 'portfolio',
				 'show_in_rest'    => true,
			 )
			);

		// Register portfolio types.
		register_taxonomy(
			 self::CUSTOM_TAXONOMY_TYPE, self::CUSTOM_POST_TYPE, array(
				 'hierarchical'      => true,
				 'labels'            => array(
					 'name'                  => esc_html__( 'Project Types', 'beercan' ),
					 'singular_name'         => esc_html__( 'Project Type', 'beercan' ),
					 'menu_name'             => esc_html__( 'Project Types', 'beercan' ),
					 'all_items'             => esc_html__( 'All Project Types', 'beercan' ),
					 'edit_item'             => esc_html__( 'Edit Project Type', 'beercan' ),
					 'view_item'             => esc_html__( 'View Project Type', 'beercan' ),
					 'update_item'           => esc_html__( 'Update Project Type', 'beercan' ),
					 'add_new_item'          => esc_html__( 'Add New Project Type', 'beercan' ),
					 'new_item_name'         => esc_html__( 'New Project Type Name', 'beercan' ),
					 'parent_item'           => esc_html__( 'Parent Project Type', 'beercan' ),
					 'parent_item_colon'     => esc_html__( 'Parent Project Type:', 'beercan' ),
					 'search_items'          => esc_html__( 'Search Project Types', 'beercan' ),
					 'items_list_navigation' => esc_html__( 'Project type list navigation', 'beercan' ),
					 'items_list'            => esc_html__( 'Project type list', 'beercan' ),
				 ),
				 'public'            => true,
				 'show_ui'           => true,
				 'show_in_nav_menus' => true,
				 'show_in_rest'      => true,
				 'show_admin_column' => true,
				 'query_var'         => true,
				 'rewrite'           => array( 'slug' => 'project-type' ),
			 )
			);

		// Register post tag.
		register_taxonomy(
			 self::CUSTOM_TAXONOMY_TAG, self::CUSTOM_POST_TYPE, array(
				 'hierarchical'      => false,
				 'labels'            => array(
					 'name'                       => esc_html__( 'Project Tags', 'beercan' ),
					 'singular_name'              => esc_html__( 'Project Tag', 'beercan' ),
					 'menu_name'                  => esc_html__( 'Project Tags', 'beercan' ),
					 'all_items'                  => esc_html__( 'All Project Tags', 'beercan' ),
					 'edit_item'                  => esc_html__( 'Edit Project Tag', 'beercan' ),
					 'view_item'                  => esc_html__( 'View Project Tag', 'beercan' ),
					 'update_item'                => esc_html__( 'Update Project Tag', 'beercan' ),
					 'add_new_item'               => esc_html__( 'Add New Project Tag', 'beercan' ),
					 'new_item_name'              => esc_html__( 'New Project Tag Name', 'beercan' ),
					 'search_items'               => esc_html__( 'Search Project Tags', 'beercan' ),
					 'popular_items'              => esc_html__( 'Popular Project Tags', 'beercan' ),
					 'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'beercan' ),
					 'add_or_remove_items'        => esc_html__( 'Add or remove tags', 'beercan' ),
					 'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', 'beercan' ),
					 'not_found'                  => esc_html__( 'No tags found.', 'beercan' ),
					 'items_list_navigation'      => esc_html__( 'Project tag list navigation', 'beercan' ),
					 'items_list'                 => esc_html__( 'Project tag list', 'beercan' ),
				 ),
				 'public'            => true,
				 'show_ui'           => true,
				 'show_in_nav_menus' => true,
				 'show_in_rest'      => true,
				 'show_admin_column' => true,
				 'query_var'         => true,
				 'rewrite'           => array( 'slug' => 'project-tag' ),
			 )
		);
	}

	/**
	 * Our [portfolio] shortcode.
	 *
	 * @param array $atts shortcode attributes.
	 * @return portfolio_shortcode_html
	 */
	private static function portfolio_shortcode( $atts ) {
		// Default attributes.
		$atts = shortcode_atts(
			 array(
				 'display_types'   => true,
				 'display_tags'    => true,
				 'display_content' => true,
				 'display_author'  => false,
				 'show_filter'     => false,
				 'include_type'    => false,
				 'include_tag'     => false,
				 'columns'         => 2,
				 'showposts'       => -1,
				 'order'           => 'asc',
				 'orderby'         => 'date',
			 ), $atts, 'portfolio'
			);

		// A little sanitization.
		if ( $atts['display_types'] && 'true' != $atts['display_types'] ) {
			$atts['display_types'] = false;
		}

		if ( $atts['display_tags'] && 'true' != $atts['display_tags'] ) {
			$atts['display_tags'] = false;
		}

		if ( $atts['display_author'] && 'true' != $atts['display_author'] ) {
			$atts['display_author'] = false;
		}

		if ( $atts['display_content'] && 'true' != $atts['display_content'] && 'full' != $atts['display_content'] ) {
			$atts['display_content'] = false;
		}

		if ( $atts['include_type'] ) {
			$atts['include_type'] = explode( ',', str_replace( ' ', '', $atts['include_type'] ) );
		}

		if ( $atts['include_tag'] ) {
			$atts['include_tag'] = explode( ',', str_replace( ' ', '', $atts['include_tag'] ) );
		}

		$atts['columns'] = absint( $atts['columns'] );

		$atts['showposts'] = intval( $atts['showposts'] );

		if ( $atts['order'] ) {
			$atts['order'] = urldecode( $atts['order'] );
			$atts['order'] = strtoupper( $atts['order'] );
			if ( 'DESC' != $atts['order'] ) {
				$atts['order'] = 'ASC';
			}
		}

		if ( $atts['orderby'] ) {
			$atts['orderby'] = urldecode( $atts['orderby'] );
			$atts['orderby'] = strtolower( $atts['orderby'] );
			$allowed_keys = array( 'author', 'date', 'title', 'rand' );

			$parsed = array();
			foreach ( explode( ',', $atts['orderby'] ) as $portfolio_index_number => $orderby ) {
				if ( ! in_array( $orderby, $allowed_keys ) ) {
					continue;
				}
				$parsed[] = $orderby;
			}

			if ( empty( $parsed ) ) {
				unset( $atts['orderby'] );
			} else {
				$atts['orderby'] = implode( ' ', $parsed );
			}
		}

		return self::portfolio_shortcode_html( $atts );
	}


	/**
	 * Query to retrieve entries from the Portfolio post type.
	 *
	 * @param array $atts query arguments
	 * @return object
	 */
	private static function portfolio_query( $atts ) {
		// Default query arguments.
		$default = array(
			'order'          => $atts['order'],
			'orderby'        => $atts['orderby'],
			'posts_per_page' => $atts['showposts'],
		);

		$args = wp_parse_args( $atts, $default );
		$args['post_type'] = self::CUSTOM_POST_TYPE; // Force this post type.

		if ( false != $atts['include_type'] || false != $atts['include_tag'] ) {
			$args['tax_query'] = array();
		}

		// If 'include_type' has been set use it on the main query.
		if ( false != $atts['include_type'] ) {
			array_push(
				 $args['tax_query'], array(
					 'taxonomy' => self::CUSTOM_TAXONOMY_TYPE,
					 'field'    => 'slug',
					 'terms'    => $atts['include_type'],
				 )
				);
		}

		// If 'include_tag' has been set use it on the main query.
		if ( false != $atts['include_tag'] ) {
			array_push(
				 $args['tax_query'], array(
					 'taxonomy' => self::CUSTOM_TAXONOMY_TAG,
					 'field'    => 'slug',
					 'terms'    => $atts['include_tag'],
				 )
				);
		}

		if ( false != $atts['include_type'] && false != $atts['include_tag'] ) {
			$args['tax_query']['relation'] = 'AND';
		}

		// Run the query and return.
		$query = new WP_Query( $args );
		return $query;
	}

	/**
	 * The Portfolio shortcode loop.
	 *
	 * @param array $atts shorcode attributes.
	 * @return html
	 */
	private static function portfolio_shortcode_html( $atts ) {

		$query = self::portfolio_query( $atts );
		$portfolio_index_number = 0;

		ob_start();

		// If we have posts, create the html.
		// with hportfolio markup.
		if ( $query->have_posts() ) {
		?>
			<div class="beercan-portfolio-shortcode grid-x medium-up-<?php echo esc_attr( $atts['columns'] ); ?>">
			<?php
			// Construct the loop...
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id = get_the_ID();
				?>
				<div class="portfolio-entry cell <?php echo esc_attr( self::get_project_class( $portfolio_index_number, $atts['columns'] ) ); ?>">
					<header class="portfolio-entry-header">
					<?php
					// Featured image.
					echo self::get_portfolio_thumbnail_link( $post_id );
					?>

					<h2 class="portfolio-entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>"><?php the_title(); ?></a></h2>

						<div class="portfolio-entry-meta">
						<?php
						if ( false != $atts['display_types'] ) {
							echo self::get_project_type( $post_id );
						}

						if ( false != $atts['display_tags'] ) {
							echo self::get_project_tags( $post_id );
						}

						if ( false != $atts['display_author'] ) {
							echo self::get_project_author( $post_id );
						}
						?>
						</div>

					</header>

				<?php
				// The content.
				if ( false !== $atts['display_content'] ) {
					add_filter( 'wordads_inpost_disable', '__return_true', 20 );
					if ( 'full' === $atts['display_content'] ) {
					?>
						<div class="portfolio-entry-content"><?php the_content(); ?></div>
					<?php
					} else {
					?>
						<div class="portfolio-entry-content"><?php the_excerpt(); ?></div>
					<?php
					}
					remove_filter( 'wordads_inpost_disable', '__return_true', 20 );
				}
				?>
				</div><!-- .portfolio-entry -->
				<?php
				$portfolio_index_number++;
			} // end of while loop.

			wp_reset_postdata();
			?>
		</div><!-- .beercan-portfolio-shortcode -->
		<?php
		} else {
		?>
			<p><em><?php esc_html_e( 'Your Portfolio Archive currently has no entries. You can start creating them on your dashboard.', 'beercan' ); ?></p></em>
		<?php
		}
		$html = ob_get_clean();

		// If there is a [portfolio] within a [portfolio], remove the shortcode.
		if ( has_shortcode( $html, 'portfolio' ) ) {
			remove_shortcode( 'portfolio' );
		}

		// Return the HTML block.
		return $html;
	}

	/**
	 * Individual project css class.
	 *
	 * @param int $portfolio_index_number the index in the loop.
	 * @param int $columns how many columns in a row for the portfolio loop.
	 * @return string
	 */
	private static function get_project_class( $portfolio_index_number, $columns ) {
		$project_types = wp_get_object_terms( get_the_ID(), self::CUSTOM_TAXONOMY_TYPE, array( 'fields' => 'slugs' ) );
		$class = array();

		$class[] = 'medium-' . $columns;
		// add a type- class for each project type.
		foreach ( $project_types as $project_type ) {
			$class[] = 'type-' . esc_html( $project_type );
		}
		if ( $columns > 1 ) {
			if ( ( $portfolio_index_number % 2 ) == 0 ) {
				$class[] = 'portfolio-entry-mobile-first-item-row';
			} else {
				$class[] = 'portfolio-entry-mobile-last-item-row';
			}
		}

		// Add first and last classes to first and last items in a row.
		if ( ( $portfolio_index_number % $columns ) == 0 ) {
			$class[] = 'portfolio-entry-first-item-row';
		} elseif ( ( $portfolio_index_number % $columns ) == ( $columns - 1 ) ) {
			$class[] = 'portfolio-entry-last-item-row';
		}

		/**
		 * Filter the class applied to project div in the portfolio.
		 *
		 * @module custom-content-types
		 *
		 * @since 3.1.0
		 *
		 * @param string $class class name of the div.
		 * @param int $portfolio_index_number iterator count the number of columns up starting from 0.
		 * @param int $columns number of columns to display the content in.
		 */
		return apply_filters( 'portfolio-project-post-class', implode( ' ', $class ), $portfolio_index_number, $columns );
	}

	/**
	 * Displays the project type that a project belongs to.
	 *
	 * @param int $post_id the post id.
	 * @return html
	 */
	private static function get_project_type( $post_id ) {
		$project_types = get_the_terms( $post_id, self::CUSTOM_TAXONOMY_TYPE );

		// If no types, return empty string.
		if ( empty( $project_types ) || is_wp_error( $project_types ) ) {
			return;
		}

		$html = '<div class="project-types"><span>' . __( 'Types', 'beercan' ) . ':</span>';
		$types = array();
		// Loop thorugh all the types.
		foreach ( $project_types as $project_type ) {
			$project_type_link = get_term_link( $project_type, self::CUSTOM_TAXONOMY_TYPE );

			if ( is_wp_error( $project_type_link ) ) {
				return $project_type_link;
			}

			$types[] = '<a href="' . esc_url( $project_type_link ) . '" rel="tag">' . esc_html( $project_type->name ) . '</a>';
		}
		$html .= ' ' . implode( ', ', $types );
		$html .= '</div>';

		return $html;
	}

	/**
	 * Displays the project tags that a project belongs to.
	 *
	 * @param int $post_id the post id.
	 * @return html
	 */
	private static function get_project_tags( $post_id ) {
		$project_tags = get_the_terms( $post_id, self::CUSTOM_TAXONOMY_TAG );

		// If no tags, return empty string.
		if ( empty( $project_tags ) || is_wp_error( $project_tags ) ) {
			return false;
		}

		$html = '<div class="project-tags"><span>' . __( 'Tags', 'beercan' ) . ':</span>';
		$tags = array();
		// Loop thorugh all the tags.
		foreach ( $project_tags as $project_tag ) {
			$project_tag_link = get_term_link( $project_tag, self::CUSTOM_TAXONOMY_TYPE );

			if ( is_wp_error( $project_tag_link ) ) {
				return $project_tag_link;
			}

			$tags[] = '<a href="' . esc_url( $project_tag_link ) . '" rel="tag">' . esc_html( $project_tag->name ) . '</a>';
		}
		$html .= ' ' . implode( ', ', $tags );
		$html .= '</div>';

		return $html;
	}

	/**
	 * Displays the author of the current portfolio project.
	 *
	 * @return html
	 */
	private static function get_project_author() {
		$html = '<div class="project-author">';

		$html .= sprintf( /* translators: %1$s is link to author posts, %2$s is author display name. */
			 __( '<span>Author:</span> <a href="%1$s">%2$s</a>', 'beercan' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
		$html .= '</div>';

		return $html;
	}

	/**
	 * Display the featured image if it's available.
	 *
	 * @param int $post_id the post id.
	 * @return html
	 */
	private static function get_portfolio_thumbnail_link( $post_id ) {
		if ( has_post_thumbnail( $post_id ) ) {
			/**
			 * Change the Portfolio thumbnail size.
			 *
			 * @module custom-content-types
			 *
			 * @since 3.4.0
			 *
			 * @param string|array $var Either a registered size keyword or size array.
			 */
			return '<a class="portfolio-featured-image" href="' . esc_url( get_permalink( $post_id ) ) . '">' . get_the_post_thumbnail( $post_id, apply_filters( 'beercan_portfolio_thumbnail_size', 'large' ) ) . '</a>';
		}
	}
}

add_action( 'init', array( 'Beercan_Portfolio', 'init' ) );
