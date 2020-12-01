<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Catch_Revolution
 */

$catch_revolution_number        = get_theme_mod( 'catch_revolution_featured_content_number', 3 );
$catch_revolution_post_list     = array();
$catch_revolution_no_of_post    = 0;

$catch_revolution_args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

$catch_revolution_args['post_type'] = 'featured-content';

for ( $i = 1; $i <= $catch_revolution_number; $i++ ) {
	$catch_revolution_post_id = '';

	$catch_revolution_post_id = get_theme_mod( 'catch_revolution_featured_content_cpt_' . $i );

	if ( $catch_revolution_post_id && '' !== $catch_revolution_post_id ) {
		$catch_revolution_post_list = array_merge( $catch_revolution_post_list, array( $catch_revolution_post_id ) );

		$catch_revolution_no_of_post++;
	}
}

$catch_revolution_args['post__in'] = $catch_revolution_post_list;
$catch_revolution_args['orderby']  = 'post__in';

if ( ! $catch_revolution_no_of_post ) {
	return;
}

$catch_revolution_args['posts_per_page'] = $catch_revolution_no_of_post;

$catch_revolution_loop = new WP_Query( $catch_revolution_args );

while ( $catch_revolution_loop->have_posts() ) :
	
	$catch_revolution_loop->the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php $thumbnail = array( 568, 378 );
			catch_revolution_post_thumbnail( $thumbnail );
			?>

			<div class="entry-container">
				<header class="entry-header">
					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php catch_revolution_posted_on(); ?>

					</div><!-- .entry-meta -->
					<?php endif; ?>
					
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
endwhile;

wp_reset_postdata();
