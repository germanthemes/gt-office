<?php
/**
 * License Key
 *
 * @package GT Office
 */

/**
 * License Key Class
 */
class GT_Office_License_Key {
	/**
	 * Actions Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Define Product ID.
		define( 'GT_OFFICE_PRODUCT_ID', 2533 );

		// Define Update API URL.
		define( 'GT_OFFICE_STORE_API_URL', 'https://germanthemes.de' );

		// Add License API functions.
		add_action( 'wp_ajax_gt_activate_license', array( __CLASS__, 'activate_license' ) );
		add_action( 'wp_ajax_gt_deactivate_license', array( __CLASS__, 'deactivate_license' ) );
		add_action( 'admin_init', array( __CLASS__, 'check_license' ) );
	}

	/**
	 * Activate license key
	 *
	 * @return void
	 */
	static function activate_license() {
		if ( ! isset( $_REQUEST['license_key'] ) ) {
			die();
		}

		$license = trim( sanitize_text_field( $_REQUEST['license_key'] ) );

		if ( '' === $license ) {
			die();
		}

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => GT_OFFICE_PRODUCT_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post( GT_OFFICE_STORE_API_URL, array(
			'timeout'   => 25,
			'sslverify' => true,
			'body'      => $api_params,
		) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			echo $response;
			die();
		}

		// Decode the license data.
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// Get theme options from database.
		$theme_options = gt_office_theme_options();

		// Update License Key and Status.
		$theme_options['license_status'] = $license_data->license;
		$theme_options['license_key']    = $license;
		update_option( 'gt_office_theme_options', $theme_options );

		delete_transient( 'gt_office_license_check' );

		echo $license_data->license;

		die();
	}

	/**
	 * Deactivate license key
	 *
	 * @return void
	 */
	static function deactivate_license() {
		if ( ! isset( $_REQUEST['license_key'] ) ) {
			die();
		}

		$license = trim( sanitize_text_field( $_REQUEST['license_key'] ) );

		if ( '' === $license ) {
			die();
		}

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_id'    => GT_OFFICE_PRODUCT_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post( GT_OFFICE_STORE_API_URL, array(
			'timeout'   => 25,
			'sslverify' => true,
			'body'      => $api_params,
		) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			echo $response;
			die();
		}

		// Get theme options from database.
		$theme_options = gt_office_theme_options();

		// Update License Status.
		$theme_options['license_status'] = 'inactive';
		update_option( 'gt_office_theme_options', $theme_options );

		delete_transient( 'gt_office_license_check' );

		echo 'inactive';

		die();
	}

	/**
	 * Check license key
	 *
	 * @return void
	 */
	static function check_license() {

		// Don't fire in Customizer.
		if ( is_customize_preview() ) {
			return;
		}

		$status = get_transient( 'gt_office_license_check' );

		// Run the license check a maximum of once per day.
		if ( false === $status ) {

			// Get theme options from database.
			$theme_options = gt_office_theme_options();
			$license_key   = $theme_options['license_key'];

			if ( '' !== $license_key and 'inactive' !== $theme_options['license_status'] ) {

				// Data to send in our API request.
				$api_params = array(
					'edd_action' => 'check_license',
					'license'    => $license_key,
					'item_id'    => GT_OFFICE_PRODUCT_ID,
					'url'        => home_url(),
				);

				// Call the custom API.
				$response = wp_remote_post( GT_OFFICE_STORE_API_URL, array(
					'timeout'   => 25,
					'sslverify' => true,
					'body'      => $api_params,
				) );

				// Make sure the response came back okay.
				if ( is_wp_error( $response ) ) {
					return false;
				}

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				$status = $license_data->license;

			} else {

				$status = 'inactive';

			}

			// Update License Status.
			$theme_options['license_status'] = $status;
			update_option( 'gt_office_theme_options', $theme_options );

			// Cache license check with transient.
			set_transient( 'gt_office_license_check', $status, DAY_IN_SECONDS );
		}

		return $status;
	}
}

// Run Class.
GT_Office_License_Key::setup();
