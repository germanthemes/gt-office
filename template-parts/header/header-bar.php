<?php
/**
 * Top Header Bar
 *
 * @version 1.0
 * @package GT Office
 */
?>

<?php
if ( has_nav_menu( 'secondary' ) or
	'' !== gt_office_get_option( 'header_phone' ) or
	'' !== gt_office_get_option( 'header_email' ) or
	'' !== gt_office_get_option( 'header_address' ) or
	is_customize_preview()
) :
	?>

	<div id="header-bar" class="header-bar">

		<div class="header-bar-main">

			<div class="header-bar-content">

				<?php if ( '' !== gt_office_get_option( 'header_phone' ) || is_customize_preview() ) : ?>

					<div class="header-phone">
						<?php echo gt_office_get_svg( 'phone' ); ?>
						<span class="header-phone-text"><?php echo wp_kses_post( gt_office_get_option( 'header_phone' ) ); ?>
					</div>

				<?php endif; ?>

				<?php if ( '' !== gt_office_get_option( 'header_email' ) || is_customize_preview() ) : ?>

					<div class="header-email">
						<?php echo gt_office_get_svg( 'mail' ); ?>
						<span class="header-email-text"><?php echo wp_kses_post( gt_office_get_option( 'header_email' ) ); ?>
					</div>

				<?php endif; ?>

				<?php if ( '' !== gt_office_get_option( 'header_address' ) || is_customize_preview() ) : ?>

					<div class="header-address">
						<?php echo gt_office_get_svg( 'location' ); ?>
						<span class="header-address-text"><?php echo wp_kses_post( gt_office_get_option( 'header_address' ) ); ?>
					</div>

				<?php endif; ?>

			</div>

			<?php if ( has_nav_menu( 'secondary' ) ) : ?>

				<button class="secondary-menu-toggle menu-toggle" aria-controls="secondary-menu" aria-expanded="false">
					<?php
					echo gt_office_get_svg( 'ellipsis' );
					echo gt_office_get_svg( 'close' );
					?>
					<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'gt-office' ); ?></span>
				</button>

				<div class="secondary-navigation">

					<nav class="top-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'gt-office' ); ?>">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'secondary-menu',
								'container'      => false,
							)
						);
						?>
					</nav><!-- .top-navigation -->

				</div><!-- .secondary-navigation -->

			<?php endif; ?>

		</div>

	</div><!-- .header-bar -->

<?php endif; ?>
