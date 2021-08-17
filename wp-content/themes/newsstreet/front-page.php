<?php
get_header();
$newsstreet_newsblog_setting = get_theme_mod('newsstreet_newsblog_setting', 'inactive');
if ( $newsstreet_newsblog_setting == "active" ){ ?>
	<!-- #newsstreet section -->
	<section id="main-content" class="module p-top-50">
		<div class="container">
			
			<!-- News Grids -->
			<div class="row news-block-grid">
				<?php
				$newsstreet_i = 1;
				// Start the main loop
				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
					// show only 2 recent post
					if($newsstreet_i <= 2) {
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<article class="post">
						<figure class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" class="image-link"><?php the_post_thumbnail('crypto-news-blog'); ?></a>

							<div class="post-content-caption">
								<div class="entry-meta">
									<span class="cat-links"> 
										<?php
										$newsstreet_categories = get_the_category();
										if ( ! empty( $newsstreet_categories ) ) {
											echo '<a href="'. esc_url( get_category_link($newsstreet_categories[0]->term_id)).'">'. esc_html($newsstreet_categories[0]->name).'</a>';
										}
										?>
									</span>
								</div>
								<header class="entry-header">
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
								</header>
								<div class="entry-meta">
									<span class="entry-date"><a href="<?php echo esc_url(get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') )); ?>"><?php echo get_the_date(); ?></a></span>
								</div>
							</div>
						</figure>
					</article>
				</div>
				<?php
					}
					$newsstreet_i++;
					endwhile;
				endif;
				?>
			</div>
			<!-- /News Grids -->

			<div class="row">
				<div class="col-md-12">
					<div class="news-section-head">
						<?php 
						$newsstreet_posts_heading = get_theme_mod('newsstreet_posts_heading', 'Latest News');
						if($newsstreet_posts_heading != "" ){ ?>
							<h4 class="head-title"><?php echo esc_html($newsstreet_posts_heading); ?></h4>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="row news-block-cloumns">
				<?php
				// Use rewind_posts() to use the query a second time.
				rewind_posts();
				
				// Start the second loop
				$newsstreet_k=1;
				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
						// show post from third post
						if($newsstreet_k > 2) {
				?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<article class="post">
						<figure class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" class="image-link"><?php the_post_thumbnail('crypto-news-blog', array('class' => 'wp-post-image')); ?></a>
							<span class="cat-links item-meta"> 
								<?php
								$newsstreet_categories = get_the_category();
								if ( ! empty( $newsstreet_categories ) ) {
									echo '<a href="'. esc_url( get_category_link($newsstreet_categories[0]->term_id)).'">'. esc_html($newsstreet_categories[0]->name).'</a>';
								}
								?>
							</span>
						</figure>
						<div class="post-content">
							<header class="entry-header">
								<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
							</header>
							<div class="entry-meta">
								<span class="author"><?php esc_html_e('By','newsstreet'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
								<span class="entry-date"><a href="<?php echo esc_url(get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') )); ?>"><?php echo get_the_date(); ?></a></span>
							</div>
						</div>
					</article>
				</div>
				<?php
							} // end $newsstreet_k
						$newsstreet_k++;
					endwhile;
				endif;
				?>
			</div>
			
			<!-- pagination -->
			<div class="pagination font-alt">
				<?php
					// custom query loop pagination
					global $wp_query;
					$newsstreet_big = 999999999; // need an unlikely integer

					the_posts_pagination( array(
						'base'      => str_replace( $newsstreet_big, '%#%', get_pagenum_link( $newsstreet_big ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, get_query_var('paged') ),
						'total'     => $wp_query->max_num_pages,
						'prev_text' => __('&#x276E;', 'newsstreet'),
						'next_text' => __('&#x276F;', 'newsstreet'),
						//'type'      => 'array'
					));
				?>
			</div>
		</div>
	</section><!-- #news section -->
	<?php } else {
		get_template_part('index');
	} ?>
<?php get_footer(); ?>