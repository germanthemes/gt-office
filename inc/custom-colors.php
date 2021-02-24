<?php
/**
 * Custom Colors
 *
 * Generates Custom CSS code for Color Settings
 *
 * @package GT Office
 */

/**
 * Custom Colors Class
 */
class GT_Office_Custom_Colors {

	/**
	 * Actions Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Add Custom Fonts CSS code to frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_custom_colors_in_frontend' ), 11 );

		// Add Custom Fonts CSS code to editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'add_custom_colors_in_editor' ), 11 );
	}

	/**
	 * Add Font Family CSS styles in the head area of the theme.
	 */
	static function add_custom_colors_in_frontend() {
		wp_add_inline_style( 'gt-office-stylesheet', self::get_custom_colors_css() );
	}

	/**
	 * Add Font Family CSS styles in the head area of the Gutenberg editor.
	 */
	static function add_custom_colors_in_editor() {
		wp_add_inline_style( 'gt-office-editor-styles', self::get_custom_colors_css() );
	}

	/**
	 * Generate Color CSS styles to override default colors.
	 *
	 * @return string CSS code
	 */
	static function get_custom_colors_css() {

		// Get theme options from database.
		$theme_options = gt_office_theme_options();

		// Get default colors.
		$default = gt_office_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Primary Color.
		if ( $theme_options['primary_color'] !== $default['primary_color'] ) {
			$color_variables .= '--primary-color: ' . $theme_options['primary_color'] . ';';
		}

		// Set Secondary Color.
		if ( $theme_options['secondary_color'] !== $default['secondary_color'] ) {
			$color_variables .= '--secondary-color: ' . $theme_options['secondary_color'] . ';';
		}

		// Set Accent Color.
		if ( $theme_options['accent_color'] !== $default['accent_color'] ) {
			$color_variables .= '--accent-color: ' . $theme_options['accent_color'] . ';';
		}

		// Set Highlight Color.
		if ( $theme_options['highlight_color'] !== $default['highlight_color'] ) {
			$color_variables .= '--highlight-color: ' . $theme_options['highlight_color'] . ';';
		}

		// Set Light Gray Color.
		if ( $theme_options['light_gray_color'] !== $default['light_gray_color'] ) {
			$color_variables .= '--light-gray-color: ' . $theme_options['light_gray_color'] . ';';
		}

		// Set Gray Color.
		if ( $theme_options['gray_color'] !== $default['gray_color'] ) {
			$color_variables .= '--gray-color: ' . $theme_options['gray_color'] . ';';
		}

		// Set Dark Gray Color.
		if ( $theme_options['dark_gray_color'] !== $default['dark_gray_color'] ) {
			$color_variables .= '--dark-gray-color: ' . $theme_options['dark_gray_color'] . ';';
		}

		// Set Header Bar Color.
		if ( $theme_options['header_bar_color'] !== $default['header_bar_color'] ) {
			$color_variables .= '--header-bar-color: ' . $theme_options['header_bar_color'] . ';';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['header_bar_color'] ) ) {
				$color_variables .= '--header-bar-text-color: #fff;';
				$color_variables .= '--header-bar-border-color: rgba(255, 255, 255, 0.1);';
			}
		}

		// Set Header Bar Hover Color.
		if ( $theme_options['header_bar_hover_color'] !== $default['header_bar_hover_color'] ) {
			$color_variables .= '--header-bar-hover-color: ' . $theme_options['header_bar_hover_color'] . ';';
		}

		// Set Page Background Color.
		if ( $theme_options['page_background_color'] !== $default['page_background_color'] ) {
			$color_variables .= '--page-background-color: ' . $theme_options['page_background_color'] . ';';
			$color_variables .= '--header-color: ' . $theme_options['page_background_color'] . ';';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['page_background_color'] ) ) {
				$color_variables .= '--text-color: #fff;';
				$color_variables .= '--light-text-color: rgba(255, 255, 255, 0.5);';
				$color_variables .= '--medium-text-color: rgba(255, 255, 255, 0.7);';
				$color_variables .= '--page-border-color: rgba(255, 255, 255, 0.1);';
				$color_variables .= '--light-background-color: rgba(255, 255, 255, 0.05);';
				$color_variables .= '--medium-background-color: rgba(255, 255, 255, 0.15);';
				$color_variables .= '--light-border-color : rgba(255, 255, 255, 0.1);';
				$color_variables .= '--medium-border-color: rgba(255, 255, 255, 0.3);';
				$color_variables .= '--header-text-color: #fff;';
				$color_variables .= '--header-border-color: rgba(255, 255, 255, 0.1);';
			}
		}

		// Set Header Hover Color.
		if ( $theme_options['header_hover_color'] !== $default['header_hover_color'] ) {
			$color_variables .= '--header-hover-color: ' . $theme_options['header_hover_color'] . ';';
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default['title_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['title_color'] . ';';
			$color_variables .= '--site-title-color: ' . $theme_options['title_color'] . ';';
			$color_variables .= '--widget-title-color: ' . $theme_options['title_color'] . ';';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default['title_hover_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['title_hover_color'] . ';';
			$color_variables .= '--site-title-hover-color: ' . $theme_options['title_hover_color'] . ';';
			$color_variables .= '--widget-title-hover-color: ' . $theme_options['title_hover_color'] . ';';
		}

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default['link_color'] ) {
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
		}

		// Set Link Hover Color.
		if ( $theme_options['link_hover_color'] !== $default['link_hover_color'] ) {
			$color_variables .= '--link-hover-color: ' . $theme_options['link_hover_color'] . ';';
		}

		// Set Button Color.
		if ( $theme_options['button_color'] !== $default['button_color'] ) {
			$color_variables .= '--button-color: ' . $theme_options['button_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['button_color'] ) ) {
				$color_variables .= '--button-text-color: rgba(0, 0, 0, 0.95);';
			}
		}

		// Set Button Hover Color.
		if ( $theme_options['button_hover_color'] !== $default['button_hover_color'] ) {
			$color_variables .= '--button-hover-color: ' . $theme_options['button_hover_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['button_hover_color'] ) ) {
				$color_variables .= '--button-text-hover-color: rgba(0, 0, 0, 0.95);';
			}
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] !== $default['footer_color'] ) {
			$color_variables .= '--footer-background-color: ' . $theme_options['footer_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$color_variables .= '--footer-text-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--footer-link-color: rgba(0, 0, 0, 0.95);';
				$color_variables .= '--footer-link-hover-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--footer-border-color: rgba(0, 0, 0, 0.1);';
			}
		}

		// Return if no color variables were defined.
		if ( '' === $color_variables ) {
			return;
		}

		// Sanitize CSS Code.
		$custom_css = ':root {' . $color_variables . '}';
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
GT_Office_Custom_Colors::setup();
