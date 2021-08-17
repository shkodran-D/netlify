<?php 
global $salient_news_panels;
global $salient_news_sections;
global $salient_news_settings_controls;
global $salient_news_repetesd_settings_control;
global $salient_news_customizer_defaults;

// create a panel section 
$salient_news_panels['salient_news_home_main_panel'] = 
	array(
		'title'			=> esc_html__('Home/Front Page Sections','salient-news'),
		'priority'		=> 200
	);

//connect for top header menu
require get_template_directory(). '/inc/customizer/home-top-header-section/top-menu-setting.php'; 

//connect for advertisement banner
require get_template_directory(). '/inc/customizer/home-top-header-section/banner-add-setting.php'; 

//connect for tincker section
require get_template_directory(). '/inc/customizer/home-top-header-section/top-news-tincker.php'; 

//connect for tincker section
require get_template_directory(). '/inc/customizer/home-main-slider-section/slider-setting.php'; 

//connect for tincker section
require get_template_directory(). '/inc/customizer/home-latest-news-blog/setting-options.php';

// color options
require get_template_directory(). '/inc/customizer/color/color-section.php';

// font Section
require get_template_directory(). '/inc/customizer/font/font-section.php';

