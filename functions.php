<?php
/**
 * Load scripts and styles
 */
if( !function_exists( 'ccd_load_scripts' ) ) {
	function ccd_load_scripts() {
		if( is_front_page() ) {
			wp_enqueue_style(
				'ccd_landing',
				get_stylesheet_directory_uri() . '/css/landing.css'
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ccd_load_scripts' );


/**
 * Shortcodes
 */
if( !function_exists( 'ccd_page_header' ) ) {
	function ccd_page_header() {
		$banner_url = '';
		if( has_post_thumbnail( get_the_ID() ) ) {
			$header_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$page_header = $header_image[0];
			$banner_url = get_post_meta( get_the_ID(), 'banner_url', true );
		}
		if( ( !empty( $page_header ) ) && ( empty( $banner_url ) ) && !is_singular( 'projects' ) ) {
			echo '<img src="' . $page_header . '" class="attachment-full wp-post-image" alt="CarbonCube Design">';
		}
		elseif( ( !empty( $page_header ) ) && ( !empty( $banner_url ) ) && !is_singular( 'projects' ) ) {
			echo '<a href="' . $banner_url . '"><img src="' . $page_header . '" class="attachment-full wp-post-image" alt="CarbonCube Design"></a>';
		}
		elseif( is_singular( 'projects' ) ) {
			echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/portfolio-header.jpg" class="attachment-full wp-post-image" alt="CarbonCube Design">';
		}
		else {
			echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-header.jpg" class="attachment-full wp-post-image" alt="CarbonCube Design">';
		}
	}
}
add_shortcode( 'page_header', 'ccd_page_header' );

?>
