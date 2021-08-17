<?php

/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package salient-news
 */

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
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
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'salient-news' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'salient-news' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</article><!-- #post-## -->
