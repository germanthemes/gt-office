<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @version 1.0
 * @package GT Office
 */

get_header();

if ( have_posts() ) :

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content', esc_attr( gt_office_get_option( 'blog_content' ) ) );

	endwhile;

	gt_office_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();
