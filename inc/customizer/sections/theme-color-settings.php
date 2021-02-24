<?php
/**
 * Theme Color Settings
 *
 * @package GT Office
 */

/**
 * Adds all Theme Color settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_office_customize_register_theme_color_settings( $wp_customize ) {

	// Add Section for Theme Colors.
	$wp_customize->add_section( 'gt_office_section_theme_colors', array(
		'title'    => esc_html__( 'Theme Colors', 'gt-office' ),
		'priority' => 40,
		'panel'    => 'gt_office_options_panel',
	) );

	// Get Default Colors from settings.
	$default = gt_office_default_options();

	// Add Header Bar Background Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[header_bar_color]', array(
		'default'           => $default['header_bar_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[header_bar_color]', array(
			'label'    => esc_html_x( 'Header Bar Background', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[header_bar_color]',
			'priority' => 10,
		)
	) );

	// Add Header Bar Hover Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[header_bar_hover_color]', array(
		'default'           => $default['header_bar_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[header_bar_hover_color]', array(
			'label'    => esc_html_x( 'Header Bar Hover', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[header_bar_hover_color]',
			'priority' => 20,
		)
	) );

	// Add Page Background Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[page_background_color]', array(
		'default'           => $default['page_background_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[page_background_color]', array(
			'label'    => esc_html_x( 'Page Background', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[page_background_color]',
			'priority' => 30,
		)
	) );

	// Add Header Bar Hover Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[header_hover_color]', array(
		'default'           => $default['header_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[header_hover_color]', array(
			'label'    => esc_html_x( 'Header Link Hover', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[header_hover_color]',
			'priority' => 40,
		)
	) );

	// Add Titles Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[title_color]', array(
		'default'           => $default['title_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[title_color]', array(
			'label'    => esc_html_x( 'Titles', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[title_color]',
			'priority' => 50,
		)
	) );

	// Add Title Hover Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[title_hover_color]', array(
		'default'           => $default['title_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[title_hover_color]', array(
			'label'    => esc_html_x( 'Title Hover', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[title_hover_color]',
			'priority' => 60,
		)
	) );

	// Add Link Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[link_color]', array(
		'default'           => $default['link_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[link_color]', array(
			'label'    => esc_html_x( 'Links', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[link_color]',
			'priority' => 70,
		)
	) );

	// Add Link Hover Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[link_hover_color]', array(
		'default'           => $default['link_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[link_hover_color]', array(
			'label'    => esc_html_x( 'Link Hover', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[link_hover_color]',
			'priority' => 80,
		)
	) );

	// Add Button Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[button_color]', array(
		'default'           => $default['button_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[button_color]', array(
			'label'    => esc_html_x( 'Buttons', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[button_color]',
			'priority' => 90,
		)
	) );

	// Add Button Hover Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[button_hover_color]', array(
		'default'           => $default['button_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[button_hover_color]', array(
			'label'    => esc_html_x( 'Button Hover', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[button_hover_color]',
			'priority' => 100,
		)
	) );

	// Add Footer Color setting.
	$wp_customize->add_setting( 'gt_office_theme_options[footer_color]', array(
		'default'           => $default['footer_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_office_theme_options[footer_color]', array(
			'label'    => esc_html_x( 'Footer', 'Color Option', 'gt-office' ),
			'section'  => 'gt_office_section_theme_colors',
			'settings' => 'gt_office_theme_options[footer_color]',
			'priority' => 110,
		)
	) );
}
add_action( 'customize_register', 'gt_office_customize_register_theme_color_settings' );
