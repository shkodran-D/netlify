<?php 

/**
 * newsmagbd Theme Customizer.
 *
 * @package newsmagbd
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core/customizer-core.php';

//customizer 
require get_template_directory() . '/inc/customizer/core/default.php';
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newsmagbd_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/core/control.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/core/sanitize.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	
	/*theme option panel details*/
	require get_template_directory() . '/inc/customizer/theme-option.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'NewsMagBd_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new NewsMagBd_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'NewsMagBd Pro', 'newsmagbd' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'newsmagbd' ),
				'pro_url'  => 'https://edatastyle.com/product/newsmagbd?ref=customize',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'newsmagbd_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */

function newsmagbd_customizer_css() {
	
	wp_enqueue_script( 'newsmagbd_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-admin.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'newsmagbd_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-controll.css' );
	
}
add_action( 'customize_controls_enqueue_scripts', 'newsmagbd_customizer_css',0 );


