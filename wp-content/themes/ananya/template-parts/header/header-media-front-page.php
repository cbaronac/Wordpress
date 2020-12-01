<?php
/**
 * Template-part for displaying Hero Header/Banner section.
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php if( has_custom_header() ) { ?>
	<div class="custom-header">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div><!-- custom-header-media -->
		
		<?php get_template_part( 'template-parts/header/header', 'info' ); ?>

	</div><!-- custom-header -->
<?php } ?>