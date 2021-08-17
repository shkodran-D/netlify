<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

get_header(); ?>

	<?php
	/**
	* Hook - newsmagbd_page_content_start_container.
	*
	* @hooked newsmagbd_page_content_before_wrp - 10
	* @hooked newsmagbd_page_start_loop_wrp - 20
	*/
	do_action('newsmagbd_page_content_start_container');
    ?>
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

	<?php
	/**
	* Hook - newsmagbd_page_content_end_container.
	*
	* @hooked newsmagbd_page_end_loop_wrp - 10
	* @hooked newsmagbd_page_content_sidebar - 20
	* @hooked newsmagbd_page_content_end_wrp - 30
	*/
	do_action('newsmagbd_page_content_end_container');
    ?>		
<?php

get_footer();
