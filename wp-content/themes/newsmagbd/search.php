<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
   
        <div class="home-posts-head"><h4 class="home-posts-cat-title"><span class="cat-1">
      	 <?php echo esc_html__( 'Search Results for: ', 'newsmagbd' ). get_search_query();?>
          </span></h4>
        </div>   
  	  <?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
