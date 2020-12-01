<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hide_footer = get_theme_mod( 'ananya_hide_blog_page_post_footer_option', false );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<?php if( is_single() ) { 
		get_template_part( 'template-parts/posts/entry', 'header' ); 
	}?>
		
	<?php ananya_post_thumbnail(); ?>
		
	<div class="post-content-wrapper">

		<?php if( !is_single()) { ?>
		<?php get_template_part( 'template-parts/posts/entry', 'header' ); ?>
		<?php } ?>

		<?php
		//Entry summary/content depending on choice
		$post_display_option = get_theme_mod( 'ananya_post_display_type_option', 'post-excerpt' );
		if ( is_search()  || is_archive() || ('post-excerpt' === $post_display_option and ! is_single() ) ) {
			get_template_part( 'template-parts/posts/entry','excerpt' );
		} else {
			get_template_part( 'template-parts/posts/entry', 'content' );
		}
		if( !is_single() && !$hide_footer ) {
			ananya_excerpt_entry_footer(); 
		}
		?>
		
		<?php if( is_single() ) { ?>
			<?php ananya_single_post_footer(); ?>
		<?php } ?>
	</div><!-- post-content -->
		
</article><!-- #post -->