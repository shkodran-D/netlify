<?php
if ( !function_exists('salient_news_latest_news')  ) :

 /**
  * latest news blog
  *
  * @since salient-news 1.0.0
  *
  * @param null
  * @return null
  *
  */
  function salient_news_latest_news()
  {
    global $salient_news_customizer_all_values;
    $salient_news_latest_news_single_word = absint($salient_news_customizer_all_values['salient-news-single-number-of-word']);
    $salient_news_latest_news_main_title = esc_html($salient_news_customizer_all_values['salient-news-latest-news-main-title']);
    $salient_news_number_of_post_latest_news   = absint($salient_news_customizer_all_values['salient-news-lates-news-number-of-post']);
    $salinet_news_latest_cat_post = esc_attr($salient_news_customizer_all_values['salient-news-latest-blog-from-cat']);

    if (  1  != $salient_news_customizer_all_values['salient-news-enable-latest-news'] )
    {
      return null;
    }?>
      <section class="st-trending-section clearfix" id="trending-section">
            <div class="container">
                <div class="row">
                    <div class="st-trending-wrapper">
                        <h2 class="widget-title"><?php echo esc_html($salient_news_latest_news_main_title); ?></h2>
                        <div class="st-trending-news-slider">
                            <?php 
                                $salient_news_latest_news_arg = array(
                                    'post_type'                => 'post',
                                    'posts_per_page'           => $salient_news_number_of_post_latest_news,
                                    'cat'                      =>  $salinet_news_latest_cat_post,
                                    'orderby'                  => 'post__in'
                                );

                                $salient_news_latest_news_query  =  new WP_Query($salient_news_latest_news_arg);
                                if ( $salient_news_latest_news_query -> have_posts() ) :
                                    while( $salient_news_latest_news_query -> have_posts() ) :
                                        $salient_news_latest_news_query-> the_post();
                                        $url = '';
                                        if ( has_post_thumbnail() )
                                        {
                                            $image    = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_id() ), 'lates-news-blog' );
                                            $url = $image['0'];
                                        }
                                        else
                                        {
                                            $url = get_template_directory_uri(). '/assets/images/fs.jpg';
                                        } ?>

                                        <div class="news-heading-only">
                                          <figure>
                                            <a href="<?php the_permalink();?>"><img alt="image-alt" class="img-responsive" src="<?php echo esc_url($url);?> "></a>
                                          </figure>
                                            <div class="st-slider-caption-recent">
                                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <div class="st-w-post-meta">
                                                      <?php  
                                                          $author_name  = get_the_author_meta('nickname');
                                                          $author_url   =  get_author_posts_url(get_the_author_meta('ID'));
                                                      ?>
                                                    <span class="st-w-1-byline">
                                                      <a href="<?php echo esc_url($author_url);?>"><?php echo esc_html($author_name);?></a>
                                                    </span><!--by-line -->
                                                    <?php 
                                                        $archive_year   = get_the_time('Y');
                                                    ?>
                                                    <span class="st-w-1-date">
                                                      <a href="<?php echo esc_url(get_year_link($archive_year)); ?>"><?php echo get_the_date('F-j-Y');?></a>
                                                      </span><!-- date -->
                                                </div><!--st-w-post-meta -->
                                                <?php
                                                $salient_news_content =  salient_news_words_count($salient_news_latest_news_single_word,get_the_content());
                                                 ?>
                                                <p><?php echo wp_kses_post($salient_news_content); ?></p>
                                            </div><!-- caption -->
                                        </div><!-- news-heading-only -->  
                                        <?php 
                                    endwhile;
                                 endif;

                                ?>
                        </div><!-- st-trending-news-slider -->
                        
                    </div><!-- trending news wrapper -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- st trending-section -->

  <?php
  }

endif;
add_action('salient_news_action_front_page','salient_news_latest_news',10);