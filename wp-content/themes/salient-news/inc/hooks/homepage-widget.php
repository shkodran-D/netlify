<?php

if ( ! function_exists( 'salient_news_widget_section' ) ) :
    /**
     *
     * @since salient-news 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function salient_news_widget_section() {
        ?>
        <!-- Main Content section -->
        <div class="container pdr0">
            <section class="st-custom-widget-section clearfix"><!-- salient news home custom widget section -->
                <div class="st-custom-left-section ">
                    <?php dynamic_sidebar( 'homepage-main-section' ); ?>
                </div>
                <div class="st-custom-right-section clearfix">
                    <?php dynamic_sidebar('front-sidebar-tab-widget'); ?>    
                </div>
            </section>
        </div>
        <div class="container">
            <div class="row">
                <section class="st-full-width-widget-style clearfix" id="st-full-width">
                    <?php dynamic_sidebar('full-width-widget'); ?>
                </section>
            </div>
        </div>      
        <?php
    }
endif;
add_action( 'salient_news_action_front_page', 'salient_news_widget_section', 50 );

                                              