<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class NewsStreet_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->newsstreet_setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function newsstreet_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_stylesheet_directory() ) . 'custom-edition-newsstreet/upgrade/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'NewsStreet_Customize_Section_Pro' );

		// doc sections.
		$manager->add_section(
			new NewsStreet_Customize_Section_Pro(
				$manager,
				'newsstreet-upgrade',
				array(
					'title'    => esc_html__( 'NewsStreet Theme Documentation', 'newsstreet' ),
					'pro_text' => esc_html__( 'Click Here', 'newsstreet' ),
					'pro_url'  => 'https://awplife.com/newsstreet-wordpress-theme-setup/',
					'priority'  => 1
				)
			)
		);
	 
		// upgrade sections.
		$manager->add_section(
			new NewsStreet_Customize_Section_Pro(
				$manager,
				'upgrade-pro',
				array(
					'title'    => esc_html__( 'Upgrade To Pro', 'newsstreet'),
					'pro_text' => esc_html__( 'View Pro', 'newsstreet'),
					'pro_url'  => 'https://awplife.com/wordpress-themes/crypto-premium/',
					'priority'  => 500
				)
			)
		);
		
		/* // upgrade sections.
		$manager->add_section(
			new NewsStreet_Customize_Section_Pro(
				$manager,
				'upgrade-pross',
				array(
					'title'    => esc_html__( 'Other Features', 'cryptocurrency-exchange'),
					'pro_text' => esc_html__( 'View', 'cryptocurrency-exchange'),
					'pro_url'  => '',
					'priority'  => 30
				)
			)
		); */
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'newsstreet-customize-controls-js', trailingslashit( get_stylesheet_directory_uri() ) . '/custom-edition-newsstreet/upgrade/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'newsstreet-customize-controls-css', trailingslashit( get_stylesheet_directory_uri() ) . '/custom-edition-newsstreet/upgrade/customize-controls.css' );
	}
}

// Doing this customizer
NewsStreet_Customize::get_instance();