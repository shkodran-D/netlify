<?php
/**
 * salient themes Theme Customizer
 *
 * @package salient themes
 * @subpackage salient-news
 * @since salient-news 1.0.0
 */
add_filter('salient_customizer_framework_url', 'salient_news_customizer_framework_url');

if( ! function_exists( 'salient_news_customizer_framework_url' ) ):

    function salient_news_customizer_framework_url(){
        return trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/salient-customizer/';
    }

endif;

add_filter('salient_customizer_framework_path', 'salient_news_customizer_framework_path');

if( ! function_exists( 'salient_news_customizer_framework_path' ) ):
    function salient_news_customizer_framework_path(){
        return trailingslashit( get_template_directory() ) . 'inc/frameworks/salient-customizer/';
    }
endif;

/*define constant for coder-customizer-constant*/
if(!defined('salient_CUSTOMIZER_NAME')){
    define('salient_CUSTOMIZER_NAME','salient_customizer_options');
}


/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since salient-news 1.0
 */
if ( ! function_exists( 'salient_news_reset_options' ) ) :
    function salient_news_reset_options( $reset_options ) {
        set_theme_mod( salient_CUSTOMIZER_NAME, $reset_options );
    }
endif;
/**
 * Customizer framework added.
 */
require get_template_directory().'/inc/frameworks/salient-customizer/salient-customizer.php';

global $salient_news_panels;
global $salient_news_sections;
global $salient_news_settings_controls;
global $salient_news_repeated_settings_controls;
global $salient_news_customizer_defaults;

/*customizer design develop section*/
require get_template_directory().'/inc/customizer/main-panel.php';

/*customizer theme option's section*/
require get_template_directory().'/inc/customizer/theme-option/option-panel.php';


/*Resetting all Values*/
/**
 * Reset color settings to default
 * @param  $input
 *
 * @since salient-news 1.0
 */
global $salient_news_customizer_defaults;
$salient_news_customizer_defaults['salient-news-customizer-reset'] = '';
if ( ! function_exists( 'salient_news_customizer_reset' ) ) :
    function salient_news_customizer_reset( ) {
        global $salient_news_customizer_saved_values;
        $salient_news_customizer_saved_values = salient_news_get_all_options();
        if ( $salient_news_customizer_saved_values['salient-news-customizer-reset'] == 1 ) {
            global $salient_news_customizer_defaults;

            $salient_news_customizer_defaults['salient-news-customizer-reset'] = '';
            /*resetting fields*/
            salient_news_reset_options( $salient_news_customizer_defaults );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','salient_news_customizer_reset' );


/**
 * salient-news Theme Customizer
 *
 * @package salient-news
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function salient_news_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    // $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'salient_news_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'salient_news_customize_partial_blogdescription',
        ) );
    }
}
add_action( 'customize_register', 'salient_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function salient_news_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function salient_news_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/******************************************
Removing section setting control
 *******************************************/

$salient_news_customizer_args = array(
    'panels'            => $salient_news_panels, /*always use key panels */
    'sections'          => $salient_news_sections,/*always use key sections*/
    'settings_controls' => $salient_news_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $salient_news_repeated_settings_controls,/*always use key sections*/
);

/*registering panel section setting and control start*/
function salient_news_add_panels_sections_settings() {
    global $salient_news_customizer_args;
    return $salient_news_customizer_args;
}
add_filter( 'salient_customizer_panels_sections_settings', 'salient_news_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function salient_news_customize_preview_js() {
    wp_enqueue_script( 'salient-news-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'salient_news_customize_preview_js' );


/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since salient-news 1.0
 */
if ( ! function_exists( 'salient_news_get_all_options' ) ) :
    function salient_news_get_all_options( $merge_default = 0 ) {
        $salient_news_customizer_saved_values = salient_customizer_get_all_values( );
        if( 1 == $merge_default ){
            global $salient_news_customizer_defaults;
            if(is_array( $salient_news_customizer_saved_values )){
                $salient_news_customizer_saved_values = array_merge($salient_news_customizer_defaults, $salient_news_customizer_saved_values );
            }
            else{
                $salient_news_customizer_saved_values = $salient_news_customizer_defaults;
            }
        }
        return $salient_news_customizer_saved_values;
        
    }
endif;
