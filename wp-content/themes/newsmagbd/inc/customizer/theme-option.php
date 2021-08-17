<?php 

/**
 * Theme Options Panel.
 *
 * @package newsmagbd
 */

$default = newsmagbd_get_default_theme_options();



// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'newsmagbd' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	)
);

// Global Section Start.*/

$wp_customize->add_section( 'social_option_section_settings',
	array(
		'title'      => esc_html__( 'Social Profile Options', 'newsmagbd' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Social Profile*/
		$wp_customize->add_setting( 'social_profile',
			array(
				'default'           => $default['social_profile'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsmagbd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_profile',
			array(
				'label'    => esc_html__( 'Global Social Profile ( Top Right )', 'newsmagbd' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
	
	
		/*
		Social media
		*/
		$sornacommerce_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-linkedin']= array(
			'label' => esc_html__('Linkedin URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-google-plus']= array(
			'label' => esc_html__('Google-plus URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-pinterest']= array(
			'label' => esc_html__('pinterest URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'newsmagbd')
		);
		$sornacommerce_options['social']['fa-reddit']= array(
			'label' => esc_html__('Reddit URL', 'newsmagbd')
		);
		foreach( $sornacommerce_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					$wp_customize->add_setting('newsmagbd_social_profile_link['.$key .']['. $k .']',
						array(
							'default'           => $default['social_profile_link'],
							'capability'     => 'edit_theme_options',
							'sanitize_callback' => 'esc_url_raw'
						)
					);
					// CONTROLS
					$wp_customize->add_control('newsmagbd_social_profile_link['.$key .']['. $k .']', 
						array(
							'label' => $val['label'], 
							'section'    => 'social_option_section_settings',
							'type'     => 'text',
							
						)
					);
				}
			
			endforeach;
		endforeach;


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'newsmagbd' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		
		
		
		/*content excerpt in global*/
		$wp_customize->add_setting( 'excerpt_length_blog',
			array(
				'default'           => $default['excerpt_length_blog'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsmagbd_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control( 'excerpt_length_blog',
			array(
				'label'    => esc_html__( 'Set Blog Excerpt Length', 'newsmagbd' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'number',
				'priority' => 175,
				'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),
		
			)
		);
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsmagbd_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Blog Looop Content', 'newsmagbd' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt-only' => __( 'Excerpt Only', 'newsmagbd' ),
					'full-post' => __( 'Full Post', 'newsmagbd' ),
					),
				'type'     => 'select',
				'priority' => 180,
			)
		);
		
		
		


// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'newsmagbd' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'newsmagbd' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);



// Slider Main Section.
$wp_customize->add_section( 'news_ticker_section',
	array(
		'title'      => esc_html__( 'Breaking News', 'newsmagbd' ),
		'priority'   => 95,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	// Setting - show_slider_section.
	$wp_customize->add_setting( 'show_news_ticker_section_settings',
		array(
			'default'           => $default['show_news_ticker_section_settings'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newsmagbd_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'show_news_ticker_section_settings',
		array(
			'label'    => esc_html__( 'Enable Breaking News', 'newsmagbd' ),
			'section'  => 'news_ticker_section',
			'type'     => 'checkbox',
			'priority' => 100,
		)
	);
	// Setting news_ticker_number.
	$wp_customize->add_setting( 'news_ticker_title',
		array(
		'default'           => $default['news_ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'news_ticker_title',
		array(
		'label'    => esc_html__( 'Title', 'newsmagbd' ),
		'section'  => 'news_ticker_section',
		'type'     => 'text',
		'priority' => 120,
		)
	);
	// Setting news_ticker_number.
	$wp_customize->add_setting( 'news_ticker_number',
		array(
		'default'           => $default['news_ticker_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 'news_ticker_number',
		array(
		'label'    => esc_html__( 'Number of News', 'newsmagbd' ),
		'section'  => 'news_ticker_section',
		'type'     => 'number',
		'priority' => 120,
		)
	);
	// Setting - drop down category for News.
	$wp_customize->add_setting( 'select_category_for_news_ticker',
		array(
			'default'           => $default['select_category_for_news_ticker'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( new NewsMagBd_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_news_ticker',
		array(
			'label'           => __( 'Category for Breaking News', 'newsmagbd' ),
			'description'     => __( 'Select category to be shown on news ticker ', 'newsmagbd' ),
			'section'         => 'news_ticker_section',
			'type'            => 'dropdown-taxonomies',
			'taxonomy'        => 'category',
			'priority'    	  => 130,
	
		) ) );


