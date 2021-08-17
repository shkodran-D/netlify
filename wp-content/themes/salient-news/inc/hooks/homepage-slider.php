<?php     
if ( !function_exists('salient_news_slider')  ) :
    /**
     * Featured Slider
     *
     * @since salient-news 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function salient_news_slider()
    {
        global $salient_news_customizer_all_values;
        if ( 1 != $salient_news_customizer_all_values['salient-news-feature-slider-enable'] ) 
        {
            return null;
        }

        $salient_news_number_of_slider = absint( $salient_news_customizer_all_values['salient-news-feature-slider-number'] );
        $salient_news_category_selection = esc_attr( $salient_news_customizer_all_values['salient-news-featured-slider-category'] ); ?>

        <section class="st-latest-post-slider" id="st-top-slider">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6 col-sm-6 col-xs-12 left-slider left-slider-init no-padding">
                            <?php 
                                $salient_news_slider_cat_arg =  array(
                                    'post_type'             => 'post',
                                    'posts_per_page'        => absint($salient_news_number_of_slider),
                                    'orderby'               => 'post__in',
                                    'cat'                   => $salient_news_category_selection
                                );
                                $salient_news_slider_query  = new WP_Query($salient_news_slider_cat_arg);
                                if ( $salient_news_slider_query-> have_posts() ) :
                                    while( $salient_news_slider_query -> have_posts() ):
                                        $salient_news_slider_query->the_post();

                                        $url = '';
                                        if (has_post_thumbnail() )
                                        {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_id() ), 'salient-news-slider');
                                            $url = $image['0'];
                                        }
                                        else
                                        {
                                            $url = get_template_directory_uri(). '/assets/images/ft.jpg';
                                        }
                                        ?>
                                    
                                        <div class="st-top-slider-content main-slider st-have-overlay">
                                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" class="img-responsive" src="<?php echo esc_url($url); ?>"></a>
                                            <div class="st-slider-caption">
                                                <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                                                <div class="post-meta-content">
                                                    <?php 
                                                        $author_name = get_the_author_meta('display_name');
                                                        $author_url  = get_author_posts_url(get_the_author_meta('ID'));
                                                    ?>
                                                    <span class="author-link"><a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a></span>
                                                    <?php 
                                                        $archive_year   = get_the_time('Y');
                                                    ?>
                                                    <span class="date-link"><a href="<?php echo esc_url(get_year_link($archive_year)); ?>"><?php echo get_the_date('F Y');?></a></span>
                                                </div>                                  
                                            </div><!-- caption -->
                                        </div><!--main-slider st-have-overlay -->
                            <?php endwhile;
                            wp_reset_postdata();
                                endif;

                            ?>   
                        </div><!-- col-md-6 -->

                        <div class="col-md-6 col-xs-12 col-sm-6 no-left-padding pdr0">
                            <?php 
                            $salient_news_blog_number_select = absint( $salient_news_customizer_all_values['salient-news-feature-slider-right-blog-number']) ;
                            $salient_news_blog_category      = esc_attr($salient_news_customizer_all_values['salient-news-select-cat-post']) ;
                            $salient_news_slider_blog_arg = array(
                                'post_type'             => 'post',
                                'posts_per_page'        =>  $salient_news_blog_number_select,
                                'orderby'               => 'post__in',
                                'cat'                   => $salient_news_blog_category
                            );

                            $salient_news_blog_query    =  new WP_Query($salient_news_slider_blog_arg);
                            if ( $salient_news_blog_query -> have_posts() ) :
                                while( $salient_news_blog_query -> have_posts() ) :
                                    $salient_news_blog_query->the_post();

                                    $url = '';
                                    if ( has_post_thumbnail() )
                                    {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id() ),'slider-blog-image');
                                        $url  = $image['0'];
                                    }
                                    else
                                    {
                                        $url = get_template_directory_uri().'/assets/images/ft.jpg';
                                    }
                                    ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 left-slider pdr0">
                                        <div class="st-top-slider-content right-post st-have-overlay">
                                            <a href="<?php the_permalink();?>"><img alt="image-alt" class="img-responsive" src="<?php echo esc_url($url); ?>"></a>
                                            <div class="st-slider-caption">
                                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <div class="post-meta-content">
                                                    <?php 
                                                        $author_name = get_the_author_meta('display_name');
                                                        $author_url =  get_author_posts_url( get_the_author_meta('ID') );
                                                    ?>
                                                    <span class="author-link"><a href="<?php echo esc_url($author_url);?>"><?php echo esc_html($author_name);?></a></span>
                                                    <?php 
                                                        $archive_year   = get_the_time('Y');
                                                    ?>
                                                    <span class="date-link"><a href="<?php echo esc_url(get_year_link($archive_year));?>"><?php echo get_the_date('F-j');?></a></span>
                                                </div><!-- post-meta-->                                 
                                            </div><!-- caption -->
                                        </div>    
                                    </div><!-- col-md-6 -->
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                             ?>
                        </div><!-- col-md-6 -->
                    </div><!-- md-12 -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- section -->
    <?php
}
endif;
add_action('salient_news_action_front_page','salient_news_slider', 10);

