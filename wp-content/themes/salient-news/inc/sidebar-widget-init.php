<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function salient_news_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'salient-news' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Home/Main Front Page Widget', 'salient-news' ),
        'id'            => 'homepage-main-section',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Home/Front Page Full Width Widget', 'salient-news' ),
        'id'            => 'full-width-widget',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__('Home/Front Page Sidebar Widget','salient-news'),
        'id'            => 'front-sidebar-tab-widget',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class= "widget-title">',
        'after_title'   => '</h2>',
    ) );

   $salient_news_get_all_options = salient_news_get_all_options(1);
   $salient_news_footer_widgets_number =$salient_news_get_all_options['salient-news-footer-sidebar-number'];

    if($salient_news_footer_widgets_number > 0 ){
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'salient-news'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.','salient-news'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        if($salient_news_footer_widgets_number > 1 ){
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'salient-news'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.','salient-news'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
        if($salient_news_footer_widgets_number > 2 ){
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'salient-news'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.','salient-news'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
        if($salient_news_footer_widgets_number > 3 ){
            register_sidebar(array(
                'name' => esc_html__('Footer Column Four', 'salient-news'),
                'id' => 'footer-col-four',
                'description' => esc_html__('Displays items on footer section.','salient-news'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
    }
}
add_action( 'widgets_init', 'salient_news_widgets_init' );

require get_template_directory() . '/inc/widgets/mainpage-widgets-style1.php';
require get_template_directory() . '/inc/widgets/mainpage-widgets-style2.php';
require get_template_directory() . '/inc/widgets/mainpage-widgets-style3.php';
require get_template_directory() . '/inc/widgets/mainpage-salient-tab-widget.php';
require get_template_directory() . '/inc/widgets/mainpage-sidbar-slider-widget.php';
require get_template_directory() . '/inc/widgets/mainpage-salient-widget-author.php';
