<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

//On theme activation add defaults theme settings and data
add_action( 'after_setup_theme', 'NewsStreet_default_theme_options_setup' );

//Custom Button (docs + Upgrade To Pro)
require_once( trailingslashit( get_stylesheet_directory() ) . '/custom-edition-newsstreet/upgrade/class-customize.php');

function NewsStreet_default_theme_options_setup() {
	// News Blog Template Images
	add_image_size( 'crypto-news-blog', '700', '535', true);
}

if ( !function_exists( 'newsstreet_chld_thm_cfg_parent_css' ) ):
	function newsstreet_chld_thm_cfg_parent_css() {
		// cryptocurrency exchange parent style css
		wp_enqueue_style('newsstreet-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap-min-css','cryptocurrency-exchange-animate-css','font-awesome-min-css','crypto-flexslider-css' ));

		// newsstreet style css
		wp_enqueue_style('newsstreet-child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

		// newsstreet custom color style css
		wp_enqueue_style('newsstreet-custom-color', get_stylesheet_directory_uri() . '/css/newsstreet-custom-color.css', array('crypto-custom-color'));
	}
endif;
add_action( 'wp_enqueue_scripts', 'newsstreet_chld_thm_cfg_parent_css', 10 );
// END ENQUEUE PARENT ACTION

function newsstreet_customize_register() {
	global $wp_customize;
	$wp_customize->remove_section( 'upgrade_crypto_premium' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_slider_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_service_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_exchange_blog_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_portfolio_section' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_exchange_testimonial_settings' ); //Modify this line as needed
	
	//NewsBlog Customiser Section
	$wp_customize->add_section( 'newsstreet_newsblog_option' , array(
			'title'      	=> __( 'News Blog', 'newsstreet' ),
			'description'   => __('Newsstreet has very elegant design of showing blog post.', 'newsstreet'),
			'priority'      => 4,
			'panel'      	=> 'cryptocurrency_exchange_theme_options',
		) 
	);
	
	//NewsBlog Default Setting
	$wp_customize->add_setting( 'newsstreet_newsblog_setting', array(
			'default'      		=> 'inactive',
			'sanitize_callback' => 'cryptocurrency_exchange_sanitize_radio'
		)
	);
	
	//NewsBlog Customiser Section's Control
	$wp_customize->add_control('newsstreet_newsblog_setting', array(
			'type'      => 'radio',
			'label'     => __('News Blog Design', 'newsstreet'),
			'section'   => 'newsstreet_newsblog_option',
			'priority'  => 1,
			'choices'   => array(
				'active'       => __( 'Active', 'newsstreet' ),
				'inactive'     => __( 'Inactive', 'newsstreet' ),
			),
		)
	);
	
	//Logo Text Name
	$wp_customize->add_setting('newsstreet_posts_heading', array(
			'default' 			=> esc_html('Latest News','newsstreet'),
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
	);
	$wp_customize->add_control('newsstreet_posts_heading', array(
			'label' 	=> __( 'Posts SubHeading', 'newsstreet' ),
			'section' 	=> 'newsstreet_newsblog_option',
			'type' 		=> 'text',
			'priority' 	=> 5,
		)
	);
	
}
add_action( 'customize_register', 'newsstreet_customize_register', 11 );
// END ENQUEUE PARENT ACTION

function newsstreet_register_home_section_partials( $wp_customize ){
	// customizer UI Partial Selector Pencil code  
	//Posts Section
	$wp_customize->selective_refresh->add_partial( 'newsstreet_posts_heading', array(
		'selector'            => '.news-section-head .head-title',
		'settings'            => 'newsstreet_posts_heading',
		'render_callback'  	  => 'newsstreet_posts_heading_render_callback',
	) );
}
add_action( 'customize_register', 'newsstreet_register_home_section_partials' );

function newsstreet_posts_heading_render_callback() {
	return get_theme_mod('newsstreet_posts_heading');
}

/**
 * Skip Link
 *
 */
add_action('wp_head', 'newsstreet_skip_to_content');
function newsstreet_skip_to_content(){
	echo '<a class="skip-link screen-reader-text" href="#main-content">'. esc_html__( 'Skip to content', 'newsstreet' ) .'</a>';
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function newsstreet_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'newsstreet_skip_link_focus_fix' );