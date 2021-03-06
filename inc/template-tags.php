<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package GT Office
 */

if ( ! function_exists( 'gt_office_site_logo' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function gt_office_site_logo() {

		if ( has_custom_logo() ) : ?>

			<div class="site-logo">
				<?php the_custom_logo(); ?>
			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function gt_office_site_title() {

		if ( is_home() ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function gt_office_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) :
			?>

			<p class="site-description"><?php echo $description; ?></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function gt_office_header_image() {

		// Display featured image as header image on single pages.
		if ( is_page() && has_post_thumbnail() ) :
			?>

			<div id="headimg" class="header-image featured-header-image">

				<?php the_post_thumbnail( 'gt-office-header-image' ); ?>

			</div>

			<?php
		elseif ( has_header_image() ) : // Display header image.
			?>

			<div id="headimg" class="header-image default-header-image">

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_header_search_icon' ) ) :
	/**
	 * Add search icon to navigation menu
	 *
	 * @return void
	 */
	function gt_office_header_search_icon() {

		// Show header search icon if activated.
		if ( true === gt_office_get_option( 'header_search' ) || is_customize_preview() ) :
			?>

			<div class="header-search-button">

				<button class="header-search-icon" aria-controls="header-search" aria-expanded="false">
					<?php echo gt_office_get_svg( 'search' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'gt-office' ); ?></span>
				</button>

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_header_search_form' ) ) :
	/**
	 * Displays search form in header area
	 *
	 * @return void
	 */
	function gt_office_header_search_form() {

		// Show header search form if activated.
		if ( true === gt_office_get_option( 'header_search' ) || is_customize_preview() ) :
			?>

			<div class="header-search-dropdown">
				<div class="header-search-main">
					<div class="header-search-form">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_social_icons_menu' ) ) :
	/**
	 * Displays social icons menu
	 *
	 * @return void
	 */
	function gt_office_social_icons_menu( $menu ) {
		wp_nav_menu( array(
			'theme_location' => $menu,
			'container'      => false,
			'menu_class'     => $menu . '-menu social-icons-menu',
			'echo'           => true,
			'fallback_cb'    => '',
			'link_before'    => '<span class = "screen-reader-text">',
			'link_after'     => '</span>',
			'depth'          => 1,
		) );
	}
endif;


if ( ! function_exists( 'gt_office_archive_header' ) ) :
	/**
	 * Displays the header title on archive pages.
	 */
	function gt_office_archive_header() {
		?>

		<header class="archive-header entry-header">

			<?php the_archive_title( '<h1 class="archive-title entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</header><!-- .archive-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_office_search_header' ) ) :
	/**
	 * Displays the header title on search results.
	 */
	function gt_office_search_header() {
		?>

		<header class="search-header entry-header">

			<h1 class="search-title entry-title">
				<?php
				// translators: Search Results title.
				printf( esc_html__( 'Search Results for: %s', 'gt-office' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
			<?php get_search_form(); ?>

		</header><!-- .search-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_office_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function gt_office_post_image_archives( $image_size = 'post-thumbnail' ) {

		// Display Post Thumbnail if activated.
		if ( has_post_thumbnail() && true === gt_office_get_option( 'post_image_archives' ) ) :
			?>

			<figure class="post-image post-image-archives">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark" aria-hidden="true">
					<?php the_post_thumbnail( $image_size ); ?>
				</a>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts.
	 */
	function gt_office_post_image_single( $image_size = 'post-thumbnail' ) {

		// Display Post Thumbnail if activated.
		if ( has_post_thumbnail() && true === gt_office_get_option( 'post_image_single' ) ) :
			?>

			<figure class="post-image post-image-single">
				<?php the_post_thumbnail( $image_size ); ?>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_entry_meta' ) ) :
	/**
	 * Displays the date and author of a post
	 */
	function gt_office_entry_meta() {

		$postmeta  = gt_office_entry_author();
		$postmeta .= gt_office_entry_date();
		$postmeta .= gt_office_entry_categories();
		$postmeta .= gt_office_entry_comments();

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'gt_office_entry_date' ) ) :
	/**
	 * Returns the post date
	 */
	function gt_office_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		return '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;


if ( ! function_exists( 'gt_office_entry_author' ) ) :
	/**
	 * Returns the post author
	 */
	function gt_office_entry_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			// translators: post author link.
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'gt-office' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		$posted_by = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'gt-office' ),
			$author_string
		);

		return '<span class="posted-by"> ' . $posted_by . '</span>';
	}
endif;


if ( ! function_exists( 'gt_office_entry_categories' ) ) :
	/**
	 * Displays the post categories
	 */
	function gt_office_entry_categories() {

		// Return early if post has no category.
		if ( ! has_category() ) {
			return;
		}

		$categories = get_the_category_list( ', ' );

		return '<span class="posted-in"> ' . $categories . '</span>';
	}
endif;


if ( ! function_exists( 'gt_office_entry_comments' ) ) :
	/**
	 * Displays the post comments
	 */
	function gt_office_entry_comments() {

		// Check if comments are open or we have at least one comment.
		if ( ! ( comments_open() || get_comments_number() ) ) {
			return;
		}

		// Start Output Buffering.
		ob_start();

		// Display Comments.
		comments_popup_link(
			esc_html__( 'No comments', 'gt-office' ),
			esc_html__( '1 comment', 'gt-office' ),
			esc_html__( '% comments', 'gt-office' )
		);
		$comments = ob_get_contents();

		// End Output Buffering.
		ob_end_clean();

		return '<span class="entry-comments"> ' . $comments . '</span>';
	}
endif;


if ( ! function_exists( 'gt_office_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function gt_office_entry_tags() {
		// Get tags.
		$tag_list = get_the_tag_list( esc_html__( 'Tags: ', 'gt-office' ), ', ' );

		// Display tags.
		if ( $tag_list ) :
			echo '<p class="entry-tags">' . $tag_list . '</p>';
		endif;
	}
endif;


if ( ! function_exists( 'gt_office_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function gt_office_more_link() {
		?>

		<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Continue reading', 'gt-office' ); ?></a>

		<?php
	}
endif;


if ( ! function_exists( 'gt_office_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function gt_office_post_navigation() {

		if ( true === gt_office_get_option( 'post_navigation' ) || is_customize_preview() ) :

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'gt-office' ) . '</span><h3 class="entry-title">%title</h3>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'gt-office' ) . '</span><h3 class="entry-title">%title</h3>',
			) );

		endif;
	}
endif;


if ( ! function_exists( 'gt_office_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function gt_office_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'gt-office' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'gt-office' ) . '</span>&raquo;',
		) );
	}
endif;


if ( ! function_exists( 'gt_office_widget_area' ) ) :
	/**
	 * Display Widget Area
	 */
	function gt_office_widget_area( $area, $class = '' ) {
		if ( is_active_sidebar( $area ) ) :
			?>

			<div class="<?php echo esc_attr( $area . '-widgets ' . $class . ' widget-area' ); ?>">
				<?php dynamic_sidebar( $area ); ?>
			</div>

			<?php
		endif;
	}
endif;
