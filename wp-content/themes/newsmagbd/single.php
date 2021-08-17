<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NewsMagbd
 */

get_header(); ?>

	<?php
    /**
    * Hook - newsmagbd_blog_content_start_container.
    *
    * @hooked newsmagbd_blog_content_before_wrp - 10
    * @hooked newsmagbd_blog_before_loop_wrp - 20
    */
	do_action('newsmagbd_blog_content_start_container');
    ?>	
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single/content', get_post_type() );

			do_action('newsmagbd_single_post_navigation');

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	<?php
	/**
	* Hook - newsmagbd_blog_content_end_container.
	*
	* @hooked newsmagbd_blog_end_loop_wrp - 10
	* @hooked newsmagbd_blog_content_sidebar - 20
	* @hooked newsmagbd_blog_content_end_wrp - 30
	*/
	do_action('newsmagbd_blog_content_end_container');
    ?>		

<?php

get_footer();
