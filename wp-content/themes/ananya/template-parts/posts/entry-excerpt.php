<?php
	/**
	 * Entry summary/excerpt part of an article.
	 *
	 * @package Ananya
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
?>
<div class="entry-summary">
	<?php the_excerpt(); ?>	
</div><!-- .entry-summary -->

