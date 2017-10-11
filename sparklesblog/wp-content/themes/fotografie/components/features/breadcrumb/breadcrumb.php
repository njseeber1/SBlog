<?php
/**
 * Displays Breadcrumb
 *
 * @package CatchThemes
 * @subpackage Fotografie
 * @since 1.0
 * @version 1.0
 */

$enable_breadcrumb = get_theme_mod( 'fotografie_breadcrumb_option', 1 );

if ( $enable_breadcrumb ) :
	if ( function_exists( 'woocommerce_breadcrumb' ) && ( is_woocommerce() || is_shop() ) ) : ?>
		<div class="breadcrumb-area">
			<?php
				$args = array(
					'delimiter' => '',
					'before'    => '<span>',
					'after'     => '</span>',

				);

				woocommerce_breadcrumb( $args );
			?>
		</div><!-- .breadcrumb-area -->
	<?php else :
		fotografie_breadcrumb();
	endif;
endif; ?>
