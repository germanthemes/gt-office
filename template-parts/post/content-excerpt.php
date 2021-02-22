<?php
/**
 * The template for displaying articles in the loop with post excerpt
 *
 * @version 1.0
 * @package GT Office
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header entry-header">

		<?php gt_office_post_image_archives(); ?>

		<?php the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php gt_office_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content entry-excerpt">

		<?php the_excerpt(); ?>
		<?php gt_office_more_link(); ?>

	</div><!-- .entry-content -->

</article>
