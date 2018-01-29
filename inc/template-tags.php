<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Beercan
 */

if ( ! function_exists( 'beercan_get_post_title' ) ) :

	/**
	 * Returns the current post title.
	 *
	 * @param string $before String before the title.
	 * @param string $after String after the title.
	 * @param string $echo True to echo out the output, false to return. Defalut true.
	 *
	 * @return string title of the post.
	 */
	function beercan_get_post_title( $before = '<h1>', $after = '</h1>', $echo = true ) {

		$title = get_the_title();

		if ( is_archive() ) :
			$title = 'Posts by: ' . get_the_archive_title();
		elseif ( is_home() && ! is_front_page() ) :
			$title = single_post_title( '', false );
		elseif ( is_search() ) :
			/* translators: %s: search results. */
			$title = sprintf( esc_html__( 'Search Results for: %s', 'beercan' ), get_search_query() );
		elseif ( is_404() ) :
			$title = __( 'Page not found', 'beercan' );
		endif;

		if ( $echo ) {
			echo $before . esc_html( $title ) . $after;
			return;
		}

		return $title;
	}

endif;

if ( ! function_exists( 'beercan_post_date' ) ) :

	/**
	 * Returns the post date.
	 *
	 * @param boolean $modified_date  true to show the last modified date, false for original post date.
	 *
	 * @return string the post date (or the date modified).
	 */
	function beercan_post_date( $modified_date = true ) {
		$time_string = '<span class="posted-on"><time class="entry-date published updated" datetime="%1$s">%2$s</time></span>';
		if ( $modified_date && get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span class="posted-on"><time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time></span>';
		}

		$date_format = 'd M, Y';

		$post_time = sprintf(
			$time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( $date_format ) ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
		);

		return $post_time;
	}

endif;


if ( ! function_exists( 'beercan_post_author' ) ) :

	/**
	 * Returns the post author.
	 *
	 * @param class $post the post object.
	 *
	 * @return string the author name.
	 */
	function beercan_post_author( $post = '' ) {
		if ( ! $post ) {
			global $post;
		}
		$author_id   = get_the_author_meta( 'ID', $post->post_author );
		$author_name = esc_html( get_the_author_meta( 'display_name', $author_id ) );

		if ( $author_name ) {

			$author = sprintf(
				/* translators: %s: post author. */
				esc_html( '%s' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . $author_name . '</a></span>'
			);

			return $author;
		}
	}

endif;

if ( ! function_exists( 'beercan_get_comments_link' ) ) :

	/**
	 * Get the hyperlink to the post's comment section.
	 *
	 * @return string the HTML output for the post's comment section
	 */
	function beercan_get_comments_link() {

		$comments_count = get_comments_number();
		$comments       = '';

		if ( ! post_password_required() && ( comments_open() || $comments_count ) ) {
			$comments  = '<span class="comments-link">';
			$comments .= "<a href='" . get_comments_link() . "' data-smooth-scroll><i class='fa fa-comments' aria-hidden='true'></i> " . $comments_count . '</a>';
			$comments .= '</span>';
		}

		return $comments;
	}

endif;

if ( ! function_exists( 'beercan_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function beercan_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			 $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html( '%s' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$author_id   = intval( get_post_field( 'post_author', get_the_ID() ) );
		$author_name = get_the_author_meta( 'display_name', $author_id );

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html( '%s' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( $author_name ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		$comments_count = get_comments_number();

		if ( ! post_password_required() && ( comments_open() || $comments_count ) ) {
			echo '<span class="comments-link">';
			echo '<a href="' . esc_url( get_comments_link() ) . '" ><i class="fa fa-comments" aria-hidden="true"></i> ' . esc_html( $comments_count ) . '</a>';
			echo '</span>';
		}
	}
endif;


if ( ! function_exists( 'beercan_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function beercan_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'beercan' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Categories: %1$s', 'beercan' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'beercan' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'beercan' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		beercan_edit_link();
	}
endif;

if ( ! function_exists( 'beercan_post_thumbnail' ) ) :
	/**
	 * Returns or displays the current post's thumbnail in the loop.
	 *
	 * @param boolean $display true to echo the thumbnail, false to return.
	 * @param boolean $placeholder true to add a placeholder if there is no thumnail, false if other.
	 */
	function beercan_post_thumbnail( $display = true, $placeholder = true ) {
		?>
		<div class='featured-image cell'>
			<figure>
				<?php
				echo '<a href="' . esc_html( get_the_permalink() ) . '">';
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} elseif ( $placeholder ) {
					$format = get_post_format();
					if ( 'video' === $format ) {
						echo '<i class="dashicons dashicons-video-alt" aria-hidden="true"></i>';
					} elseif ( 'audio' === $format ) {
						echo '<i class="dashicons dashicons-format-audio" aria-hidden="true"></i>';
					} elseif ( 'image' === $format ) {
						echo '<i class="dashicons dashicons-format-image" aria-hidden="true"></i>';
					} elseif ( 'gallery' === $format ) {
						echo '<i class="dashicons dashicons-format-gallery" aria-hidden="true"></i>';
					} elseif ( 'link' === $format ) {
						echo '<i class="dashicons dashicons-admin-links" aria-hidden="true"></i>';
					} elseif ( 'quote' === $format ) {
						echo '<i class="dashicons dashicons-format-quote" aria-hidden="true"></i>';
					} elseif ( 'chat' === $format ) {
						echo '<i class="dashicons dashicons-format-chat" aria-hidden="true"></i>';
					} elseif ( 'status' === $format ) {
						echo '<i class="dashicons dashicons-format-status" aria-hidden="true"></i>';
					} else {
						echo '<i class="fa fa-file-text" aria-hidden="true"></i>';
					}
				}
				echo '</a>';
				?>
			</figure>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'beercan_header_image_url' ) ) :
	/**
	 * Returns the url for the header image.
	 */
	function beercan_header_image_url() {
		$img = get_header_image();

		if ( is_home() ) {
			$blog_page_id = get_option( 'page_for_posts' );
			if ( $blog_page_id ) {
				$thumb_url = get_the_post_thumbnail_url( $blog_page_id );
			}
		} else {
			$thumb_url = get_the_post_thumbnail_url();
		}

		if ( $thumb_url ) {
			$img = $thumb_url;
		}

		return $img;
	}
endif;


if ( ! function_exists( 'beercan_posts_pagination' ) ) :
	/**
	 * Displays the posts pagination.
	 */
	function beercan_posts_pagination() {
		$args = array(
			'current'  => max( 1, get_query_var( 'paged' ) ),
			'show_all' => true,
			'type'     => 'list',
		);

		the_posts_pagination( $args );
	}

endif;

 if ( ! function_exists( 'beercan_post_subtitle' ) ) :
	/**
	 * Displays the post's subtitle.
	 */
	function beercan_post_subtitle() {
		if ( is_single() ) {
			echo '<div class="entry-meta">';
			beercan_posted_on();
			echo '</div>';
		} elseif ( is_category() ) {
			echo category_description();
		}
	}
endif;

if ( ! function_exists( 'bearcan_read_more' ) ) :
	/**
	 * Output post read more button
	 *
	 * @param boolean $display true if to.
	 * @param string  $text The text inside the button. Defaults to 'Read More'.
	 */
	function bearcan_read_more( $display = true, $text = 'Read More' ) {
		$read_more  = "<div class='after-excerpt cell'>";
		$read_more .= "<a href='" . get_the_permalink() . "' class='button read-more'>";
		$read_more .= esc_html( $text );
		$read_more .= '</a>';
		$read_more .= '</div>';

		if ( $display ) :
			echo $read_more;
			return;
		endif;

		return $read_more;
	}
endif;

if ( ! function_exists( 'beercan_edit_link' ) ) :
/**
 * Displays the edit post link
 */
function beercan_edit_link() {
		edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'beercan' ), array( 'span' => array( 'class' => array( 'button' ) ) )
			), get_the_title()
		),
		'<span class="edit-link">',
		'</span>',
		'',
		'button'
			);
	}
endif;

if ( ! function_exists( 'get_footer_columns' ) ) :
	/**
	 * Returns the number of columns in the Footer
	 *
	 * @return int the number of columns in the footer.
	 */
	function get_footer_columns() {
		$footer_columns = 3;

		return $footer_columns;
	}
endif;

if ( ! function_exists( 'beercan_is_a_loop' ) ) :
	/**
	 * Determines if the current page is a
	 *
	 * @return type boolean
	 */
	function beercan_is_a_loop() {
		return ( is_archive() || is_home() || is_category() || is_tag() ) ? true : false;
	}
endif;
