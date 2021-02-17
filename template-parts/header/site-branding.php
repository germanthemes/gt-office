<?php
/**
 * Header Main
 *
 * @version 1.0
 * @package GT Office
 */
?>

<div class="site-branding">

	<?php gt_office_site_logo(); ?>

	<div class="site-info">

		<?php gt_office_site_title(); ?>
		<?php gt_office_site_description(); ?>

	</div>

	<?php
	// Check if there is a social icons menu.
	if ( has_nav_menu( 'social-header' ) ) :
		?>

		<div class="header-social-icons social-icons-nav">

			<?php gt_office_social_icons_menu( 'social-header' ); ?>

		</div>

		<?php
	endif;
	?>

</div><!-- .site-branding -->
