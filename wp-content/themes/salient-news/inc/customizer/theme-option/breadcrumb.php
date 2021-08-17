<?php
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values*/
$salient_news_customizer_defaults['salient-news-enable-breadcrumb'] = 1;

$salient_news_sections['salient-news-breadcrumb-options'] = array(
    'priority'       => 50,
    'title'          => esc_html__( 'Breadcrumb Options', 'salient-news' ),
    'panel'          => 'salient-news-theme-options',
);

$salient_news_settings_controls['salient-news-enable-breadcrumb'] = array(
    'setting' =>     array(
        'default'              =>$salient_news_customizer_defaults['salient-news-enable-breadcrumb'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Enable Breadcrumb', 'salient-news' ),
        'section'               => 'salient-news-breadcrumb-options',
        'type'                  => 'checkbox',
        'priority'              => 10,
    )
);