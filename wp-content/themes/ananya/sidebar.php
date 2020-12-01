<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ananya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<aside id="secondary" class="widget-area">
	<?php if ( ! dynamic_sidebar( 'ananya-sidebar-1' ) ) : ?>
		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>
		<aside id="archives" class="widget">
		    <h3 class="widget-title"><?php esc_html_e( 'Archives', 'ananya' ); ?></h3>
		    <ul>
		        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		    </ul>
		</aside>
	<?php endif; // end sidebar widget area ?>
</aside><!-- #secondary -->