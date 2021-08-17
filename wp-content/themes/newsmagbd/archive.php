<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
    <div class="col-md-12 ">	
    <?php
    do_action('newsmagbd_breadcrumb');
    ?></div>

	<div class="col-md-12">
        <div class="home-posts-head">
    
      	  <?php the_archive_title( '<h4 class="home-posts-cat-title"><span class="cat-1">', '</span></h4>' ); ?>
        </div>   
    </div>
    <?php the_archive_description( '<div class="col-md-12"><div class="archive-description crumb inner-page-crumb">', '</div></div>' ); ?>
    
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
