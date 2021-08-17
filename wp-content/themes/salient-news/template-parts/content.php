<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package salient-news
 */

global $salient_news_customizer_all_values;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <div class="wrapper-grid">
	<header class="entry-header">
		<?php
		if ( is_single() ) {
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php salient_news_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$salient_news_archive_layout = $salient_news_customizer_all_values['salient-news-archive-layout'];
		$salient_news_archive_image_align = $salient_news_customizer_all_values['salient-news-archive-image-align'];
		if( 'excerpt-only' == $salient_news_archive_layout ){
			the_excerpt();
		}
		elseif( 'full-post' == $salient_news_archive_layout ){
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'salient-news' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		elseif( 'thumbnail-and-full-post' == $salient_news_archive_layout ){
			if( 'left' == $salient_news_archive_image_align ){
				echo "<div class='image-left'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $salient_news_archive_image_align ){
				echo "<div class='image-right'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('full');
			}
			echo "</a>";
			echo "</div>";/*div end*/
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'salient-news' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		else{
			if( 'left' == $salient_news_archive_image_align ){
				echo "<div class='image-left'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $salient_news_archive_image_align ){
				echo "<div class='image-right'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('full');
			}
			echo "</a>";
			echo "</div>";/*div end*/
			the_excerpt();
		}
		?>
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
	</div>
</article><!-- #post-## -->