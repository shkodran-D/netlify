<?php 
global$salient_news_panels;
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

// default value
$salient_news_customizer_defaults['salient-news-header-enable-tinker'] = 1;
$salient_news_customizer_defaults['salient-news-header-tinker-title'] = esc_html__('Recent News','salient-news');
$salient_news_customizer_defaults['salient-news-header-no-of-tinker'] = 5;
$salient_news_customizer_defaults['salient-news-header-enable-date'] = 1;
$salient_news_customizer_defaults['salient-news-header-tincker-post-category'] = 0;

// create  a top-header section
$salient_news_sections['salient-news-top-header-tincker-section'] = array(
	'title'				=> esc_html__('Top-Header-Ticker','salient-news'),
	'panel'				=> 'salient_news_home_main_panel',
	'priority'			=> 30
);

// create a section for top-tinker
$salient_news_settings_controls['salient-news-header-enable-tinker'] = array(
    'setting' => array(
        'default'  =>$salient_news_customizer_defaults['salient-news-header-enable-tinker'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Header Tiker Enable', 'salient-news' ),
        'section'               => 'salient-news-top-header-tincker-section',
        'type'                  => 'checkbox',
        'priority'              => 20,
    )
);

$salient_news_settings_controls['salient-news-header-tinker-title'] = array(
    'setting' => array(
        'default'              =>$salient_news_customizer_defaults['salient-news-header-tinker-title'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Header Tinker Title', 'salient-news' ),
        'section'               => 'salient-news-top-header-tincker-section',
        'type'                  => 'text',
        'priority'              => 25,
    )
);

$salient_news_settings_controls['salient-news-header-no-of-tinker'] = array(
    'setting' => array(
        'default'              =>$salient_news_customizer_defaults['salient-news-header-no-of-tinker'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'No of Tinker to Display', 'salient-news' ),
        'section'               => 'salient-news-top-header-tincker-section',
        'type'                  => 'number',
        'priority'              => 30,
        'active_callback'       => '',
        'input_attrs' => array( 'min' => 1, 'max' => 20),
    )
);

$salient_news_settings_controls['salient-news-header-tincker-post-category'] = array(
    'setting' =>     array(
        'default'              =>$salient_news_customizer_defaults['salient-news-header-tincker-post-category'],
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Select Category For Recent News', 'salient-news' ),
        'section'               => 'salient-news-top-header-tincker-section',
        'type'                  => 'category_dropdown',
        'priority'              => 50,
        'active_callback'       => ''
    )
);