<?php
global $salient_news_panels;
global $salient_news_sections;
global $salient_news_settings_controls;
global $salient_news_repetesd_settings_control;
global $salient_news_customizer_defaults;

// defaults value;
$salient_news_customizer_defaults['salient-news-enable-latest-news'] 			= 1;
$salient_news_customizer_defaults['salient-news-latest-news-main-title'] 		= esc_html__('LATEST NEWS','salient-news');
$salient_news_customizer_defaults['salient-news-single-number-of-word']   		= 25;
$salient_news_customizer_defaults['salient-news-lates-news-number-of-post'] 	= 3;
$salient_news_customizer_defaults['salient-news-latest-blog-from-cat'] 			= 0;

// create a section for
$salient_news_sections['salient-news-latest-news-section'] = array(
	'title'								=> esc_html__('Latest-News','salient-news'),
	'panel'								=> 'salient_news_home_main_panel',
	'priority'							=>60
);

// create a enable button for latest news blog
$salient_news_settings_controls['salient-news-enable-latest-news'] = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-enable-latest-news']
	),
	'control' => array(
		'label'							=> esc_html__('Enable Latest News','salient-news'),
		'section'						=> 'salient-news-latest-news-section',
		'type'							=> 'checkbox',
		'priority'						=> 10,
		'active_callback'				=> ''
	)
);

// create a enable button for latest news blog
$salient_news_settings_controls['salient-news-latest-news-main-title'] = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-latest-news-main-title']
	),
	'control' => array(
		'label'							=> esc_html__('Main Title','salient-news'),
		'section'						=> 'salient-news-latest-news-section',
		'type'							=> 'text',
		'priority'						=> 20,
		'active_callback'				=> ''
	)
);

// create a single number for latest news blog
$salient_news_settings_controls['salient-news-lates-news-number-of-post'] = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-lates-news-number-of-post']
	),
	'control' => array(
		'label'							=> esc_html__('Select Number of Post','salient-news'),
		'section'						=> 'salient-news-latest-news-section',
		'type'							=> 'number',
		'priority'						=> 40,
		'active_callback'				=> ''
	)
);

// creat a select option for latest news 
$salient_news_settings_controls['salient-news-single-number-of-word'] = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-single-number-of-word']
	),
	'control' => array(
		'label'							=> esc_html__('Select Number of World','salient-news'),
		'section'						=> 'salient-news-latest-news-section',
		'type'							=> 'number',
		'inupt_attr'					=> array('min' => 1, 'max' => 400),
		'priority'						=> 30,
		'active_callback'				=> ''
	)
);

// create a category vchoes  for latest news blog
$salient_news_settings_controls['salient-news-latest-blog-from-cat'] = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-latest-blog-from-cat']
	),
	'control' => array(
		'label'							=> esc_html__('Select Category Post','salient-news'),
		'section'						=> 'salient-news-latest-news-section',
		'type'							=> 'category_dropdown',
		'priority'						=> 50,
		'active_callback'				=> ''
	)
);
