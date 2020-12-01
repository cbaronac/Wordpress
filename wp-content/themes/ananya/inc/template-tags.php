<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ananya_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 * @since 1.0
	 */
	function ananya_posted_on() {
		$posted_on_str = '';
		if( is_single() ) {
			$posted_on_str = __( 'On ', 'ananya' );
		} 
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			$posted_on_str.esc_html( '%s' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'ananya_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 * @since 1.0
	 */
	function ananya_posted_by() {
		$by_str = __( 'By ', 'ananya' );
		if( is_single() ) {
			$by_str = __( 'Posted By ', 'ananya' );
		} 
		$byline = sprintf(
			/* translators: %s: post author. */
			$by_str.esc_html( '%s' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'ananya_excerpt_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * @since 1.0
	 */
	function ananya_excerpt_entry_footer() {
		
		?>
		<div class="row entry-footer">

			<div id="blog-cat-links" class="col-md-4 footer-cotegory-links">
			<?php ananya_post_categories(); ?>
			</div><!-- footer-cotegory-links -->

			<div id="blog-edit-link" class="col-md-4 entry-edit-link">
			<?php 
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'ananya' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link"><i class="fas fa-edit"></i>',
					'</span>'
				); 
			?>
			</div><!-- entry-edit-link -->

			<div id="blog-social-share" class="col-md-4 social-share">
				<?php 
				echo wp_kses_post( ananya_social_sharing_buttons() );
				?>
			</div><!-- social-share -->

		</div><!-- row -->
		
		<?php
	}
endif;

if ( ! function_exists( 'ananya_post_excerpt_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * @since 1.0
	 */
	function ananya_post_excerpt_meta() { ?>
		<div class="entry-meta">
			<?php ananya_posted_by(); ?>
			<?php ananya_post_comments_link(); ?>
		</div><!-- entry-meta -->
	<?php
	}
endif;


if ( ! function_exists( 'ananya_single_post_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * @since 1.0
	 */
	function ananya_single_post_meta() { ?>
		<div class="single-entry-meta">
			<?php ananya_posted_by(); ?>
			<?php ananya_posted_on(); ?>
			<?php ananya_post_comments_link(); ?>
		</div><!-- single-entry-meta -->
	<?php
	}
endif;

if ( ! function_exists( 'ananya_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * @since 1.0
	 */
	function ananya_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- post-thumbnail -->

		<?php else : ?>

			<div class="featured-image">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
						'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
				?>
			</a>
			</div><!-- featured-image -->

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'ananya_post_categories' ) ) :
	/**
	 * Displays post categories.
	 * @since 1.0
	 *
	 */
	function ananya_post_categories() {
		// Hide category text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ananya' ) );
			
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="fas fa-folder-open"></i>&nbsp;' . esc_html( '%1$s', 'ananya' ) . '</span>', $categories_list );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'ananya_post_tags' ) ) :
	/**
	 * Displays post tags.
	 * @since 1.0
	 *
	 */
	function ananya_post_tags() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ananya' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i>' . esc_html( ' %1$s', 'ananya' ) . '</span>', $tags_list );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'ananya_post_comments_link' ) ) :
	/**
	 * Displays link to posts comments.
	 * @since 1.0
	 *
	 */
	function ananya_post_comments_link() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '0 Comment<span class="screen-reader-text"> on %s</span>', 'ananya' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;


if ( ! function_exists( 'ananya_post_meta_separator' ) ) :
	/**
	 * Displays post categories.
	 * @since 1.0
	 *
	 */
	function ananya_post_meta_separator( $sep ) { ?>
		<span class="meta-sep">&nbsp;<?php echo esc_html( $sep ); ?>&nbsp;</span>
	<?php }
endif;

if ( ! function_exists( 'ananya_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0
 */
function ananya_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	$previous_post = get_previous_post();
	if ( ! empty( $previous_post ) ) {
		$previous_thumb = get_the_post_thumbnail( $previous_post->ID, 'ananya-prevnext-thumbnail' );
	}
	$next_post = get_next_post();
	if ( ! empty( $next_post ) ) {
		$next_thumb     = get_the_post_thumbnail( $next_post->ID, 'ananya-prevnext-thumbnail' );
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'ananya' ); ?></h2>
		<div class="nav-links">
			<?php if ( ! empty( $previous_post ) ) : ?>
				<div class="nav-previous">
					<?php previous_post_link( '%link', ' ' . $previous_thumb . '<div class="nav-innner"><span class="screen-reader-text">' . esc_html_x( 'Previous Post: ', 'post navigation', 'ananya' ) . '%title</span><span>' . esc_html__( 'Previous Post', 'ananya' ) . '</span> <div>%title</div></div>' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $next_post ) ) : ?>
				<div class="nav-next">
					<?php next_post_link( '%link', '<div class="nav-innner"><span class="screen-reader-text">' . esc_html_x( 'Next Post: ', 'post navigation', 'ananya' ) . '%title</span><span>' . esc_html__( 'Next Post', 'ananya' ) . '</span><div>%title</div></div>' . $next_thumb . ' ' ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation-->
	<?php
}
endif;

//display_top_category_setting
if ( ! function_exists( 'ananya_get_first_category' ) ) :
	/**
	 * Prints HTML with meta information for the category
	 * @since 1.0
	 */
	function ananya_get_first_category() {

		$post_top_cat_option = get_theme_mod( 'ananya_display_top_category_setting', true );
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() and $post_top_cat_option == true ) {
			
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				 // Get the URL of this category
	    		$category_link = get_category_link( $categories[0]->term_id );
			    printf( '<a class="top-cat-link" href="'.'%1$s'.'" >' . esc_html( '%2$s', 'ananya' ) . '</a>', esc_url( $category_link ), $categories[0]->name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'ananya_single_post_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * @since 1.0
	 */
	function ananya_single_post_footer() {
		
		$hide_single_post_share_buttons = get_theme_mod( 'ananya_hide_single_post_share_option', false );
	?>
		<div class="row single-post-entry-footer">

			<div id="single-cat-links" class="col-md-6 footer-cotegory-links">
			<?php 
			//Display Categories
			ananya_post_categories();
			?>
			</div><!-- comments-link -->

			<div id="single-tag-links" class="col-md-6 footer-tag-links">
				<?php
				//Display tags
				ananya_post_tags(); ?>
			</div><!-- footer-tag-links -->

		</div><!-- row -->

		<?php if( !$hide_single_post_share_buttons ) { ?>
		<div id="single-social-share" class="social-share">
			<?php echo wp_kses_post( ananya_social_sharing_buttons() ); ?>
		</div><!-- single-social-share -->
		<?php } ?>

		<?php	

		//Display edit link
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ananya' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-edit"></i>',
			'</span>'
		);
	}
endif;



if ( ! function_exists ( 'ananya_social_sharing_buttons' ) ) { 
	/** 
	 *  Prints HTML for the social share buttons.
	 * @since 1.0
	 */
	function ananya_social_sharing_buttons() {
		global $post;
		// Show this on post only. if social shared enabled.
		
		// Get current page URL
		$shortURL = esc_url( get_permalink() );
			
		// Get current page title
		$shortTitle = get_the_title();
		$postmediaurl = get_the_post_thumbnail_url($post->id);
		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/share?text='.$shortTitle.'&url='.$shortURL;
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shortURL;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$shortURL.'&title='.$shortTitle;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$shortURL.'&media='.$postmediaurl.'&description='.$shortTitle;
		$redditURL = 'https://reddit.com/submit?url='.$shortURL.'&title='.$shortTitle;
		
		
		// Add sharing button at the end of page/page content
		$content = '<ul>';
		$content .= '<li>Share: </li>';

		$content .= '<li><a href="'.esc_url( $facebookURL ).'" target = "_blank"><i class="fab fa-facebook-f"></i></a></li>';
		
		$content .= '<li><a href="'. esc_url( $twitterURL ).'" target = "_blank"><i class="fab fa-twitter"></i></a></li>';
		
		$content .= '<li><a href="'. esc_url( $linkedInURL ) .'" target = "_blank"><i class="fab fa-linkedin"></i></a></li>';
		
		$content .= '<li><a href="'. esc_url( $pinterestURL ) .'" target = "_blank"><i class="fab fa-pinterest-p"></i></a></li>';
		$content .= '<li><a href="'. esc_url( $redditURL ) .'" target = "_blank"><i class="fab fa-reddit"></i></a></li>';
		$content .= '</ul>';
		
		return $content;
		
	}
}

if ( ! function_exists( 'ananya_more_link' ) ) :
	/**
	 * Displays the more link on posts.
	 * @since 1.0
	 */
	function ananya_more_link() {
			$read_more_markup = '<div class="entry-read-more"><span class="read-more"><a href="'.esc_url( get_permalink() ).'" class="more-link">'. esc_html__( 'Read More', 'ananya' ).'&nbsp;<i class="fas fa-long-arrow-alt-right"></i></a></span></div><!-- entry-read-more -->';
			return $read_more_markup;
	}
endif;