<?php

if ( ! function_exists( 'salient_news_set_global' ) ) :
/**
 * Setting global values for all saved customizer values
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_set_global() {
    /*Getting saved values start*/
    $GLOBALS['salient_news_customizer_all_values'] = salient_news_get_all_options(1);
}
endif;
add_action( 'salient_news_action_before_head', 'salient_news_set_global', 0 );

if ( ! function_exists( 'salient_news_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_doctype() {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'salient_news_action_before_head', 'salient_news_doctype', 10 );

if ( ! function_exists( 'salient_news_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_before_wp_head() {
    ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
}
endif;
add_action( 'salient_news_action_before_wp_head', 'salient_news_before_wp_head', 10 );

if( ! function_exists( 'salient_news_default_layout' ) ) :
    /**
     * salient-news default layout function
     *
     * @since  salient-news 1.0.0
     *
     * @param int
     * @return string
     */
    function salient_news_default_layout( $post_id = null ){

        global$salient_news_customizer_all_values,$post;
       $salient_news_default_layout =$salient_news_customizer_all_values['salient-news-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
       $salient_news_default_layout_meta = get_post_meta( $post_id, 'salient-news-default-layout', true );

        if( false !=$salient_news_default_layout_meta ) {
           $salient_news_default_layout =$salient_news_default_layout_meta;
        }
        return$salient_news_default_layout;
    }
endif;

if ( ! function_exists( 'salient_news_body_class' ) ) :
/**
 * add body class
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_body_class($salient_news_body_classes ) {
    if(!is_front_page() || ( is_front_page())){
       $salient_news_default_layout = salient_news_default_layout();
        if( !empty($salient_news_default_layout ) ){
            if( 'left-sidebar' ==$salient_news_default_layout ){
               $salient_news_body_classes[] = 'salient-left-sidebar';
            }
            elseif( 'right-sidebar' ==$salient_news_default_layout ){
               $salient_news_body_classes[] = 'salient-right-sidebar';
            }
            elseif( 'both-sidebar' ==$salient_news_default_layout ){
               $salient_news_body_classes[] = 'salient-both-sidebar';
            }
            elseif( 'no-sidebar' ==$salient_news_default_layout ){
               $salient_news_body_classes[] = 'salient-no-sidebar';
            }
            else{
               $salient_news_body_classes[] = 'salient-right-sidebar';
            }
        }
        else{
           $salient_news_body_classes[] = 'salient-right-sidebar';
        }
    }
    return$salient_news_body_classes;

}
endif;
add_filter( 'body_class', 'salient_news_body_class', 10, 1);

if ( ! function_exists( 'salient_news_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_before_page_start() {
    global$salient_news_customizer_all_values;
    /*intro loader*/
}
endif;
add_action( 'salient_news_action_before', 'salient_news_before_page_start', 10 );

if ( ! function_exists( 'salient_news_page_start' ) ) :
/**
 * page start
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_page_start() {
?>
    <div id="page" class="site ">
<?php
}
endif;
add_action( 'salient_news_action_before', 'salient_news_page_start', 15 );

if ( ! function_exists( 'salient_news_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'salient-news' ); ?></a>
<?php
}
endif;
add_action( 'salient_news_action_before_header', 'salient_news_skip_to_content', 10 );

if ( ! function_exists( 'salient_news_header' ) ) :
/**
 * Main header
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_header() {
    global$salient_news_customizer_all_values;
    ?>
    <section class="top-header">
        <div class="container">
            <div class="row">
                <?php if (has_nav_menu('top-menu' )) { ?>
                <div class="col-md-4 col-xs-12 col-sm-6 pdr0">
                    <div class="top-nav-bar">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'top-menu',
                                'menu_id'        => 'top-men',
                                'fallback_cb'    => 'slient_news_top_menu'
                            ) );
                        ?>
                    </div>
                </div><!-- col-md-4 -->
                <?php } ?>
                <div class="salient-top-right col-md-8 col-sm-6 col-xs-12 hidden-xs pull-right">
                    <div class="col-md-1 col-xs-2 pull-right">
                        <div class="header-btn-group" id="search-header">
                            <i class="fa fa-search"></i>
                        </div><!-- search-header -->
                    </div><!-- col-md-1-->
                      
                    <div class="col-md-5 col-xs-5 top-date pull-right">
                            <p><?php echo esc_html(date('l-F-j-Y')); ?></p>
                    </div><!-- col-md-3 top-date-->
                     
                    <?php if ( 1 == $salient_news_customizer_all_values['salient-news-top-socail-menu-enable'] ) { ?>
                    <?php if ( has_nav_menu('social') ) { ?>
                    <div class="col-md-6 col-sm-4 col-xs-5 top-right pull-right">
                        <div class="social-widget salient-social-section social-icon-only bottom-tooltip">
                            <?php
                                wp_nav_menu( array( 
                                    'theme_location' => 'social', 
                                    'link_before' => '<span>',
                                    'link_after'=>'</span>' , 
                                    'menu_id' => 'social-menu',
                                    'fallback_cb' => 'slient_news_social_news',
                                ) );
                            ?>
                        </div>
                    </div><!-- col-md-6 top-right -->
                    <?php } 
                     } ?>                                     
                    <div class="top-search-form">
                        <?php get_search_form();?>
                    </div><!--top search form -->
                </div><!-- salient top-right -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- top-menu section -->  
    

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="col-md-12 pdr0">
                <div class="col-md-4 ccol-sm-4 col-xs-12 no-left-padding">
                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if ( is_front_page() && is_home() ) : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        endif;

                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php
                        endif; ?>
                    </div><!-- .site-branding -->
                </div><!-- col-md-4 -->
                <?php if ( 1 == $salient_news_customizer_all_values['salient-news-add-banner-enable'] ) { ?>
                <div class="col-md-8 col-xs-12 col-sm-12 pdl0">
                    <?php  
                        $salient_news_add_banner_image = $salient_news_customizer_all_values['salent-news-add-header-image'];
                        $salient_news_add_banner_link  = $salient_news_customizer_all_values['salient-news-add-header-link'];
                    ?>
                    
                    
                    <div class="add-image clearfix">
                        <?php if( !empty($salient_news_add_banner_image)  ) { ?>
                        <a href="<?php echo esc_url($salient_news_add_banner_link); ?>"><img class="img-responsive" src="<?php echo esc_url($salient_news_add_banner_image);?>" alt="add image"></a>
                         <?php } ?>
                    </div><!-- add image will be here -->
                   
                    
                    
                </div><!-- col-md-8 -->
                <?php } ?>
            </div><!-- col-md-12 -->
        </div><!-- container -->

        <div class="st-news-main-nav clearfix" id="st-main-navbar">
            <div class="container">
                <div class="col-md-11 col-sm-11 col-xs-11 nav-wrapper no-left-padding">
                     <button class="menu-toggler" id="menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <nav id="site-navigation" class="main-navigation">          
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                'fallback_cb'    => 'slient_news_primary_menu'
                            ) );
                        ?>
                    </nav><!-- #site-navigation -->
                </div><!-- col-md-11 -->
                <div class="col-md-1 col-xs-1 col-sm-1 pdr0">
                    <div class="random">
                        <a href="<?php echo esc_url( home_url( '/?random=1' ) ); ?> "><i class="fa fa-random"></i></a>
                    </div>
                </div><!-- xs-1 -->
            </div><!-- container -->
        </div><!-- st-news-main-nav-->
    </header><!-- #masthead -->

<?php 
}
endif;
add_action( 'salient_news_action_header', 'salient_news_header', 10 );


if ( ! function_exists( 'salient_news_navigation_page_start' ) ) :
/**
 * Skip to content
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
function salient_news_navigation_page_start() {
    global$salient_news_customizer_all_values; 
    ?>
    <?php $salient_news_recent_news = $salient_news_customizer_all_values['salient-news-header-tinker-title']
          
     ?>
    <?php if ( 1 == $salient_news_customizer_all_values['salient-news-header-enable-tinker'] ) {  ?>
    <section class="st-news-ticker">
        <div class="container">
            <div class="col-md-12 pdr0">
                <div class="col-md-2 pdr0">
                    <div class="st-ticker-heading">
                        <p><?php echo esc_html($salient_news_recent_news); ?></p>
                    </div>
                </div><!--col-md-2 -->
                    
                <div class="st-ticker-heading-content">
                    <div class="st-recent-slider">
                        <?php 
                            $salient_news_ticker_arg = array(
                                'post_type'           => 'post',
                                'posts_per_apge'       => absint($salient_news_customizer_all_values['salient-news-header-no-of-tinker']),
                                // 'cat'                  => $salient_news_customizer_all_values['salient-news-header-tincker-post-category'],

                            );
                        if( isset( $salient_news_customizer_all_values['salient-news-header-tincker-post-category'] ) && '' != $salient_news_customizer_all_values['salient-news-header-tincker-post-category'] ) {
                                $salient_news_ticker_arg['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'term_id',
                                        'terms' => $salient_news_customizer_all_values['salient-news-header-tincker-post-category'],
                                    ),
                                );

                        }
                                        // print_r($salient_news_ticker_arg );die;

                        $salient_news_ticker_query = new WP_Query($salient_news_ticker_arg);
                        if ( $salient_news_ticker_query-> have_posts()) :
                            while (  $salient_news_ticker_query-> have_posts()  ) :
                                    $salient_news_ticker_query->the_post() ; ?>
                                        <div class="st-recent-news-content">
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        </div>
                            <?php endwhile;
                                wp_reset_postdata();
                        endif;
                                    
                        ?>
                    </div><!--slider content -->
                </div><!--col-md-10 -->
                               
            </div><!--col-md-12 -->
        </div><!-- container  -->
    </section><!--news-ticker section -->

    <?php } ?>
    <div id="content" class="site-content">
    
    <?php
    }
    endif;
add_action( 'salient_news_action_nav_page_start', 'salient_news_navigation_page_start', 10 );


if( ! function_exists( 'salient_news_main_slider_setion' ) ) :
/**
 * Main slider
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function salient_news_main_slider_setion(){
        if (  is_front_page() && !is_home() ) {
            do_action('salient_news_action_main_slider');
        } else {
            /**
             * salient_news_action_after_title hook
             * @since salient-news 1.0.0
             *
             * @hooked null
             */
            do_action( 'salient_news_action_after_title' );
        }
    }
endif;
add_action( 'salient_news_action_on_header', 'salient_news_main_slider_setion', 10 );


if( ! function_exists( 'salient_news_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function salient_news_add_breadcrumb(){
        global$salient_news_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb =$salient_news_customizer_all_values['salient-news-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div class="container"><div id="breadcrumb" class="wrapper wrap-breadcrumb">';
         salient_news_simple_breadcrumb();
        echo '</div><!-- .container --></div><!-- #breadcrumb -->';
        return;
    }
endif;
add_action( 'salient_news_action_after_title', 'salient_news_add_breadcrumb', 10 );



if( ! function_exists( 'salient_news_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function salient_news_add_breadcrumb(){
        global $salient_news_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $salient_news_customizer_all_values['salient-news-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="breadcrumb-wrap">';
          echo '<div class="container">';
            salient_news_simple_breadcrumb();
          echo '</div><!-- container -->';
        echo '</div><!-- #breadcrumb -->';
    }
endif;
add_action( 'salient_news_action_after_title', 'salient_news_add_breadcrumb', 10 );