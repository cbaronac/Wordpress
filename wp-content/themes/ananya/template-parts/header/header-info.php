<?php
/**
 * Template-part for displaying Hero Image Text.
 * @package Ananya
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$hero_title = get_theme_mod( 'ananya_header_title', '' );
$hero_subtitle = get_theme_mod( 'ananya_header_subtitle', '' );
$hero_button_text = get_theme_mod( 'ananya_header_button_text', '');
$hero_read_more_url = get_theme_mod( 'ananya_header_button_url', '' );
?>

<?php if( $hero_title || $hero_subtitle ) { ?>
<div class="custom-heading">
    <div class="container">
    	<div class="col-md-8">
    		<?php if( $hero_title ) { ?>
        	<h1><?php echo ananya_sanitize_text( $hero_title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
        	<?php } ?>
        	<?php if( $hero_subtitle ) { ?>
        	<p class="subheading"><?php echo esc_html( $hero_subtitle ); ?></p>
        	<?php } ?>
        	<?php if( $hero_button_text ) { ?>
        	<button class="button hero-section-btn"><a href="<?php echo esc_url( $hero_read_more_url ); ?>" target="_blank"><?php echo esc_html( $hero_button_text ); ?></a></button>
        	<?php } ?>
    	</div><!-- col-md-8 -->
    </div><!-- container -->
</div><!-- custom-heading -->
<?php } //endif  ?>