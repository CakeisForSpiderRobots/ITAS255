<?php
/**
 * Display Header Media Text
 *
 * @package Catch_Inspire
 */

$header_media_title = get_theme_mod( 'catch_inspire_header_media_title', esc_html__( 'Welcome to Catch Inspire', 'catch-inspire' ) );

$header_media_text = get_theme_mod( 'catch_inspire_header_media_text', esc_html__( 'Make things as simple as possible but no simpler.', 'catch-inspire' ) );

$header_media_disable_cover = get_theme_mod( 'catch_inspire_header_media_disable_cover' );

if ( ! $header_media_title && ! $header_media_text && $header_media_disable_cover ) {
	// Bail if header media title and text are empty.
	return;
}
?>

<div class="custom-header-content sections header-media-section">
	<?php if ( $header_media_title || $header_media_text ) : ?>
		<?php if ( $header_media_title ) : ?>
			<h2 class="entry-title section-title"><?php echo wp_kses_post( $header_media_title ); ?></h2>
		<?php endif; ?>

		<p class="site-header-text"><?php echo wp_kses_post( $header_media_text ); ?>
		<a class="more-link"  href="<?php echo esc_url( get_theme_mod( 'catch_inspire_header_media_url', '#' ) ); ?>" target="<?php echo esc_attr( get_theme_mod( 'catch_inspire_header_url_target' ) ? '_blank' : '_self' ); ?>"  > <span class="more-button"><?php echo esc_html( get_theme_mod( 'catch_inspire_header_media_url_text', esc_html__( 'Continue reading', 'catch-inspire' ) ) ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_title ); ?></span></span></a></p>
	<?php endif; ?>
</div>
