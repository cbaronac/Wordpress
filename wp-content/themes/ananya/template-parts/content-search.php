<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ananya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hide_footer = get_theme_mod( 'ananya_hide_blog_page_post_footer_option', false );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
	<?php ananya_post_thumbnail(); ?>
	
	<div class="post-content-wrapper">
	
		<?php get_template_part( 'template-parts/posts/entry', 'header' ); ?>

		<?php get_template_part( 'template-parts/posts/entry','excerpt' ); ?>

		<?php
		if( !$hide_footer ) {
			ananya_excerpt_entry_footer(); 
		}
		?>
	</div><!-- post-content-wrapper -->
		
</article><!-- #post -->