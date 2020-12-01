<?php
	/**
	 * Template-part for displaying Hero image section.
	 *
	 * @package Ananya
	 * @since 1.0
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	$header_image_only_on_front_page = get_theme_mod( 'ananya_use_header_image_only_on_front_page_setting', false ); 
	if( has_custom_header() && !$header_image_only_on_front_page ) { ?>

	<div class="custom-header-other-page">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div><!-- custom-header-media -->
		
	</div><!-- custom-header-other-page -->

<?php } ?>