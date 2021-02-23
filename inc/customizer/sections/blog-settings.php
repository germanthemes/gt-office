<?php
/**
 * Blog Settings
 *
 * @package GT Office
 */

/**
 * Add Blog settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_office_customize_register_blog_settings( $wp_customize ) {

	// Add Section for Blog Settings.
	$wp_customize->add_section( 'gt_office_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'gt-office' ),
		'priority' => 20,
		'panel'    => 'gt_office_options_panel',
	) );

	// Get Default Settings.
	$default = gt_office_default_options();

	// Add Settings and Controls for blog content.
	$wp_customize->add_setting( 'gt_office_theme_options[blog_content]', array(
		'default'           => $default['blog_content'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_select',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[blog_content]', array(
		'label'    => esc_html__( 'Blog Content', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[blog_content]',
		'type'     => 'radio',
		'priority' => 10,
		'choices'  => array(
			'full'    => esc_html__( 'Full post', 'gt-office' ),
			'excerpt' => esc_html__( 'Post excerpt', 'gt-office' ),
		),
	) );

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'gt_office_theme_options[excerpt_length]', array(
		'default'           => $default['excerpt_length'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[excerpt_length]', array(
		'label'    => esc_html__( 'Excerpt Length', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[excerpt_length]',
		'type'     => 'number',
		'priority' => 20,
	) );

	// Add Setting and Control for Number of posts.
	$wp_customize->add_setting( 'posts_per_page', array(
		'default'           => absint( get_option( 'posts_per_page' ) ),
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'gt_office_posts_per_page_setting', array(
		'label'    => esc_html__( 'Number of Posts', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'posts_per_page',
		'type'     => 'number',
		'priority' => 30,
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new GT_Office_Customize_Header_Control(
		$wp_customize, 'gt_office_theme_options[featured_images]', array(
			'label'    => esc_html__( 'Featured Images', 'gt-office' ),
			'section'  => 'gt_office_section_blog',
			'settings' => array(),
			'priority' => 40,
		)
	) );

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting( 'gt_office_theme_options[post_image_archives]', array(
		'default'           => $default['post_image_archives'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[post_image_archives]', array(
		'label'    => esc_html__( 'Display images on blog and archives', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 50,
	) );

	// Add Partial for Number of Posts setting.
	$wp_customize->selective_refresh->add_partial( 'gt_office_blog_partial', array(
		'selector'         => '.is-blog-page .site-content .site-main',
		'selector'         => array(
			'.blog .site-content .site-main',
			'.archive .site-content .site-main',
		),
		'settings'         => array(
			'gt_office_theme_options[blog_content]',
			'gt_office_theme_options[excerpt_length]',
			'posts_per_page',
			'gt_office_theme_options[post_image_archives]',
		),
		'render_callback'  => 'gt_office_customize_blog_partial',
		'fallback_refresh' => false,
	) );

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting( 'gt_office_theme_options[post_image_single]', array(
		'default'           => $default['post_image_single'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display images on single posts', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 60,
	) );

	$wp_customize->selective_refresh->add_partial( 'gt_office_theme_options[post_image_single]', array(
		'selector'         => '.single-post .site-main',
		'render_callback'  => 'gt_office_customize_partial_single_post',
		'fallback_refresh' => false,
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new GT_Office_Customize_Header_Control(
		$wp_customize, 'gt_office_theme_options[post_details]', array(
			'label'    => esc_html__( 'Post Details', 'gt-office' ),
			'section'  => 'gt_office_section_blog',
			'settings' => array(),
			'priority' => 70,
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'gt_office_theme_options[meta_date]', array(
		'default'           => $default['meta_date'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display date', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 80,
	) );

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting( 'gt_office_theme_options[meta_author]', array(
		'default'           => $default['meta_author'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display author', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 90,
	) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'gt_office_theme_options[meta_categories]', array(
		'default'           => $default['meta_categories'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[meta_categories]', array(
		'label'    => esc_html__( 'Display categories', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[meta_categories]',
		'type'     => 'checkbox',
		'priority' => 100,
	) );

	// Add Single Post Headline.
	$wp_customize->add_control( new GT_Office_Customize_Header_Control(
		$wp_customize, 'gt_office_theme_options[single_post]', array(
			'label'    => esc_html__( 'Single Post', 'gt-office' ),
			'section'  => 'gt_office_section_blog',
			'settings' => array(),
			'priority' => 110,
		)
	) );

	// Add Setting and Control for showing post comments.
	$wp_customize->add_setting( 'gt_office_theme_options[meta_comments]', array(
		'default'           => $default['meta_comments'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[meta_comments]', array(
		'label'    => esc_html__( 'Display comments', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[meta_comments]',
		'type'     => 'checkbox',
		'priority' => 100,
	) );

	// Add Single Post Headline.
	$wp_customize->add_control( new GT_Office_Customize_Header_Control(
		$wp_customize, 'gt_office_theme_options[single_post]', array(
			'label'    => esc_html__( 'Single Post', 'gt-office' ),
			'section'  => 'gt_office_section_blog',
			'settings' => array(),
			'priority' => 120,
		)
	) );

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'gt_office_theme_options[meta_tags]', array(
		'default'           => $default['meta_tags'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display tags', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 130,
	) );

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'gt_office_theme_options[post_navigation]', array(
		'default'           => $default['post_navigation'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'gt_office_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'gt_office_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'gt-office' ),
		'section'  => 'gt_office_section_blog',
		'settings' => 'gt_office_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 140,
	) );
}
add_action( 'customize_register', 'gt_office_customize_register_blog_settings' );


/**
 * Render the blog layout for the selective refresh partial.
 */
function gt_office_customize_blog_partial() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', esc_attr( gt_office_get_option( 'blog_content' ) ) );
	}

	gt_office_pagination();
}


/**
 * Render single posts partial
 */
function gt_office_customize_partial_single_post() {
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
}
