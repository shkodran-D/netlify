<?php
if ( ! function_exists( 'salient_news_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since salient-news 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function salient_news_before_footer()
    { ?>
    </div><!-- #content -->
    <!-- </section> -->
        <!-- *****************************************
             Footer section starts
    ****************************************** -->
    <footer id="colophon" class="site-footer">
        <?php
        }
    endif;
    add_action( 'salient_news_action_before_footer', 'salient_news_before_footer', 10 );

    if ( ! function_exists( 'salient_news_widget_before_footer' ) ) :
        /**
         * Footer content
         *
         * @since salient-news 1.0.0
         *
         * @param null
         * @return false | void
         *
         */
        function salient_news_widget_before_footer() {
                global$salient_news_customizer_all_values;
               $salient_news_footer_widgets_number =$salient_news_customizer_all_values['salient-news-footer-sidebar-number'];
                if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
                    return false;
                }
                if( 1 == $salient_news_footer_widgets_number ){
                    $col = 'col-md-12';
                }
                elseif( 2 == $salient_news_footer_widgets_number ){
                 $col = 'col-md-6 col-sm-6 col-xs-12';
                }
                elseif( 3 == $salient_news_footer_widgets_number ){
                    $col = 'col-md-4 col-sm-4 col-xs-12';
                }
                else{
                    $col = 'col-md-3 col-sm-3 col-xs-12';
        }
        ?>
        <!-- footer widget -->
        <section class="st-main-footer">
            <div class="container">
                <div class="row">
                     <?php if( is_active_sidebar( 'footer-col-one' ) &&$salient_news_footer_widgets_number > 0 ) : ?>
                        <div class="st-footer-widget-area <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-one' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-two' ) &&$salient_news_footer_widgets_number > 1 ) : ?>
                        <div class="st-footer-widget-area <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-two' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-three' ) &&$salient_news_footer_widgets_number > 2 ) : ?>
                        <div class="st-footer-widget-area <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-three' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-four' ) &&$salient_news_footer_widgets_number > 3 ) : ?>
                        <div class="st-footer-widget-area <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-four' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
        }
    endif;
    add_action( 'salient_news_action_widget_before_footer', 'salient_news_widget_before_footer', 10 );

    if ( ! function_exists( 'salient_news_footer' ) ) :
        /**
         * Footer content
         *
         * @since salient-news 1.0.0
         *
         * @param null
         * @return null
         *
         */
        function salient_news_footer() {
            global$salient_news_customizer_all_values;
            ?> 
            <!-- footer site info -->
            <div class="site-info">
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'salient-news' ) ); ?>"><?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'salient-news' ), 'WordPress' );
                ?></a>
                <span class="sep"> | </span>
                
                <?php /* translators: %s: search term */ ?>
                
                <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'salient-news' ), 'Salient News', sprintf('<a href="%s" target = "_blank" rel="designer">%s</a>', esc_url( 'http://salientthemes.com/' ), esc_html__( 'Salientthemes', 'salient-news' ) )  ); ?>
                              
                <div class="footer-social-nav">
                    <div class="social-widget salient-social-section social-icon-only bottom-tooltip">
                        <?php
                            wp_nav_menu( array( 
                                'theme_location' => 'social', 
                                'link_before' => '<span>',
                                'link_after'=>'</span>' , 
                                'menu_id' => 'social-menu',
                                'fallback_cb' => false,
                            ) );
                        ?>
                    </div>
                </div>
            </div><!-- .site-info -->

        </footer><!-- #colophon -->
        </div><!-- #page -->
        <!-- *****************************************
                 Footer section ends
        ****************************************** -->
        <?php
        }
    endif;
    add_action( 'salient_news_action_footer', 'salient_news_footer', 10 );

    if ( ! function_exists( 'salient_news_page_end' ) ) :
        /**
         * Page end
         *
         * @since salient-news 1.0.0
         *
         * @param null
         * @return null
         *
         */
        function salient_news_page_end() {
        global$salient_news_customizer_all_values;
            ?>
        <?php
         if( 1 ==$salient_news_customizer_all_values['salient-news-enable-back-to-top']) {
            ?>
                <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a><!-- return to top button -->
            <?php
            } ?>
        </div><!-- #page -->
        <?php }
    endif;
    add_action( 'salient_news_action_after', 'salient_news_page_end', 10 );