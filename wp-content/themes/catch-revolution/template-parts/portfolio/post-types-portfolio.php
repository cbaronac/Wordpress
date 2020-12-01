<?php
/**
 * The template for displaying portfolio items
 *
 * @package Catch_Revolution
 */

$catch_revolution_number = get_theme_mod( 'catch_revolution_portfolio_number', 6 );

if ( ! $catch_revolution_number ) {
	// If number is 0, then this section is disabled
	return;
}

$catch_revolution_args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$catch_revolution_post_list  = array();// list of valid post/page ids

$catch_revolution_no_of_post = 0; // for number of posts

$catch_revolution_args['post_type'] = 'jetpack-portfolio';

for ( $i = 1; $i <= $catch_revolution_number; $i++ ) {
	$catch_revolution_post_id = '';

	$catch_revolution_post_id =  get_theme_mod( 'catch_revolution_portfolio_cpt_' . $i );

	if ( $catch_revolution_post_id && '' !== $catch_revolution_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$catch_revolution_post_id = pll_get_post( $catch_revolution_post_id, pll_current_language() );
		}

		$catch_revolution_post_list = array_merge( $catch_revolution_post_list, array( $catch_revolution_post_id ) );

		$catch_revolution_no_of_post++;
	}
}

$catch_revolution_args['post__in'] = $catch_revolution_post_list;

if ( 0 === $catch_revolution_no_of_post ) {
	return;
}

$catch_revolution_args['posts_per_page'] = $catch_revolution_no_of_post;
$catch_revolution_loop     = new WP_Query( $catch_revolution_args );

$slider_select = get_theme_mod( 'catch_revolution_portfolio_slider', 1 );

if ( $catch_revolution_loop -> have_posts() ) : ?>
	<div class="layout-wrap">
	<?php
	while ( $catch_revolution_loop -> have_posts() ) :
		$catch_revolution_loop -> the_post();

		get_template_part( 'template-parts/portfolio/content', 'portfolio' );

		if (  0 === ( ( $catch_revolution_loop->current_post + 1 ) % 3 ) && ( $catch_revolution_loop->current_post + 1 ) < $catch_revolution_number ) {
			echo '</div> <!-- .layout-wrap --><div class="layout-wrap">';
		}

	endwhile;
	wp_reset_postdata();
	?>
	</div> <!-- .layout-wrap -->
	<?php
endif;
