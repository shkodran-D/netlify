<?php
global $salient_news_panels;
global $salient_news_sections;
global $salient_news_settings_controls;
global $salient_news_repeated_settings_controls;
global $salient_news_customizer_defaults;


// default value
$salient_news_customizer_defaults['salient-news-add-banner-enable'] = 1;
$salient_news_customizer_defaults['salent-news-add-header-image'] = get_template_directory_uri().'/assets/images/banner.png';
$salient_news_customizer_defaults['salient-news-add-header-link'] = '#';

// cvreate a section for advertisement 
$salient_news_sections['salient-news-advertisement-section'] =  array(
	'title'				=> esc_html__('Advertisement','salient-news'),
	'panel'				=> 'salient_news_home_main_panel',
	'priority'			=> 20
);

// enbale for 	advertisement section
$salient_news_settings_controls['salient-news-add-banner-enable'] = array(
	'setting' => array(
	'default' => $salient_news_customizer_defaults['salient-news-add-banner-enable']
	),
	'control'=> array(
		'label'					=>  esc_html__('Enable Advertisement','salient-news'),
		'section'				=> 'salient-news-advertisement-section',
		'type'					=> 'checkbox',
		'priority'				=> 10,
		'active_callback'		=> ''

	)
);

// image uplode for	advertisement section
$salient_news_settings_controls['salent-news-add-header-image'] =  array(
	'setting' => array(
	'default' => $salient_news_customizer_defaults['salent-news-add-header-image']
	),
	'control'=> array(
		'label'					=>  esc_html__('Uplode Advertisement Banner','salient-news'),
		'description'           =>  __( 'Upload Image to be on header advertisement banner (recomended size 726px*90px)', 'salient-news' ),
		'section'				=> 'salient-news-advertisement-section',
		'type'					=> 'image',
		'priority'				=> 20,
		'active_callback'		=> '',
		// 'width'                  => 1000,
		// 'height'                 => 250,
		// 'flex-height'            => true,

	)
);

// url link  for	advertisement section
$salient_news_settings_controls['salient-news-add-header-link'] =  array(
	'setting' => array(
	'default' => $salient_news_customizer_defaults['salient-news-add-header-link']
	),
	'control' => array(
		'label'					=>  esc_html__('Link For Advertisement Banner','salient-news'),
		'section'				=> 'salient-news-advertisement-section',
		'type'					=> 'url',
		'priority'				=> 30,
		'active_callback'		=> ''

	)
);
