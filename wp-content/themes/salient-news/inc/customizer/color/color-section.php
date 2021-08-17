<?php
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values*/
$salient_news_customizer_defaults['salient-news-site-identity-color'] = '#313131';
$salient_news_customizer_defaults['salient-news-primary-color'] = '#0288d1';
$salient_news_customizer_defaults['salient-news-heading-section-title-color'] = '#000000';
$salient_news_customizer_defaults['salient-news-post-page-title-color'] = '#000000';
$salient_news_customizer_defaults['salient-news-tincket-color'] = '#000000';
$salient_news_customizer_defaults['salient-news-menu-background-color'] = '#1a2431'; 
$salient_news_customizer_defaults['salient-news-menu-text-color'] = '#fff';
$salient_news_customizer_defaults['salient-news-color-reset'] = '';



/*Default color*/
$salient_news_sections['colors'] = array(
        'priority'       => 40,
        'title'          => esc_html__( 'Colors Options', 'salient-news' )
    );



/**
 * Reset color settings to default
 *
 * @since salient-news 1.0.0
 */
if ( ! function_exists( 'salient_news_color_reset' ) ) :
    function salient_news_color_reset( ) {
        
        global$salient_news_customizer_saved_values;
        $salient_news_customizer_saved_values = salient_news_get_all_options();
      
        if ( 1 == intval($salient_news_customizer_saved_values['salient-news-color-reset'] ) ) {
            global$salient_news_customizer_defaults;
            /*getting fields*/

            /*setting fields */
           $salient_news_customizer_saved_values['salient-news-site-identity-color']            = $salient_news_customizer_defaults['salient-news-site-identity-color'] ;
           $salient_news_customizer_saved_values['salient-news-primary-color']                  = $salient_news_customizer_defaults['salient-news-primary-color'] ;
           $salient_news_customizer_saved_values['salient-news-heading-section-title-color']     = $salient_news_customizer_defaults['salient-news-heading-section-title-color'];
           $salient_news_customizer_saved_values['salient-news-post-page-title-color']          = $salient_news_customizer_defaults['salient-news-post-page-title-color'];
           $salient_news_customizer_saved_values['salient-news-menu-background-color']          = $salient_news_customizer_defaults['salient-news-menu-background-color'];
           $salient_news_customizer_saved_values['salient-news-menu-text-color']                = $salient_news_customizer_defaults['salient-news-menu-text-color'];
           $salient_news_customizer_saved_values['salient-news-tincket-color']                  = $salient_news_customizer_defaults['salient-news-tincket-color'];

            remove_theme_mod( 'background_color' );
           $salient_news_customizer_saved_values['salient-news-color-reset']                    = '';

            /*resetting fields*/
            salient_news_reset_options($salient_news_customizer_saved_values );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','salient_news_color_reset' );




$salient_news_settings_controls['salient-news-site-identity-color'] = array(
    'setting' =>  array(
        'default'  => $salient_news_customizer_defaults['salient-news-site-identity-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Site Identity Color', 'salient-news' ),
        'description'           =>  esc_html__( 'Site title and tagline color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 20,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-primary-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-primary-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Primary Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 30,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-menu-background-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-menu-background-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Menu background Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 35,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-menu-text-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-menu-text-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Menu text Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 40,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-heading-section-title-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-heading-section-title-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Section Heading Title Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 45,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-post-page-title-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-post-page-title-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Post Page Title Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 50,
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-tincket-color'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-tincket-color'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Ticker  Color', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'color',
        'priority'              => 60,
        'active_callback'       => ''
    )
);


$salient_news_settings_controls['salient-news-color-reset'] = array(
    'setting' => array(
        'default'   => $salient_news_customizer_defaults['salient-news-color-reset'],
        'transport'            => 'postmessage',
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Reset', 'salient-news' ),
        'description'           =>  esc_html__( 'Caution: Reset all color settings above to default. Refresh the page after saving to view the effects', 'salient-news' ),
        'section'               => 'colors',
        'type'                  => 'checkbox',
        'priority'              => 220,
        'active_callback'       => ''
    )
);