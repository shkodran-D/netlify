<?php
/**
 * NewsMagbd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NewsMagbd
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'newsmagbd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newsmagbd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on NewsMagbd, use a find and replace
		 * to change 'newsmagbd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsmagbd', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'newsmagbd' ),
			'footer' => esc_html__( 'Footer', 'newsmagbd' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsbd24_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

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
		
		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );
		
		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		
		
		add_image_size( 'newsmagbd_news_block_size', 400, 400, array( 'left', 'top' ) ); // Hard crop left top
		add_image_size( 'newsmagbd_block_size_cropping', 400, 400, true );
		
	}
endif;
add_action( 'after_setup_theme', 'newsmagbd_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsmagbd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newsmagbd_content_width', 640 );
}
add_action( 'after_setup_theme', 'newsmagbd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsmagbd_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newsmagbd' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'newsmagbd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Slider Widgets', 'newsmagbd' ),
		'id'            => 'slider',
		'description'   => esc_html__( 'Add widgets here.', 'newsmagbd' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="screen-reader-text">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget', 'newsmagbd' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'newsmagbd' ),
		'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 col-xs-12"> <div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ad', 'newsmagbd' ),
		'id'            => 'header_ad',
		'description'   => esc_html__( 'Add widgets here.', 'newsmagbd' ),
		'before_widget' => '<div id="%1$s" class="ad %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title" style="display:none;">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'newsmagbd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newsmagbd_scripts() {
	

	/* FONTS*/
	wp_enqueue_style( 'newsmagbd-Open+Sans+Roboto', '//fonts.googleapis.com/css?family=Open+Sans:400,600%7CRoboto:400,500,400italic');
	wp_enqueue_style( 'newsmagbd-Open+Sans+Poppins', '//fonts.googleapis.com/css?family=Open+Sans:400,600%7CPoppins:400,500,400italic');
	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/bootstrap.css' ), '3.3.7' );
	wp_enqueue_style( 'normalize', get_theme_file_uri( '/vendors/normalize.css' ), '3.0.3' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), '1.1.0' );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/vendors/font-awesome/font-awesome.css' ), '4.7.0' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owl.carousel/owl.carousel.css' ), '2.2.1' );
	wp_enqueue_style( 'themify', get_theme_file_uri( '/vendors/themify/themify-icons.css' ), '0' );
	
	
	wp_enqueue_style( 'newsmagbd', get_stylesheet_uri() );
	wp_enqueue_style( 'newsmagbd-responsive', get_theme_file_uri( '/assets/responsive.css' ), '0' );
	
	
	/* PLUGIN JS */
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/vendors/bootstrap/bootstrap.js' ), 0, '3.3.7', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri().'/vendors/magnific-popup/jquery.magnific-popup.js', 0, '1.1.0',true );
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/vendors/owl.carousel/owl.carousel.js' ),0,'2.2.1',true );
	
	
	
	
	wp_enqueue_script( 'jquery-newsTicker', get_theme_file_uri( '/vendors/jquery.bootstrap.newsbox.js' ), 0,'1.0.11',true  );
	
	wp_enqueue_script( 'newsmagbd-core', get_template_directory_uri().'/assets/newsmagbd.js', array('jquery'), '4.0.0', true);
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsmagbd_scripts' );



/**
 * Set up the WordPress core custom header feature.
 *
 * @uses newsmagbd_header_style()
 */
function newsmagbd_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'newsmagbd_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'newsmagbd_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'newsmagbd_custom_header_setup' );

if ( ! function_exists( 'newsmagbd_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see newsmagbd_custom_header_setup().
	 */
	function newsmagbd_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image = get_header_image();
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( get_theme_support( 'custom-header', 'default-text-color' ) != $header_text_color && $header_text_color != "" ) :
		?>
			.header-menu a,
			.header-menu ,
			.header-menu p{
				color: #<?php echo esc_attr( $header_text_color ); ?>!important;
			}
		<?php endif; ?>
		
		<?php if ( ! empty( $header_image ) ) : ?>
		.header-menu {
	
				/*
				 * No shorthand so the Customizer can override individual properties.
				 * @see https://core.trac.wordpress.org/ticket/31460
				 */
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 50% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
			}
		<?php endif;?>
		</style>
		<?php
	}
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newsmagbd_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'newsmagbd_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsmagbd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'newsmagbd_pingback_header' );
