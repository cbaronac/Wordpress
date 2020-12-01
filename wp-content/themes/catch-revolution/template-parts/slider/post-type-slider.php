<?php
/**
 * The template used for displaying slider
 *
 * @package Catch_Revolution
 */

$catch_revolution_quantity   = get_theme_mod( 'catch_revolution_slider_number', 4 );
$catch_revolution_no_of_post = 0; // for number of posts
$catch_revolution_post_list  = array(); // list of valid post/page ids

$catch_revolution_args = array(
	'ignore_sticky_posts' => 1, // ignore sticky posts
);

$catch_revolution_args['post_type'] =  'page';

for ( $i = 1; $i <= $catch_revolution_quantity; $i++ ) {
	$catch_revolution_id = '';

	$catch_revolution_id = get_theme_mod( 'catch_revolution_slider_page_' . $i );

	if ( $catch_revolution_id && '' !== $catch_revolution_id ) {
		$catch_revolution_post_list = array_merge( $catch_revolution_post_list, array( $catch_revolution_id ) );

		$catch_revolution_no_of_post++;
	}
}

	$catch_revolution_args['post__in'] = $catch_revolution_post_list;
	$catch_revolution_args['orderby'] = 'post__in';

if ( ! $catch_revolution_no_of_post ) {
	return;
}

$catch_revolution_args['posts_per_page'] = $catch_revolution_no_of_post;
$catch_revolution_loop = new WP_Query( $catch_revolution_args );

while ( $catch_revolution_loop->have_posts() ) :
	$catch_revolution_loop->the_post();

	$catch_revolution_classes = 'post post-' . get_the_ID() . ' hentry slides';

	?>
	<article class="<?php echo esc_attr( $catch_revolution_classes ); ?>">
		<div class="hentry-inner">
			<?php catch_revolution_post_thumbnail( 'catch-revolution-slider', 'html', true, true ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</header>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
