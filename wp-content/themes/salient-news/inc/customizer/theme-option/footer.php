<?php
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values*/
$salient_news_customizer_defaults['salient-news-footer-sidebar-number'] = 4;
$salient_news_customizer_defaults['salient-news-copyright-text'] = esc_html__('Copyright &copy; All right reserved.','salient-news');
$salient_news_customizer_defaults['salient-news-enable-theme-name'] = 1;

$salient_news_sections['salient-news-footer-options'] = array(
    'priority'       => 15,
    'title'          => esc_html__( 'Footer Options', 'salient-news' ),
    'panel'          => 'salient-news-theme-options'
);


$salient_news_settings_controls['salient-news-footer-sidebar-number'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-footer-sidebar-number'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Number of Sidebars In Footer Area', 'salient-news' ),
        'section'               => 'salient-news-footer-options',
        'type'                  => 'select',
        'choices'               => array(
            0 => esc_html__( 'Disable footer sidebar area', 'salient-news' ),
            1 => esc_html__( '1', 'salient-news' ),
            2 => esc_html__( '2', 'salient-news' ),
            3 => esc_html__( '3', 'salient-news' ),
            4 => esc_html__( '4', 'salient-news' )
        ),
        'priority'              => 15,
        'description'           => '',
        'active_callback'       => ''
    )
);

$salient_news_settings_controls['salient-news-copyright-text'] =
    array(
        'setting' =>  array(
            'default'              =>$salient_news_customizer_defaults['salient-news-copyright-text'],
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Copyright Text', 'salient-news' ),
            'section'               => 'salient-news-footer-options',
            'type'                  => 'text_html',
            'priority'              => 20,
        )
    );