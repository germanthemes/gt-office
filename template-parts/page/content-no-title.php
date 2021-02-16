<?php
/**
 * The template used for displaying page content without a page title.
 *
 * @version 1.0
 * @package GT Office
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php wp_link_pages(); ?>

	</div><!-- .entry-content -->

	<?php gt_office_widget_area( 'after-pages' ); ?>
	<?php do_action( 'gt_office_after_pages' ); ?>

</article>
