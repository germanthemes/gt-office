<?php
/**
 * License Settings
 *
 * Register License Settings
 *
 * @package GT Office
 */

/**
 * Adds all License settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_office_customize_register_license_settings( $wp_customize ) {

	// Add Section for License.
	$wp_customize->add_section( 'gt_office_section_license', array(
		'title'       => esc_html__( 'License', 'gt-office' ),
		'description' => esc_html__( 'Please enter your license key. An active license key is necessary for automatic theme updates and support.', 'gt-office' ),
		'priority'    => 60,
		'panel'       => 'gt_office_options_panel',
	) );

	// Add Theme Links control.
	$wp_customize->add_control( new GT_Office_Customize_Links_Control(
		$wp_customize, 'gt_office_theme_links', array(
			'section'  => 'gt_office_section_license',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	// Add License Key setting.
	$wp_customize->add_setting( 'gt_office_theme_options[license_key]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new GT_Office_Customize_License_Control(
		$wp_customize, 'license_key', array(
			'label'    => esc_html__( 'License Key', 'gt-office' ),
			'section'  => 'gt_office_section_license',
			'settings' => 'gt_office_theme_options[license_key]',
			'priority' => 20,
		)
	) );
}
add_action( 'customize_register', 'gt_office_customize_register_license_settings' );
