<?php
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values*/
$salient_news_customizer_defaults['salient-news-enable-back-to-top'] = 1;

$salient_news_sections['salient-news-back-to-top-options'] = array(
    'priority'       => 80,
    'title'          => esc_html__( 'Back To Top Options', 'salient-news' ),
    'panel'          => 'salient-news-theme-options'
);

$salient_news_settings_controls['salient-news-enable-back-to-top'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-enable-back-to-top'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Enable Back To Top', 'salient-news' ),
        'section'               => 'salient-news-back-to-top-options',
        'type'                  => 'checkbox',
        'priority'              => 50,
    )
);