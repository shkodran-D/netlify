<?php
if ( !class_exists('salient_news_widgets_style3') ) :
    /**
     * Latest News Widget Class
     *
     * @since salient-news 1.0.0
     *
     */
    class salient_news_widgets_style3 extends WP_Widget
    {
        
        function __construct()
        {
            parent :: __construct(
                'salient-news-third-widget-style', //base-id
                esc_html__('ST Two Col Widget ','salient-news'),
                array( 'description' => esc_html__( 'Home page two column second widgets', 'salient-news' ) ) // Args
            );
        }

        function widget($args,$instance)
        {
            extract( $args );

            $title             = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
            $post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;
            $custom_class      = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );
            $feature_image    = ! empty( $instance['feature_image'] ) ? $instance['feature_image'] : 'salient-news-style-second';
            $excerpt_length    = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 50;
            // Add Custom class
            if ( $custom_class ) 
            {
                $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
            }

            echo wp_kses_post($before_widget);

            // Title
            if ( $title ) 
            {
                echo wp_kses_post($before_title . $title . $after_title);
            }
            ?>

            
            <?php 
            // post selection
            $args = array(
                'posts_per_page' => $post_number,
                'no_found_rows'  => true,
                'ignore_sticky_posts'  => 1
            );
            if ( absint( $post_category ) > 0  ) {
                $args['cat'] = $post_category;
            }
            $all_post_query = new WP_Query( $args );
            
            if(!empty($all_post_query)  ) : ?>
                <section class="latest-blog-style clearfix" id="st-blog-style">
                    <div class="salient-equal-height">
                        <?php
                            if( $all_post_query -> have_posts()  ) 
                            {
                                $flag = true;
                                while( $all_post_query -> have_posts() )
                                {
                                    $all_post_query-> the_post();?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 st-padding-odd-even">
                                        <div class="st-widget-1 latest-blog-st left-style">
                                            <div class="st-w-1-img big">
                                                <?php $url = '';
                                                if ( has_post_thumbnail() ) 
                                                {
                                                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $feature_image );
                                                    $url = $img['0'];
                                                } 
                                                else
                                                {
                                                    $url = get_template_directory_uri(). '/assets/images/fs.jpg';
                                                }?>

                                                <a href="<?php the_permalink();?>"><img alt="image-alt" class="img-responsive" src="<?php echo esc_url($url); ?>"></a>
                                            </div><!-- img-wrapper -->
                                            <div class="blog-style-content">
                                                <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
                                                <div class="st-w-post-meta">
                                                    <?php
                                                        $author_name = get_the_author_meta('nickname');
                                                        $author_link = get_author_posts_url(get_the_author_meta('ID'));
                                                    ?>
                                                    <span class="author-link"><a href="<?php echo esc_url($author_link);?>"><?php echo esc_html($author_name); ?></a></span>
                                                    <?php 
                                                        $archive_year   = get_the_time('Y');
                                                    ?>
                                                    <span class="date-link"><a href="<?php echo esc_url(get_year_link($archive_year)); ?>"><?php echo get_the_date() ?></a></span>
                                                </div><!--st-w-post-meta -->
                                                <p><?php echo esc_html(salient_news_words_count($excerpt_length, get_the_excerpt() ) );?></p>                           
                                                <a href="<?php the_permalink(); ?>" class="blog-style-read-more">read more</a>                                             
                                            </div><!-- blog style content -->
                                        </div><!-- left style -->
                                    </div><!-- col-md-6 -->
                                    
                                <?php }
                            }
                        ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </section>      
            <?php endif;
            echo wp_kses_post($after_widget);
        }

        function update( $new_instance , $old_instance )
        {
            $instance                       = $old_instance;
            $instance['title']              = isset($instance['title'] )  ? $new_instance['title'] : '';
            $instance['post_category']      = isset($instance['title'] ) ? $new_instance['post_category'] : '';
            $instance['post_number']        =  isset($instance['post_number'] ) ? $new_instance['post_number'] : '';
            $instance['custom_class']       = isset($instance['custom_class'] ) ? $new_instance['custom_class'] : '';

            return $instance;
        }

        function form ( $instance )
        {
            // default
            $instance = wp_parse_args( (array) $instance, array(
                'title'                 => '',
                'post_category'         => '',
                'post_number'           => 1,
                'custom_class'            => ''

            ) );
            $title          = strip_tags($instance['title'] ) ;
            $post_category  = absint($instance['post_category'] ) ;
            $post_number    = absint($instance['post_number'] );
            $custom_class   = esc_attr( $instance['custom_class'] );?>

            <p>
                <label for="<?php echo absint($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id( 'post_category' )); ?>"><?php esc_html_e( 'Category:', 'salient-news' ); ?></label>
                <?php
                $cat_args = array(
                    'orderby'         => 'name',
                    'hide_empty'      => 0,
                    'taxonomy'        => 'category',
                    'name'            => esc_html($this->get_field_name('post_category')),
                    'id'              => absint($this->get_field_id('post_category')),
                    'selected'        => $post_category,
                    'show_option_all' => __( 'All Categories','salient-news' ),
                );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id( 'post_number' )); ?>"><?php esc_html_e('Number of Posts:', 'salient-news' ); ?></label>
                <input class="widefat1" id="<?php echo absint($this->get_field_id( 'post_number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'post_number' )); ?>" type="number" value="<?php echo absint( $post_number ); ?>" min="1" style="max-width:50px;" />
            </p>
            <p>
                <label for="<?php echo esc_html($this->get_field_id( 'custom_class' )); ?>"><?php esc_html_e( 'Custom Class:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id( 'custom_class')); ?>" name="<?php echo esc_attr($this->get_field_name( 'custom_class' )); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
            </p>

        <?php }
    }

    add_action( 'widgets_init', 'salient_news_two_third_widgets_load' );

    if ( ! function_exists( 'salient_news_two_third_widgets_load' ) ) :

        /**
         * Load widget
         *
         * @since salient-news 1.0.0
         *
         */
        function salient_news_two_third_widgets_load()
        {
            // Latest News widget
            register_widget( 'salient_news_widgets_style3' );
        }

    endif;
endif;