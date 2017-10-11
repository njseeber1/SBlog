<?php
/**
 * The template for displaying featured image content
 *
 * @package Fotografie
 */

$quantity = get_theme_mod( 'fotografie_featured_content_number', 3 );

for ( $i = 1; $i <= $quantity; $i++ ) {
	$target = get_theme_mod( 'fotografie_featured_content_target_' . $i ) ? '_blank' : '_self';

	$link = get_theme_mod( 'fotografie_featured_content_link_' . $i ) ? get_theme_mod( 'fotografie_featured_content_link_' . $i ) : '#';

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$link = qtrans_convertURL( $link );
	}

	echo '
	<article id="featured-post-' . esc_attr( $i ) . '" ';
	post_class();
	echo '>';

	$title   = get_theme_mod( 'fotografie_featured_content_title_' . $i );
	$content = get_theme_mod( 'fotografie_featured_content_content_' . $i );

	$image = get_theme_mod( 'fotografie_featured_content_image_' . $i ) ? get_theme_mod( 'fotografie_featured_content_image_' . $i ) : trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb.jpg';

	echo '
	<a href="' . esc_url( $link ) . '">
		<img src="' . esc_url( $image ) . '" class="wp-post-image" alt="' . esc_attr( $title ) . '" title="' . esc_attr( $title ) . '">
	</a>';

	if ( $title || $content ) {
		echo '
		<header class="featured-content entry-header">';

		if ( $title ) {
			echo '
			<h2 class="entry-title">
				<a href="' . esc_url( $link ) . '" rel="bookmark" target="' . esc_attr( $target ) . '">' . wp_kses_post( $title ) . '</a>
			</h2>';
		}

		if ( '' !== $content ) {
			echo '
			<div class="entry-content">' . wp_kses_post( $content ) . '</div>';
		}

		echo '
		</header>';
	}

	echo '
	</article><!-- .featured-post-' . esc_attr( $i ) . ' -->';
} // End for().
