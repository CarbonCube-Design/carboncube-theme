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
function ccd_page_header( $post = null ) {
	$post = get_post( $post );
	$id = $post->ID;
	$type = $post->post_type;
	
	if( has_post_thumbnail( $id ) ) {
		$header_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		$page_header = $header_image[0];
		$banner_url = get_post_meta( $id, 'banner_url', true );
		
		// case 1 - custom header image, no link
		if( !empty( $page_header ) && empty( $banner_url ) && $type != 'project' ) {
			return '<img src="' . $page_header . '" class="attachment-full wp-post-image" alt="CarbonCube Design">';
		}
		
		// case 2 - custom header image, with link
		elseif( !empty( $page_header ) && !empty( $banner_url ) && $type != 'project' ) {
			return '<a href="' . $banner_url . '"><img src="' . $page_header . '" class="attachment-full wp-post-image" alt="CarbonCube Design"></a>';
		}
		
		// case 3 - is Project archive page
		elseif( $type == 'project' ) {
			return '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/portfolio-header.jpg" class="attachment-full wp-post-image" alt="CarbonCube Design">';
		}
	}
	else {
		return '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default-header.jpg" class="attachment-full wp-post-image" alt="CarbonCube Design">';
	}
}
add_shortcode( 'page_header', 'ccd_page_header' );
?>
