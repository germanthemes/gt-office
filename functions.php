<?php
/**
 * GT Office functions and definitions
 *
 * @package GT Office
 */

/**
 * GT Office only works in WordPress 5.5 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.5', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gt_office_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'gt-office', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 1600, 900, true );

	// Add image size for header image on single posts and pages.
	add_image_size( 'gt-office-header-image', 2400, 900, true );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary'       => esc_html__( 'Main Navigation', 'gt-office' ),
		'secondary'     => esc_html__( 'Top Navigation', 'gt-office' ),
		'footer'        => esc_html__( 'Footer Navigation', 'gt-office' ),
		'social-header' => esc_html__( 'Social Icons (Header)', 'gt-office' ),
		'social-footer' => esc_html__( 'Social Icons (Footer)', 'gt-office' ),
	) );

	// Switch default core markup for galleries and captions to output valid HTML5.
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'gt_office_custom_logo_args', array(
		'height'      => 60,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'gt_office_custom_header_args', array(
		'header-text' => false,
		'width'       => 2400,
		'height'      => 900,
		'flex-height' => true,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gt_office_custom_background_args', array(
		'default-color' => 'cccccc',
	) ) );

	// Add Theme Support for Selective Refresh in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'gt_office_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gt_office_content_width() {
	// Set global variable for content width.
	$GLOBALS['content_width'] = apply_filters( 'gt_office_content_width', 800 );
}
add_action( 'after_setup_theme', 'gt_office_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function gt_office_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'gt-office-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( has_nav_menu( 'primary' ) or has_nav_menu( 'secondary' ) ) {
		wp_enqueue_script( 'gt-office-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '20210210', true );
		$gt_office_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'gt-office' ),
			'collapse' => esc_html__( 'Collapse child menu', 'gt-office' ),
			'icon'     => gt_office_get_svg( 'expand' ),
		);
		wp_localize_script( 'gt-office-navigation', 'gtOfficeScreenReaderText', $gt_office_l10n );
	}

	// Register and enqueue header-search.js if enabled
	if ( true === gt_office_get_option( 'header_search' ) || is_customize_preview() ) :

		wp_enqueue_script( 'gt-office-header-search', get_theme_file_uri( '/assets/js/header-search.min.js' ), array( 'jquery' ), '20200911', true );

	endif;

	// Register and enqueue scroll-to-top.js if enabled
	if ( true === gt_office_get_option( 'scroll_to_top' ) || is_customize_preview() ) :

		wp_enqueue_script( 'gt-office-scroll-to-top', get_theme_file_uri( '/assets/js/scroll-to-top.min.js' ), array( 'jquery' ), '20210409', true );
		wp_localize_script( 'gt-office-scroll-to-top', 'gtOfficeScrollButton', array( 'icon' => gt_office_get_svg( 'collapse' ) ) );

	endif;

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_office_scripts' );


/**
* Enqueue theme fonts.
*/
function gt_office_theme_fonts() {
	$fonts_url = gt_office_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'gt-office-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20210105' );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_office_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'gt_office_theme_fonts', 1 );


/**
 * Retrieve webfont URL to load fonts locally.
 */
function gt_office_get_fonts_url() {
	$font_families = array(
		'Inter:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'gt_office_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gt_office_widgets_init() {

	// Register Blog Sidebar widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gt-office' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html_x( 'Appears on blog pages and single posts.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Before Header widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Before Header', 'gt-office' ),
		'id'            => 'before-header',
		'description'   => esc_html_x( 'Appears above the header area.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register After Header widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'After Header', 'gt-office' ),
		'id'            => 'after-header',
		'description'   => esc_html_x( 'Appears below the header area.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Before Blog widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Before Content', 'gt-office' ),
		'id'            => 'before-content',
		'description'   => esc_html_x( 'Appears above the content area.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register After Posts widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'After Single Posts', 'gt-office' ),
		'id'            => 'after-posts',
		'description'   => esc_html_x( 'Appears below single posts.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register After Pages widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'After Pages', 'gt-office' ),
		'id'            => 'after-pages',
		'description'   => esc_html_x( 'Appears below static pages.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Before Footer widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Before Footer', 'gt-office' ),
		'id'            => 'before-footer',
		'description'   => esc_html_x( 'Appears above the footer area.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Footer Column 1 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'gt-office' ),
		'id'            => 'footer-column-1',
		'description'   => esc_html_x( 'Appears in the first column in footer.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 2 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'gt-office' ),
		'id'            => 'footer-column-2',
		'description'   => esc_html_x( 'Appears in the second column in footer.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 3 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'gt-office' ),
		'id'            => 'footer-column-3',
		'description'   => esc_html_x( 'Appears in the third column in footer.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 4 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'gt-office' ),
		'id'            => 'footer-column-4',
		'description'   => esc_html_x( 'Appears in the fourth column in footer.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Copyright widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'gt-office' ),
		'id'            => 'footer-copyright',
		'description'   => esc_html_x( 'Appears in the bottom footer line.', 'widget area description', 'gt-office' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'gt_office_widgets_init' );


/**
 * Include Files
 */

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include Customization Features.
require get_template_directory() . '/inc/custom-colors.php';
require get_template_directory() . '/inc/custom-fonts.php';
