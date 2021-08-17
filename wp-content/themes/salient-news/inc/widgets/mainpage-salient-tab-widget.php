<?php

if ( ! class_exists( 'salient_news_tab_widget' ) ) :

    /**
     * Latest News Widget Class
     *
     * @since salient-news 1.0.0
     *
     */
    class salient_news_tab_widget extends WP_Widget {

        function __construct()
        {
            parent :: __construct(
                'salient-news-tab-widget', //base_id
                esc_html__('ST Tab Widget','salient-news'),
                array( 'description' => esc_html__( 'Home page two column third widgets', 'salient-news' ) ) // Args
            );
        }


        function widget( $args, $instance ) {
            extract( $args );
            $title                  = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
            $popular_heading        = ! empty( $instance['popular_heading'] ) ? $instance['popular_heading'] : '';
            $popular_category       = ! empty( $instance['popular_category'] ) ? $instance['popular_category'] : 0;
            $popular_number         = ! empty( $instance['popular_number'] ) ? $instance['popular_number'] : 5;
            $business_heading       = ! empty( $instance['business_heading'] ) ? $instance['business_heading'] : '';
            $business_category      = ! empty( $instance['business_category'] ) ? $instance['business_category'] : 0;
            $business_number        = ! empty( $instance['business_number'] ) ? $instance['business_number'] : 5;
            $sport_heading          = ! empty( $instance['sport_heading'] ) ? $instance['sport_heading'] : '';
            $sport_category         = ! empty( $instance['sport_category'] ) ? $instance['sport_category'] : 0;
            $sport_number           = ! empty( $instance['sport_number'] ) ? $instance['sport_number'] : 5;
            $custom_class           = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );
            $featured_image         = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'salient-news-recent-sidebar';
            $excerpt_length         = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 50;

            // Add Custom class
            if ( $custom_class ) {
                $before_widget      = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
            }

            // Title
            if ( $title ) echo wp_kses_post($before_title . $title . $after_title);
    
            $tab_id = 'tabbed-' . $this->number;

           echo wp_kses_post($args['before_widget']);
           ?>
            <div class="st-sidebar-tab-style clearfix">
                <ul>
                    <li class="clickme"><a href="javascript:void();" data-tag="<?php echo esc_attr( $tab_id ); ?>-popular" class="activelink"><?php echo esc_html($popular_heading);?></a></li>
                    <li class="clickme"><a href="javascript:void();" data-tag="<?php echo esc_attr( $tab_id ); ?>-business"><?php echo esc_html($business_heading);?></a></li>
                    <li class="clickme"><a href="javascript:void();" data-tag="<?php echo esc_attr( $tab_id ); ?>-sport"><?php echo esc_html($sport_heading);?></a></li>
                </ul> 
                <div class="clear"></div>  

                <div class="tab">
                    <div class="list" id="<?php echo esc_attr( $tab_id ); ?>-popular" class="tab-content first-tab">
                        <?php  $this->render_news( 'popular', $instance ); ?>
                    </div>
                    <div class="list hide" id="<?php echo esc_attr( $tab_id ); ?>-business" class="tab-content second-tab">
                        <?php $this->render_news( 'business', $instance ); ?>


                    </div>
                    <div class="list hide" id="<?php echo esc_attr( $tab_id ); ?>-sport" class="tab-content third-tab">
                        <?php $this->render_news( 'sport', $instance ); ?>
                    </div>
                </div>
            </div>
           <?php

           echo wp_kses_post($args['after_widget']);
        }
        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $instance Parameters.
         * @return void
         */
        function render_news( $type, $instance ) {

                
            if ( ! in_array( $type, array( 'popular', 'business','sport' ) ) ) {
                return;
            }

            switch ( $type ) {
                case 'popular':
                    $qargs = array(

                        'post_type'         => 'post',
                        'posts_per_page'    => $instance['popular_number'],
                        'no_found_rows'     => true,
                        'cat'               =>  $instance['popular_category']
                        // 'orderby'        => 'comment_count',
                    );

                    
                    break;

                case 'business':
                    $qargs = array(
                        'post_type'         => 'post',
                        'posts_per_page'    => $instance['business_number'],
                        'no_found_rows'     => true,
                        'cat'               =>  $instance['business_category']
                        );
                    
                    break;

                case 'sport':
                    $qargs = array(
                        'post_type'         => 'post',
                        'posts_per_page'    => $instance['sport_number'],
                        'no_found_rows'     => true,
                        'cat'               =>  $instance['sport_category']
                        
                    );
                    break;


                default:
                    break;
            }

            $all_posts = get_posts( $qargs );
            ?>
            <?php if ( ! empty( $all_posts ) ) : ?>
                <?php global $post; ?>

                <!-- <ul class="col-md-12  news-list"> -->
                <?php foreach ( $all_posts as $key => $post ) : ?>
                    <?php setup_postdata( $post ); ?>
                    
                    <div class="tab-cat-wrapper clearfix">
                        <div class="tab-image">
                            <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>
                            <?php if ( ! empty( $image ) ) : ?>
                                    <a href="<?php the_permalink();?>"><img class="img-responsive" src="<?php echo esc_url( $image[0] ); ?>" alt="" /></a>
                                <?php endif; ?>
                            <?php else : ?>
                                <img class="img-responsive" src="<?php echo get_template_directory_uri() . '../assets/images/fs.jpg'; ?>" alt="" />
                            <?php endif; ?>
                        </div>
                        <div class="tab-heading-title">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                            <div class="post-meta-content">
                                <?php
                                    $author_name = get_the_author_meta('nickname');
                                    $author_url  = get_author_posts_url(get_the_author_meta('Id'));
                                ?>
                                <span class="author-link"><a href="<?php echo esc_url($author_url);?>"><?php echo esc_html($author_name);?></a></span>
                                <span class="date-link"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </div><!-- post meta -->
                        </div><!-- tab-heading-title -->
                    </div><!-- tab-category-tags-wrapper -->

                <?php endforeach; ?>
                <!-- </ul>.news-list -->

                <?php wp_reset_postdata(); ?>

            <?php endif; ?>

            <?php

        }
        
       

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title']                  = sanitize_text_field(strip_tags($new_instance['title']));
            $instance['popular_heading']        = sanitize_text_field(strip_tags($new_instance['popular_heading']));
             $instance['popular_category']      = sanitize_text_field( $new_instance['popular_category'] );
            $instance['popular_number']         = absint( $new_instance['popular_number'] );
            $instance['business_heading']       = sanitize_text_field(strip_tags($new_instance['business_heading']));
             $instance['business_category']     =  sanitize_text_field( $new_instance['business_category'] );
            $instance['business_number']        = absint( $new_instance['business_number'] );
            $instance['sport_heading']          = sanitize_text_field(strip_tags($new_instance['sport_heading']));
             $instance['sport_category']        =  sanitize_text_field( $new_instance['sport_category'] );
            $instance['sport_number']           = absint( $new_instance['sport_number'] );
            $instance['custom_class']           = sanitize_text_field( $new_instance['custom_class'] );
            

            return $instance;
        }

        function form( $instance ) {

            //Defaults
            $instance = wp_parse_args( (array) $instance, array(
                'title'             => '',
                'popular_heading'   => '',
                'popular_category'  => '',
                'popular_number'    => 5,
                'business_heading'  => '',
                'business_category' => '',
                'business_number'   => 5,
                'sport_heading'     => '',
                'sport_category'    => '',
                'sport_number'      => 5,
                'custom_class'      => ''
               
            ) );
            $title            = strip_tags( $instance['title'] );
            $popular_heading  = strip_tags( $instance['popular_heading'] );
            $popular_category = $instance['popular_category'];
            $popular_number   = absint( $instance['popular_number'] );
            $business_heading  = strip_tags( $instance['business_heading'] );
            $business_category = $instance['business_category'];
            $business_number   = absint( $instance['business_number'] );
            $sport_heading  = strip_tags( $instance['sport_heading'] );
            $sport_category = $instance['sport_category'];
            $sport_number   = absint( $instance['sport_number'] );
            $custom_class     = esc_attr( $instance['custom_class'] );
            

            ?>
            
            <p>
                <label for="<?php echo absint($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id('popular_heading')); ?>"><?php esc_html_e( 'Tab1 Heading Title:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id('popular_heading')); ?>" name="<?php echo esc_html($this->get_field_name( 'popular_heading' )); ?>" type="text" value="<?php echo esc_attr( $popular_heading ); ?>" />
            </p>

            <p>
                <label for="<?php echo absint($this->get_field_id( 'popular_category' )); ?>"><?php esc_html_e( 'Tab1 Category:', 'salient-news' ); ?></label>
                <?php
                $cat_args = array(
                    'orderby'         => 'name',
                    'hide_empty'      => 0,
                    'taxonomy'        => 'category',
                    'name'            => esc_html($this->get_field_name('popular_category')),
                    'id'              => absint($this->get_field_id('popular_category')),
                    'selected'        => $popular_category,
                    'show_option_all' => __( 'All Categories','salient-news' ),
                );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>

            <p>
                <label for="<?php echo absint($this->get_field_id( 'popular_number' )); ?>"><?php esc_html_e('Number of Tab1 Posts:', 'salient-news' ); ?></label>
                <input class="widefat1" id="<?php echo absint($this->get_field_id( 'popular_number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'popular_number' )); ?>" type="number" value="<?php echo absint( $popular_number ); ?>" min="1" style="max-width:50px;" />
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id('business_heading')); ?>"><?php esc_html_e( 'Tab2 Heading Title:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id('business_heading')); ?>" name="<?php echo esc_html($this->get_field_name( 'business_heading' )); ?>" type="text" value="<?php echo esc_attr( $business_heading ); ?>" />
            </p>

            <p>
                <label for="<?php echo absint($this->get_field_id( 'business_category' )); ?>"><?php esc_html_e( 'Tab2 Category:', 'salient-news' ); ?></label>
                <?php
                $cat_args = array(
                    'orderby'         => 'name',
                    'hide_empty'      => 0,
                    'taxonomy'        => 'category',
                    'name'            => esc_html($this->get_field_name('business_category')),
                    'id'              => absint($this->get_field_id('business_category')),
                    'selected'        => $business_category,
                    'show_option_all' => __( 'All Categories','salient-news' ),
                );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>



            <p>
                <label for="<?php echo absint($this->get_field_id( 'business_number' )); ?>"><?php esc_html_e('Number of tab2 Posts:', 'salient-news' ); ?></label>
                <input class="widefat1" id="<?php echo absint($this->get_field_id( 'business_number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'business_number' )); ?>" type="number" value="<?php echo absint( $business_number ); ?>" min="1" style="max-width:50px;" />
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id('sport_heading')); ?>"><?php esc_html_e( 'Tab3 Heading Title:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id('sport_heading')); ?>" name="<?php echo esc_html($this->get_field_name( 'sport_heading' )); ?>" type="text" value="<?php echo esc_attr( $sport_heading ); ?>" />
            </p>

            <p>
                <label for="<?php echo absint($this->get_field_id( 'sport_category' )); ?>"><?php esc_html_e( 'tab3 Category:', 'salient-news' ); ?></label>
                <?php
                $cat_args = array(
                    'orderby'         => 'name',
                    'hide_empty'      => 0,
                    'taxonomy'        => 'category',
                    'name'            => esc_html($this->get_field_name('sport_category')),
                    'id'              => absint($this->get_field_id('sport_category')),
                    'selected'        => $sport_category,
                    'show_option_all' => __( 'All Categories','salient-news' ),
                );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>


            <p>
                <label for="<?php echo absint($this->get_field_id( 'sport_number' )); ?>"><?php esc_html_e('Number of tab3 Posts:', 'salient-news' ); ?></label>
                <input class="widefat1" id="<?php echo absint($this->get_field_id( 'sport_number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'sport_number' )); ?>" type="number" value="<?php echo absint( $sport_number ); ?>" min="1" style="max-width:50px;" />
            </p>
            <p>
                <label for="<?php echo absint($this->get_field_id('custom_class')); ?>"><?php esc_html_e( 'Custom Class:', 'salient-news' ); ?></label>
                <input class="widefat" id="<?php echo absint($this->get_field_id('custom_class')); ?>" name="<?php echo esc_attr($this->get_field_name( 'custom_class' )); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
            </p>
            <?php
        }
    }
    add_action( 'widgets_init', 'salient_news_recent_sidebar_tab_post' );

    if ( ! function_exists( 'salient_news_recent_sidebar_tab_post' ) ) :

        /**
         * Load widget
         *
         * @since salient-news 1.0.0
         *
         */
        function salient_news_recent_sidebar_tab_post(){
            // Latest News widget
            register_widget( 'salient_news_tab_widget' );
        }

    endif;

endif;