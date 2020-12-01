<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<div class="archive-page-header">
	<header class="container">
		<?php
		the_archive_title( '<h1 class="page-title"><span class="archive-title">', '<span></h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header><!-- .page-header -->
</div><!-- archive-page-header-wrapper -->
<div class="container">
	<div class="row">
		
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_pagination( array( 
					'mid_size' => 1, 
					'prev_text' => __( 'Prev', 'ananya' ),
    				'next_text' => __( 'Next', 'ananya' ), 
    			) );
				
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- main -->
		</div><!-- primary -->
		<?php get_sidebar(); ?>
	</div><!--row-->
</div><!-- container-->
<?php get_footer();