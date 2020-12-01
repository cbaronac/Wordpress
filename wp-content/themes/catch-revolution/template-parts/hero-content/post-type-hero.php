<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Revolution
 */

if ( $catch_revolution_id = get_theme_mod( 'catch_revolution_hero_content' ) ) {
	$catch_revolution_args['page_id'] = absint( $catch_revolution_id );
}

// If $catch_revolution_args is empty return false
if ( empty( $catch_revolution_args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $catch_revolution_args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		?>
		<div id="hero-section" class="hero-section section content-align-left text-align-left">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php $post_thumbnail = catch_revolution_post_thumbnail( array( 536, 715 ), 'html-with-bg', false );

						if ( $post_thumbnail ) :
							echo $post_thumbnail;
							?>
							<div class="entry-container">
						<?php else : ?>
							<div class="entry-container full-width">
						<?php endif; ?>

							<header class="entry-header">
								<h2 class="entry-title section-title">
									<?php the_title(); ?>
								</h2>
							</header><!-- .entry-header -->

							<?php
							$show_content = get_theme_mod( 'catch_revolution_hero_content_show', 'excerpt' );

							if ( 'full-content' === $show_content ) {
								?>
								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
								<?php
							} elseif ( 'excerpt' === $show_content ) {
								?>
								<div class="entry-summary">
									<?php the_excerpt();  ?>
								</div><!-- .entry-summary -->
								<?php
							}
							?>

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'catch-revolution' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
