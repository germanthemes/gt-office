<?php
/**
 * The template for displaying single posts
 *
 * @version 1.0
 * @package GT Office
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header entry-header">

		<?php gt_office_post_image_single(); ?>

		<?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>

		<?php gt_office_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		<?php gt_office_entry_tags(); ?>

	</div><!-- .entry-content -->

	<?php gt_office_post_navigation(); ?>
	<?php gt_office_widget_area( 'after-posts' ); ?>
	<?php do_action( 'gt_office_after_posts' ); ?>

</article>
