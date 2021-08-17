<?php

/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package salient-news
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-inner-title">		
		<header class="entry-header">
			<div class="inner-banner-overlay">
				<?php if (is_singular()){ ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if (! is_page() ){?>
					<header class="entry-header">
						<div class="entry-meta entry-inner">
							<?php salient_news_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
				<?php } } ?>
			</div>
		</header><!-- .entry-header -->		     
	</div>
	<div class="entry-content">
		<?php
		$salient_news_single_post_image_align = salient_news_single_post_image_align(get_the_ID());
		if( 'no-image' != $salient_news_single_post_image_align ){
			if( 'left' == $salient_news_single_post_image_align ){
				echo "<div class='image-left'>";
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $salient_news_single_post_image_align ){
				echo "<div class='image-right'>";
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				the_post_thumbnail('full');
			}
			echo "</div>";/*div end*/
		}
		?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'salient-news' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php salient_news_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

