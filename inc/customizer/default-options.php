<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package GT Office
 */

/**
* Get a single theme option
*
* @return mixed
*/
function gt_office_get_option( $option_name = '' ) {

	// Get all Theme Options from Database.
	$theme_options = gt_office_theme_options();

	// Return single option.
	if ( isset( $theme_options[ $option_name ] ) ) {
		return $theme_options[ $option_name ];
	}

	return false;
}


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function gt_office_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'gt_office_theme_options', array() ), gt_office_default_options() );

	// Return theme options.
	return apply_filters( 'gt_office_theme_options', $theme_options );
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function gt_office_default_options() {

	$default_options = array(
		'retina_logo'        => false,
		'site_title'         => true,
		'site_description'   => true,
		'header_phone'       => '0123-456789',
		'header_email'       => 'email@domain.com',
		'header_address'     => '',
		'header_search'      => false,
		'scroll_to_top'      => false,
		'meta_date'          => true,
		'meta_author'        => true,
		'meta_categories'    => true,
		'meta_tags'          => false,
		'primary_color'      => '#0890d0',
		'secondary_color'    => '#0068a0',
		'accent_color'       => '#00b0f8',
		'highlight_color'    => '#f33e3e',
		'light_gray_color'   => '#ebebeb',
		'gray_color'         => '#606060',
		'dark_gray_color'    => '#202020',
		'header_color'       => '#202020',
		'header_text_color'  => '#ffffff',
		'header_hover_color' => '#909090',
		'title_color'        => '#202020',
		'title_hover_color'  => '#606060',
		'link_color'         => '#0890d0',
		'link_hover_color'   => '#0068a0',
		'button_color'       => '#202020',
		'button_hover_color' => '#606060',
		'footer_color'       => '#202020',
		'text_font'          => 'Barlow',
		'title_font'         => 'Barlow',
		'title_is_bold'      => true,
		'title_is_uppercase' => false,
		'navi_font'          => 'Barlow',
		'navi_is_bold'       => false,
		'navi_is_uppercase'  => false,
		'license_key'        => '',
		'license_status'     => 'inactive',
	);

	return apply_filters( 'gt_office_default_options', $default_options );
}
