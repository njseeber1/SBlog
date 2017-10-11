<?php
/**
 * Components functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fotografie
 */

if ( ! function_exists( 'fotografie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fotografie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on components, use a find and replace
		 * to change 'fotografie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fotografie', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1148, 574, true );

		add_image_size( 'fotografie-featured', 533, 533, true );

		add_image_size( 'fotografie-featured-fluid', 640, 640, true );

		add_image_size( 'fotografie-slider', 1920, 1080, true );

		add_image_size( 'fotografie-hero-image', 864, 864, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'      => esc_html__( 'Header', 'fotografie' ),
			'social-menu' => esc_html__( 'Social Menu', 'fotografie' ),
		) );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 200,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fotografie_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/editor-style.css', fotografie_fonts_url() ) );
	}
endif;
add_action( 'after_setup_theme', 'fotografie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fotografie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fotografie_content_width', 756 );
}
add_action( 'after_setup_theme', 'fotografie_content_width', 0 );


if ( ! function_exists( 'fotografie_adjusted_content_width' ) ) :
	/**
	 * Adjust $content_width for front-page.php templates
	 */
	function fotografie_adjusted_content_width() {
		$layout = fotografie_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1376;
		} elseif ( 'no-sidebar-full-content-width' === $layout ) {
			$GLOBALS['content_width'] = 1148;
		}
	}
	add_action( 'template_redirect', 'fotografie_adjusted_content_width' );
endif;

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function fotografie_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function fotografie_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

if ( ! function_exists( 'fotografie_fonts_url' ) ) :
	/**
	 * Register Google fonts for Fotografie.
	 *
	 * Create your own fotografie_fonts_url() function to override in a child theme.
	 *
	 * @since Fotografie 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function fotografie_fonts_url() {
		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'fotografie' ) ) {
			$fonts_url = '//fonts.googleapis.com/css?family=Montserrat:300,300i,700,700i';

			return esc_url( $fonts_url );
		}
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function fotografie_scripts() {
	wp_enqueue_style( 'fotografie-fonts', fotografie_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '4.7.0', 'all' );

	wp_enqueue_style( 'fotografie-style', get_stylesheet_uri() );

	wp_enqueue_script( 'fotografie-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20170616', true );

	wp_enqueue_script( 'fotografie-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20170616', true );

	wp_register_script( 'jquery-match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'fotografie-custom-script', get_template_directory_uri() . '/assets/js/custom-scripts.min.js', array( 'jquery', 'jquery-match-height' ), '20170616', true );

	wp_localize_script( 'fotografie-custom-script', 'fotografieScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'fotografie' ),
		'collapse' => esc_html__( 'collapse child menu', 'fotografie' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue fitvid if JetPack is not installed.
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'fotografie_scripts' );

/**
 * Checks if there are options already present from Fotografie free version and adds it to the Fotografie theme options
 *
 * @since Fotografie 1.0
 * @hook after_theme_switch
 */
function fotografie_setup_options() {
	// Perform action only if theme_mods_theme_mods_fotografie does not exist.
	if ( ! get_option( 'theme_mods_fotografie' ) ) {
		// Perform action only if theme_mods_fotografie free version exists.
		$free_options = get_option( 'theme_mods_fotografie' );

		if ( $free_options ) {
			update_option( 'theme_mods_fotografie', $free_options );
		}
	}
}
add_action( 'after_switch_theme', 'fotografie_setup_options' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include Breadcrumb
 */
require get_parent_theme_file_path( '/inc/breadcrumb.php' );

/**
 * Include Widgets
 */
require get_parent_theme_file_path( '/inc/widgets/widgets.php' );
