<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package GT Office
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class GT_Office_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'gt-office' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/themes/gt-office/', 'gt-office' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=gt-office&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'gt-office' ); ?>
					</a>
				</p>

				<p>
					<a href="https://demo.germanthemes.de/?demo=gt-office&utm_source=customizer&utm_campaign=gt-office" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'gt-office' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/docs/gt-office-documentation/', 'gt-office' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=gt-office&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'gt-office' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/gt-office/reviews/', 'gt-office' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'gt-office' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
