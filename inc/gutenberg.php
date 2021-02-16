<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package GT Office
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function gt_office_gutenberg_support() {

	// Get theme options from database.
	$theme_options = gt_office_theme_options();

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'gt_office_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'gt-office' ),
			'slug'  => 'primary',
			'color' => esc_html( $theme_options['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'gt-office' ),
			'slug'  => 'secondary',
			'color' => esc_html( $theme_options['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'gt-office' ),
			'slug'  => 'accent',
			'color' => esc_html( $theme_options['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'gt-office' ),
			'slug'  => 'highlight',
			'color' => esc_html( $theme_options['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'gt-office' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'gt-office' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $theme_options['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'gt-office' ),
			'slug'  => 'gray',
			'color' => esc_html( $theme_options['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'gt-office' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $theme_options['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'gt-office' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Add theme support for font sizes.
	add_theme_support( 'editor-font-sizes', apply_filters( 'gt_office_editor_font_sizes_args', array(
		array(
			'name' => esc_html_x( 'Small', 'block font size', 'gt-office' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => esc_html_x( 'Medium', 'block font size', 'gt-office' ),
			'size' => 22,
			'slug' => 'medium',
		),
		array(
			'name' => esc_html_x( 'Large', 'block font size', 'gt-office' ),
			'size' => 28,
			'slug' => 'large',
		),
		array(
			'name' => esc_html_x( 'Extra Large', 'block font size', 'gt-office' ),
			'size' => 36,
			'slug' => 'extra-large',
		),
		array(
			'name' => esc_html_x( 'Huge', 'block font size', 'gt-office' ),
			'size' => 48,
			'slug' => 'huge',
		),
	) ) );

	// Register Small Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-small',
		'label'        => esc_html__( 'GT Small', 'gt-office' ),
		'style_handle' => 'gt-office-stylesheet',
	) );

	// Register Large Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-large',
		'label'        => esc_html__( 'GT Large', 'gt-office' ),
		'style_handle' => 'gt-office-stylesheet',
	) );

	// Check if block pattern functions are available.
	if ( function_exists( 'register_block_pattern' ) && function_exists( 'register_block_pattern_category' ) ) {

		// Remove Core Patterns.
		remove_theme_support( 'core-block-patterns' );

		// Register GT Office block pattern category.
		register_block_pattern_category( 'gt-office', array( 'label' => esc_html__( 'GT Office', 'gt-office' ) ) );

		// Register Block patterns.
		register_block_pattern( 'gt-office/hero-left', array(
			'title'      => esc_html__( 'Hero Left', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"full\",\"gtRemoveMarginBottom\":true} --><div class=\"wp-block-columns alignfull are-vertically-aligned-center gt-remove-margin-bottom\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":30} --><div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:30%\"><!-- wp:group {\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-group has-light-gray-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":1} --><h1>Shape the future of tomorrow</h1><!-- /wp:heading --><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo  ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\",\"gtRemoveMarginBottom\":true} --><div class=\"wp-block-column is-vertically-aligned-center gt-remove-margin-bottom\"><!-- wp:image {\"gtRemoveMarginBottom\":true} --><figure class=\"wp-block-image gt-remove-margin-bottom\"><img alt=\"\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/hero-right', array(
			'title'      => esc_html__( 'Hero Right', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"full\",\"gtRemoveMarginBottom\":true} --><div class=\"wp-block-columns alignfull are-vertically-aligned-center gt-remove-margin-bottom\"><!-- wp:column {\"verticalAlignment\":\"center\",\"gtRemoveMarginBottom\":true} --><div class=\"wp-block-column is-vertically-aligned-center gt-remove-margin-bottom\"><!-- wp:image {\"gtRemoveMarginBottom\":true} --><figure class=\"wp-block-image gt-remove-margin-bottom\"><img alt=\"\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":30} --><div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:30%\"><!-- wp:group {\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-group has-light-gray-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":1} --><h1>Find your own unique style</h1><!-- /wp:heading --><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo  ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/features', array(
			'title'      => esc_html__( 'Features', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-group alignfull has-light-gray-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:spacer {\"height\":50} --><div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:heading {\"align\":\"center\",\"fontSize\":\"extra-large\"} --><h2 class=\"has-text-align-center has-extra-large-font-size\">Why choose us?</h2><!-- /wp:heading --><!-- wp:spacer {\"height\":50} --><div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide are-vertically-aligned-center\"><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">1 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">2 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">3 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide are-vertically-aligned-center\"><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">4 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">5 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"verticalAlignment\":\"center\"} --><div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"dropCap\":true} --><p class=\"has-drop-cap\">6 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:spacer {\"height\":50} --><div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/portfolio-grid', array(
			'title'      => esc_html__( 'Portfolio Grid', 'gt-office' ),
			'content'    => "<!-- wp:group --><div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 1</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 2</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 3</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 4</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 5</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>Style 6</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/portfolio-list', array(
			'title'      => esc_html__( 'Portfolio List', 'gt-office' ),
			'content'    => "<!-- wp:group --><div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text {\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile has-light-gray-background-color has-background\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:media-text {\"mediaPosition\":\"right\",\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile has-light-gray-background-color has-background\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:media-text {\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile has-light-gray-background-color has-background\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:media-text {\"mediaPosition\":\"right\",\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile has-light-gray-background-color has-background\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:paragraph {\"fontSize\":\"medium\"} --><p class=\"has-medium-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/portfolio-gallery', array(
			'title'      => esc_html__( 'Portfolio Gallery', 'gt-office' ),
			'content'    => "<!-- wp:group --><div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":33.33} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:heading --><h2>Style 1</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"width\":66.66} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:gallery --><figure class=\"wp-block-gallery columns-0 is-cropped\"><ul class=\"blocks-gallery-grid\"></ul></figure><!-- /wp:gallery --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":33.33} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:heading --><h2>Style 2</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {\"width\":66.66} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:gallery --><figure class=\"wp-block-gallery columns-0 is-cropped\"><ul class=\"blocks-gallery-grid\"></ul></figure><!-- /wp:gallery --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/services-list', array(
			'title'      => esc_html__( 'Services List', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 1</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:spacer --><div style=\"height:100px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:media-text {\"mediaPosition\":\"right\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 2</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --><!-- wp:spacer --><div style=\"height:100px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 3</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/services-about', array(
			'title'      => esc_html__( 'Services / About', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":30} --><div class=\"wp-block-column\" style=\"flex-basis:30%\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading --><h2>About me</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:separator {\"className\":\"is-style-wide\"} --><hr class=\"wp-block-separator is-style-wide\"/><!-- /wp:separator --><!-- wp:paragraph {\"fontSize\":\"large\"} --><p class=\"has-large-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --><!-- wp:separator {\"className\":\"is-style-wide\"} --><hr class=\"wp-block-separator is-style-wide\"/><!-- /wp:separator --><!-- wp:spacer {\"height\":30} --><div style=\"height:30px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:heading {\"level\":3} --><h3>Service 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 3</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/services-columns', array(
			'title'      => esc_html__( 'Services Columns', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":20} --><div class=\"wp-block-column\" style=\"flex-basis:20%\"><!-- wp:heading --><h2>Services</h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:heading {\"level\":3} --><h3>Service 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 3</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:heading {\"level\":3} --><h3>Service 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Service 4</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );

		register_block_pattern( 'gt-office/projects', array(
			'title'      => esc_html__( 'Projects', 'gt-office' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":20} --><div class=\"wp-block-column\" style=\"flex-basis:20%\"><!-- wp:heading --><h2>Projects</h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-office' ),
		) );
	}
}
add_action( 'after_setup_theme', 'gt_office_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function gt_office_block_editor_assets() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Editor Styling.
	wp_enqueue_style( 'gt-office-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), $theme_version, 'all' );

	// Enqueue Theme Settings Editor plugin.
	wp_enqueue_script( 'gt-office-editor-theme-settings', get_theme_file_uri( '/assets/js/editor-theme-settings.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), $theme_version );
}
add_action( 'enqueue_block_editor_assets', 'gt_office_block_editor_assets' );


/**
 * Add body classes in Gutenberg Editor.
 */
function gt_office_gutenberg_add_admin_body_class( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' gt-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' gt-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' gt-fullwidth-page-layout gt-page-title-hidden ';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'gt_office_gutenberg_add_admin_body_class' );
