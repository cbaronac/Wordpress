<?php
/**
 * The template for displaying testimonial items
 *
 * @package Catch_Revolution
 */

$catch_revolution_number = get_theme_mod( 'catch_revolution_testimonial_number', 5 );

if ( ! $catch_revolution_number ) {
	// If number is 0, then this section is disabled
	return;
}
?>

<div class="section-content-wrapper testimonial-content-wrapper testimonial-slider owl-carousel">
	<?php
		$catch_revolution_loop = new WP_Query( catch_revolution_testimonial_posts_args() );

		$thumbnails = array();

		if ( $catch_revolution_loop -> have_posts() ) :
			while ( $catch_revolution_loop -> have_posts() ) :
				$catch_revolution_loop -> the_post();

				if( has_post_thumbnail() ) {
					$thumbnails[] = get_the_post_thumbnail_url( null, array( 140, 140 ) );
				} else {
					$thumbnails[] = trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-140x140.jpg';
				} ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="hentry-inner">
						<div class="entry-container">
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
							
							<?php 
							$position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>			
							<header class="entry-header">
								<h2 class="entry-title"><a href=<?php the_permalink(); ?>><?php the_title(); ?></a>
								</h2> 
								<?php if ( $position ) : ?>
									<p class="entry-meta"><span class="position">
										<?php echo esc_html( $position ); ?></span>
									</p>
								<?php endif; ?>
							</header>
						</div><!-- .entry-container -->	
					</div><!-- .hentry-inner -->
				</article> 
			<?php endwhile;
			wp_reset_postdata();
		endif;
	?>
</div><!-- .section-content-wrapper -->
	<ul id='testimonial-dots' class='owl-dots'>
		<?php
			foreach ( $thumbnails as $thumb ) {
				echo '<li class="owl-dot"><img src="' . esc_url( $thumb ) . '"/> </li> ';
			}
		?>
	</ul>
<ul id='testimonial-nav' class='owl-nav'>
</ul>
