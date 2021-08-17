<?php
/**
 * news functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package news
 */

require get_template_directory() . '/inc/init.php';

if ( ! function_exists( 'salient_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function salient_news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on news, use a find and replace
		 * to change 'news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'salient-news', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' 	=> esc_html__( 'Primary', 'salient-news' ),
			'top-menu' 	=> esc_html__( 'top-menu', 'salient-news' ),
			'social' 	=> esc_html__( 'Social Menu', 'salient-news' ),
		) );
		//add active class on active nav 
		add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
		function add_active_class($classes, $item) {
		  if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
		    $classes[] = "active";
		  }

		  return $classes;
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_image_size( 'lates-news-blog',275, 155, false );
		add_image_size( 'salient-news-slider',570, 340, false );
		add_image_size( 'lates-news-blog',365, 217, false );

		// if (function_exists('add_image_size')){
		// 	add_image_size( 'author-image',150,150, true);

		// }


		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'salient_news_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		
		add_image_size( 'salient-news-author-image', 150, 150, true );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'salient_news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function salient_news_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'salient_news_content_width', 640 );
}
add_action( 'after_setup_theme', 'salient_news_content_width', 0 );


function salient_news_google_fonts()
{
	global $salient_news_customizer_all_values;
	$fonts_url = '';
	$fonts     = array();

	$salient_news_font_family_site_identity = $salient_news_customizer_all_values['salient-news-font-family-site-identity'];
	$salient_news_font_family_menu = $salient_news_customizer_all_values['salient-news-font-family-menu'];
	$salient_news_font_family_h1_h6 = $salient_news_customizer_all_values['salient-news-font-family-h1-h6'];

	$salient_news_pro_fonts = array();
	$salient_news_pro_fonts[]=$salient_news_font_family_site_identity;
	$salient_news_pro_fonts[]=$salient_news_font_family_menu;
	$salient_news_pro_fonts[]=$salient_news_font_family_h1_h6;

	 $salient_news_pro_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	  $i  = 0;
	  for ($i=0; $i < count( $salient_news_pro_fonts ); $i++) { 

	    if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'salient-news' ), $salient_news_pro_fonts[$i] ) ) {
			$fonts[] = $salient_news_pro_fonts[$i];
		}

	  }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urldecode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

// remove category tag 
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

/*update to pro link*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/salient-news/class-customize.php' );

/**
 * Enqueue scripts and styles.
 */
function news_scripts() {

	/*google font*/
	// google font
	wp_enqueue_style( 'salient-news-google-fonts', salient_news_google_fonts() );
	//root path for style and scripts
	$assets_url = get_template_directory_uri() .'/assets';
	wp_enqueue_style( 'news-style', get_stylesheet_uri() );

	//bootstrap
	wp_enqueue_style( 'bootstrap-style', $assets_url . '/vendor/bootstrap/bootstrap.css', array());/*added*/

	
	wp_enqueue_style( 'salient-news-google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,500,600,600i,700');	
	wp_enqueue_style( 'salient-news-font-awesome', $assets_url . '/vendor/font-awesome/css/font-awesome.css', array());

	//slick
	wp_enqueue_style( 'slick-style', $assets_url . '/vendor/slick/slick.css', array());/*added*/
	wp_enqueue_style( 'slick-theme', $assets_url . '/vendor/slick/slick.theme.css', array());/*added*/
	wp_enqueue_script( 'news-navigation', $assets_url . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'news-skip-link-focus-fix', $assets_url . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'bootstrap', $assets_url . '/vendor/bootstrap/bootstrap.js',array( 'jquery' ), true );
	wp_enqueue_script( 'slick-script', $assets_url . '/vendor/slick/slick.js', array(), true );
	wp_enqueue_script( 'jquery-sticky', $assets_url . '/vendor/jquery.sticky.js', array(), true );

	wp_enqueue_script( 'custom', $assets_url . '/custom/main.js', array( 'jquery' ), true );
	wp_enqueue_script( 'custom-mobile-menu', $assets_url . '/custom/mobile-menu.js', array( 'jquery' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    wp_add_inline_style( 'salient-news-style', salient_news_inline_style() );
}
add_action( 'wp_enqueue_scripts', 'news_scripts' );

/*added admin css for meta*/
function salient_news_wp_admin_style($hook) {
	
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_media();
		wp_enqueue_script( 'salient-news-widgets-script', get_template_directory_uri() . '/assets/js/widgets.js', array( 'jquery' ), '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'salient_news_wp_admin_style' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

 //* Custom functions that act independently of the theme templates.
 //
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


if ( !function_exists('slient_news_top_menu') ) :
	/**
	 * Fallback menu to top-menu
	 * 
	 * @since  salient-news 1.0.1
	 */
function slient_news_top_menu()
{
	?>
		<ul id="menu">
			<li><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e('Home','salient-news');?></a></li>
			<li><a href="<?php echo esc_url( admin_url( '/nav-menus.php' ) );?>"><?php esc_html_e('Set Primary Menu','salient-news');?></a></li>
		</ul>
	<?php
}
endif;

if ( !function_exists('slient_news_primary_menu')  ) :
	/**
	 * Fallback menu to primary-menu
	 * 
	 * @since  salient-news 1.0.1
	 */
	function slient_news_primary_menu()
	{

		?>
		<ul id="menu">
			<li><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e('Home','salient-news');?></a></li>
			<li><a href="<?php echo esc_url( admin_url( '/nav-menus.php' ) );?>"><?php esc_html_e('Set Primary Menu','salient-news');?></a></li>
		</ul>
	<?php
	}
endif;

if  ( !function_exists('slient_news_social_menu') ) :
	/**
	 * Fallback menu to social menu
	 * 
	 * @since  salient-news 1.0.1
	 */
	function slient_news_social_menu()
	{?>
		<ul id="menu">
			<li><a href="https://www.wordpress.org/" target="_tab"><?php echo esc_html_e('wordpress', 'salient-news' );?></a></li>
			
		</ul>
	<?php
	}

endif;


/*breadcrum function*/

if ( ! function_exists( 'salient_news_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function salient_news_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/frameworks/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;

/**
*Inline style to use color options
**/
if( ! function_exists( 'salient_news_inline_style' ) ) :

    /**
     * style to use color options
     *
     * @since  flare 1.0.1
     */
    function salient_news_inline_style()
    {
      
        global $salient_news_customizer_all_values;

        global $salient_news_google_fonts;
        $salient_news_customizer_defaults['salient-news-font-family-site-identity'] = 'Raleway:400,300,500,600,700,900';
        $salient_news_customizer_defaults['salient-news--font-family-menu'] = 'Raleway:400,300,500,600,700,900';

        $salient_news_font_family_site_identity = $salient_news_google_fonts[$salient_news_customizer_all_values['salient-news-font-family-site-identity']];

        $salient_news_font_family_menu = $salient_news_google_fonts[$salient_news_customizer_all_values['salient-news-font-family-menu']];
        $salient_news_font_family_h1_h6 = $salient_news_google_fonts[$salient_news_customizer_all_values['salient-news-font-family-h1-h6']];
        

        
        
        //*color options*/
        $salient_news_background_color 				= get_background_color();
        $salient_news_primary_color_option 			= $salient_news_customizer_all_values['salient-news-primary-color'];
        $salient_news_site_identity_color_option 	= $salient_news_customizer_all_values['salient-news-site-identity-color'];
        $salient_news_widget_heading_title_color 	= $salient_news_customizer_all_values['salient-news-heading-section-title-color'];
        $salient_news_post_page_title_color 		= $salient_news_customizer_all_values['salient-news-post-page-title-color'];
        $salient_news_menu_background_color 		= $salient_news_customizer_all_values['salient-news-menu-background-color'];
        $salient_news_menu_text_color       		= $salient_news_customizer_all_values['salient-news-menu-text-color'];
        $salient_news_tincker_color 				= $salient_news_customizer_all_values['salient-news-tincket-color'];
        
      
        ?>
        <style type="text/css">

        /*site identity font family*/
            .site-title,
            .site-title a,
            .site-description,
            .site-description a {
                font-family: '<?php echo esc_attr( $salient_news_font_family_site_identity ); ?>'!important;
            }
            /*main menu*/
            .main-navigation a{
                font-family: '<?php echo esc_attr( $salient_news_font_family_menu ); ?>'!important;
            }
            
           	h2, h2 a, .h2, .h2 a, 
           	h2.widget-title, .h1, .h3, .h4, .h5, .h6, 
           	h1, h3, h4, h5, h6 .h1 a, .h3 a, .h4 a,
           	.h5 a, .h6 a, h1 a, h3 a, h4 a, h5 a, 
           	h6 a {
                font-family: '<?php echo esc_attr( $salient_news_font_family_h1_h6 ); ?>'!important;
            }

        /*=====COLOR OPTION=====*/
        /*Color*/
        /*----------------------------------*/
        <?php 
        /*Primary*/
        if( !empty($salient_news_primary_color_option) ){
        ?>

        .header-btn-group i,
        .st-sidebar-tab-style li.clickme a,
        #return-to-top, .author-more,
        form.search-form input.search-submit,
        .st-author-description h2:after,
        #trending-section .widget-title:after,
        #secondary .widget-title:after,
        #pollSlider-button,
        .st-main-footer h2:after,
        .header-btn-group i,
        a.read-more-btn,
        #return-to-top,
        #return-to-top:hover,
        form.search-form input.search-submit,
        input#submit,
        .error-404.not-found input.search-submit,
        .author-more,
        .st-custom-widget-section .widget-title:after,
		#st-full-width .widget-title:after,
		.news-heading-only:after,
		#st-widget-style-3 .st-widget-3-heading-desc:after,
		.salient-social-section ul a {
        	background-color: <?php echo esc_attr( $salient_news_primary_color_option ) ;?>!important;;
        }            

       #st-full-width .slick-dots li.slick-active button:before,
       .author-more:hover,
       #trending-section .slick-dots li.slick-active button:before,
       .st-main-footer a:hover,
       .site-branding .site-title a span,
       ul.slick-dots li.slick-active button:before,
       .top-header .top-nav-bar ul li a:hover,
		.site-branding .site-title a:hover,
		#site-navigation a:hover,
		.random i:hover,
		#content .entry-title a:hover,
		header.entry-header a:hover,
		#content article a:hover,
		.st-main-footer a:hover,
		#secondary ul li a:hover,
		#secondary a:hover,
		.st-slider-caption h2 a:hover,
		.left-style h2 a:hover,
		.right-style h2 a:hover,
		.st-sidebar-tab-style .tab-heading-title h2 a:hover,
		.st-sidebar-slider h2 a:hover,
		.style-2-desc h2 a:hover,
		.latest-blog-st h2 a:hover,
		section#st-full-width h2 a:hover,
		.thumbnailstyle-heading-title h2 a:hover,
		.st-widget-style-1 .st-w-post-meta a:hover,
		.post-meta-content span a:hover,
		.st-author-description h2 a:hover,
		#trending-section .news-heading-only h2 a:hover,
		#breadcrumb ul li a:hover,
		.widget li a:hover,
		.widget a:hover,
		h2 a:hover,
		div#st-widget-style-3 h2 a:hover,
		.st-w-post-meta a:hover,
		.st-w-post-meta span a:hover {
          color: <?php echo esc_attr( $salient_news_primary_color_option );?>!important;;
        }

        a.read-more-btn,
        #content .nav-links a,
        .author-more,
        {
        	border-color: <?php echo esc_attr( $salient_news_primary_color_option ) ;?>!important;;
        }  
        <?php
        } 
        if( !empty($salient_news_site_identity_color_option) ){
        ?>
            /*Site identity / logo & tagline*/
            .site-branding a,
            .site-branding p,
            .site-branding p a {
              color: <?php echo esc_attr( $salient_news_site_identity_color_option );?>;
            }
        <?php
        }

        if( !empty($salient_news_widget_heading_title_color) )
        {?>
            #trending-section .widget-title, .st-custom-widget-section .widget-title, #st-full-width .widget-title, #secondary .widget-title
            {
                color: <?php echo esc_attr( $salient_news_widget_heading_title_color ) ;?>!important;;
            }

        <?php
        }
        
        if( !empty($salient_news_post_page_title_color) )
        {?>
            
            #st-widget-style-3 h2 a,
            .left-style h2 a,
            .right-style h2 a,
            .st-sidebar-tab-style .tab-heading-title h2 a, .st-sidebar-tab-style .post-meta-content span a,
            .st-sidebar-slider h2 a,
            #trending-section .news-heading-only h2 a,
           
            {
                color: <?php echo esc_attr( $salient_news_post_page_title_color ) ;?>!important;
            }

        <?php
        }

        if ( !empty($salient_news_tincker_color) )
        {?>
            .st-recent-news-content h2 a,
            .st-recent-news-content span a
            {
                color: <?php echo esc_attr($salient_news_tincker_color);?>!important;
            }
        <?php }


        if( !empty($salient_news_menu_background_color) )
        {?>
        	.st-news-main-nav,
        	#site-navigation ul.sub-menu
        	{
        		background: <?php echo esc_attr($salient_news_menu_background_color);?> !important;
        	}

        <?php }

        if( !empty($salient_news_menu_text_color) )
        {?>
        	#site-navigation a
        	{
        		color: <?php echo esc_attr($salient_news_menu_text_color);?>!important;
        	}

        <?php }

   		?>
        </style>
    <?php
    }
endif;