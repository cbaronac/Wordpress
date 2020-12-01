<?php
	/**
	 * Content part of an article/post.
	 *
	 *
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
?>
<div class="entry-content">
	<?php
	
	the_content( sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			'...<p class="read-more"><a class="btn btn-default" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __( ' Continue Reading', 'ananya' ) . '<span class="screen-reader-text"> '. __( ' Continue Reading', 'ananya' ).'</span></a></p>',
			array(
				'span' => array(
					'class' => array(),
				),
				'p'	=> array(
					'class' => array(),
				),
				'a'	=> array(
					'class' => array(),
					'href'	=> array(),
					'title'	=> array(),
				),
			)
		),
		get_the_title()
	) );


	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ananya' ),
		'after'  => '</div>',
	) );
	?>
</div><!-- .entry-content -->