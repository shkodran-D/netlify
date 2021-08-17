<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

get_header(); ?>

<?php 
if ( is_active_sidebar( 'slider' ) ) {
	 dynamic_sidebar( 'slider' );
}
?>

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
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) : ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>

        <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) : the_post();
        
            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'template-parts/content', get_post_format() );

        endwhile;

        the_posts_pagination( array(
					'format' => '/page/%#%',
					'type' => 'list',
					'mid_size' => 2,
					'prev_text' => esc_html__( 'Previous', 'newsmagbd' ),
					'next_text' => esc_html__( 'Next', 'newsmagbd' ),
					'screen_reader_text' => esc_html__( '&nbsp;', 'newsmagbd' ),
				) );

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif; ?>
    
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
