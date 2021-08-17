<?php
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values*/
$salient_news_customizer_defaults['salient-news-enable-static-page']        = 0;
$salient_news_customizer_defaults['salient-news-default-layout']            = 'right-sidebar';
$salient_news_customizer_defaults['salient-news-single-post-image-align']   = 'full';
$salient_news_customizer_defaults['salient-news-excerpt-length']            = '50';
$salient_news_customizer_defaults['salient-news-archive-layout']            = 'thumbnail-and-excerpt';
$salient_news_customizer_defaults['salient-news-archive-image-align']       = 'full';

$salient_news_sections['salient-news-layout-options'] = array(
    'priority'       => 20,
    'title'          => esc_html__( 'Layout Options', 'salient-news' ),
    'panel'          => 'salient-news-theme-options',
);

    /*home page static page display*/
$salient_news_settings_controls['salient-news-enable-static-page'] = array(
'setting' => array(
    'default' => $salient_news_customizer_defaults['salient-news-enable-static-page'],
),
'control' => array(
    'label'                 =>  esc_html__( 'Enable Static Front Page', 'salient-news' ),
    'description'           =>  esc_html__( 'If you disable this the static page will be disappera form the home page and other section from customizer will reamin as it is', 'salient-news' ),
    'section'               => 'salient-news-layout-options',
    'type'                  => 'checkbox',
    'priority'              => 10,
)
);
/*layout-options option responsive lodader start*/

$salient_news_settings_controls['salient-news-default-layout'] = array(
    'setting' =>  array(
        'default'              =>$salient_news_customizer_defaults['salient-news-default-layout'],
    ),
    'control' => array(
        'label'                     =>  esc_html__( 'Default Layout', 'salient-news' ),
        'description'               =>  esc_html__( 'Please note that this section can be overridden for individual page/posts', 'salient-news' ),
        'section'                   => 'salient-news-layout-options',
        'type'                      => 'select',
        'choices' => array(
            'right-sidebar'    => esc_html__( 'Content - Primary Sidebar', 'salient-news' ),
            'left-sidebar'     => esc_html__( 'Primary Sidebar - Content', 'salient-news' ),
            'no-sidebar'       => esc_html__( 'No Sidebar', 'salient-news' )
        ),
        'priority'              => 10,
        'active_callback'       => ''
    )
);


$salient_news_settings_controls['salient-news-single-post-image-align'] = array(
    'setting' =>  array(
        'default'  =>$salient_news_customizer_defaults['salient-news-single-post-image-align'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Alignment Of Image In Single Post/Page', 'salient-news' ),
        'section'               => 'salient-news-layout-options',
        'type'                  => 'select',
        'choices'               => array(
            'full'      => esc_html__( 'Full', 'salient-news' ),
            'right'     => esc_html__( 'Right', 'salient-news' ),
            'left'      => esc_html__( 'Left', 'salient-news' ),
            'no-image'  => esc_html__( 'No image', 'salient-news' )
        ),
        'priority'              => 40,
        'description'           =>  esc_html__( 'Please note that this setting can be override from individual post/page', 'salient-news' ),
    )
);

   $salient_news_settings_controls['salient-news-excerpt-length'] =
        array(
            'setting' =>     array(
                'default'  =>  $salient_news_customizer_defaults['salient-news-excerpt-length'],
            ),
            'control' => array(
                'label'                 =>  esc_html__( 'Excerpt Length (in words)', 'salient-news' ),
                'section'               => 'salient-news-layout-options',
                'type'                  => 'number',
                'priority'              => 40,
            )
        );

$salient_news_settings_controls['salient-news-archive-layout'] = array(
    'setting' =>  array(
        'default'              =>$salient_news_customizer_defaults['salient-news-archive-layout'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Archive Layout', 'salient-news' ),
        'section'               => 'salient-news-layout-options',
        'type'                  => 'select',
        'choices'               => array(
            'excerpt-only' => esc_html__( 'Excerpt Only', 'salient-news' ),
            'thumbnail-and-excerpt' => esc_html__( 'Thumbnail and Excerpt', 'salient-news' ),
            'full-post' => esc_html__( 'Full Post', 'salient-news' ),
            'thumbnail-and-full-post' => esc_html__( 'Thumbnail and Full Post', 'salient-news' ),
        ),
        'priority'              => 55,
    )
);