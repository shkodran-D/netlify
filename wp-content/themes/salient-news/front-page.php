<?php
/**
 * The template for displaying home page.
 * @package salient-news
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    }
else{
	/**
	 * salient-news_action_front_page hook
	 * @since salient-news 1.0.0
	 *
	 * @hooked salient-news_action_front_page -  10
	 * @sub_hooked salient-news_action_front_page -  30
	 */
	do_action( 'salient_news_action_front_page' );	
	$salient_news_static_page = absint($salient_news_customizer_all_values['salient-news-enable-static-page']);
	if ($salient_news_static_page == 1) { ?>
		<div id="content" class=" container site-content ">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php
				get_sidebar();
			?>
		</div>
	<?php }
}
get_footer();