<?php
	/**
	 * Header part of an post/article, which includes, article title and meta data.
	 *
	 *
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
?>
<header class="entry-header">
	<?php  
	if ( has_post_thumbnail() ) {
		$add_class = 'has-post-thumbnail';
	} else {
		$add_class = '';
	}
	?>
	<?php if ( !is_single()) { ?>
	<div class="entry-meta">
	<?php ananya_posted_on(''); ?>
	</div><!-- entry-date -->
	<?php } ?>
	<?php
	if ( is_singular() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	//ananya_post_categories( 1 );
	if ( 'post' === get_post_type() ) :
		if( !is_singular()) {
			ananya_post_excerpt_meta();
		} else {
			ananya_single_post_meta();
		}
	endif; ?>
</header><!-- .entry-header -->