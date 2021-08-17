<?php 

global $salient_news_panels;
global $salient_news_sections;
global $salient_news_settings_controls;
global $salient_news_repetesd_settings_controls;
global $salient_news_customizer_defaults;

// create a panel section 
$salient_news_customizer_defaults['salient-news-top-socail-menu-enable']	= 1;

// create  a top-header section
$salient_news_sections['salient-news-top-header-section'] = array(
	'title'				=> esc_html__('Top-Header','salient-news'),
	'panel'				=> 'salient_news_home_main_panel',
	'priority'			=> 10
);

// social icon enable option
$salient_news_settings_controls['salient-news-top-socail-menu-enable']  = array(
	'setting' => array(
		'default' => $salient_news_customizer_defaults['salient-news-top-socail-menu-enable']			
	),
	'control'  => array(
		'label'				=> esc_html__('Enable Social Menu','salient-news' ),
		'section'			=> 'salient-news-top-header-section',
		'type'				=> 'checkbox',
		'priority'			=> 10,
		'active_callback'	=> ''
	)
);

	