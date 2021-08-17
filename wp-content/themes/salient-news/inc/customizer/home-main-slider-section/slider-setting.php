<?php

global$salient_news_panels;
global$salient_news_sections;
global$salient_news_settings_controls;
global$salient_news_repeated_settings_controls;
global$salient_news_customizer_defaults;

/*defaults values feature trip options*/
$salient_news_customizer_defaults['salient-news-feature-slider-enable'] = 1;
$salient_news_customizer_defaults['salient-news-feature-slider-number'] = 4;
$salient_news_customizer_defaults['salient-news-feature-slider-right-blog-number'] = 4;
$salient_news_customizer_defaults['salient-news-featured-slider-category'] = 0;
$salient_news_customizer_defaults['salient-news-fs-enable-title'] = 1;
$salient_news_customizer_defaults['salient-news-select-cat-post']   = 0;

/*feature slider enable setting*/
$salient_news_sections['salient-news-feature-section-options'] =
    array(
    	'title'          => esc_html__( 'Home-Main-Slider', 'salient-news' ),
        'panel'          => 'salient_news_home_main_panel',
    	'priority'       => 40
    );

/*Feature section enable control*/
$salient_news_settings_controls['salient-news-feature-slider-enable'] = array(
    'setting' => array(
        'default' => $salient_news_customizer_defaults['salient-news-feature-slider-enable']
    ),
    'control' => array(
        'label'                 =>  esc_html__( 'Enable Feature Slider', 'salient-news' ),
        'section'               => 'salient-news-feature-section-options',
    	'description'    		=> esc_html__( 'Enable "Feature slider" on checked' , 'salient-news' ),
        'type'                  => 'checkbox',
        'priority'              => 10,
        'active_callback'       => ''
    )
);


/*No of feature slider selection*/
$salient_news_settings_controls['salient-news-feature-slider-number'] =
    array(
        'setting' =>  array(
            'default'              =>$salient_news_customizer_defaults['salient-news-feature-slider-number']
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Number Of Slider', 'salient-news' ),
            'description'           => esc_html__( 'You need to have more than two post on that category to make slider section working properly' , 'salient-news' ),
            'section'               => 'salient-news-feature-section-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => esc_html__( '1', 'salient-news' ),
                2 => esc_html__( '2', 'salient-news' ),
                3 => esc_html__( '3', 'salient-news' ),
                4 => esc_html__( '4', 'salient-news' ),

            ),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

/*creating setting control for salient-news-fs-Category start*/
$salient_news_settings_controls['salient-news-featured-slider-category'] =
    array(
        'setting' => array(
            'default'  =>  $salient_news_customizer_defaults['salient-news-featured-slider-category']
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Select Category For Slider', 'salient-news' ),
            'description'           =>  esc_html__( 'If you have only choosen category then slider will dispaly form it, if not then will display latest post', 'salient-news' ),
            'section'               => 'salient-news-feature-section-options',
            'type'                  => 'category_dropdown',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

/*No of feature slider selection*/
$salient_news_settings_controls['salient-news-feature-slider-right-blog-number'] =
    array(
        'setting' =>  array(
            'default'              =>$salient_news_customizer_defaults['salient-news-feature-slider-right-blog-number']
        ),
        'control' => array(
            'label'                 =>  esc_html__( 'Number Of Slider Right Blog', 'salient-news' ),
            'section'               => 'salient-news-feature-section-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => esc_html__( '1', 'salient-news' ),
                2 => esc_html__( '2', 'salient-news' ),
                3 => esc_html__( '3', 'salient-news' ),
                4 => esc_html__( '4', 'salient-news' )
            ),
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

// create a category dropdown
$salient_news_settings_controls['salient-news-select-cat-post'] =  array(
    'setting'  => array(
        'default' => $salient_news_customizer_defaults['salient-news-select-cat-post']
    ),
    'control'  => array(
        'label'                 => esc_html__('Select Category For Right Section Blog','salient-news'),
        'section'               => 'salient-news-feature-section-options',
        'type'                  => 'category_dropdown',
        'priority'              => 50,
        'active_callback'       => ''
    )
);