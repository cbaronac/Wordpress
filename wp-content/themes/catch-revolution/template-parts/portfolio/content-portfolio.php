<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Catch_Revolution
 */
?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
	<div class="hentry-inner">
		<?php catch_revolution_post_thumbnail( 'full', 'html', true, true ); ?>
		
		<div class="entry-container caption">
			<div class="entry-container-inner-wrap">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					<div class="entry-meta">
						<?php catch_revolution_posted_on(); ?>
					</div>
				</header>
			</div><!-- .entry-container-inner-wrap -->	
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
