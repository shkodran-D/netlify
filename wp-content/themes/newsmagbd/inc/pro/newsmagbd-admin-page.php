<?php
/**
 * newsmagbd Admin Class.
 *
 * @author  eDataStyle
 * @package newsmagbd
 * @since   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'newsmagbd_Admin' ) ) :

/**
 * newsmagbd_Admin Class.
 */
class newsmagbd_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'newsmagbd' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'newsmagbd' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'newsmagbd-welcome', get_template_directory_uri() . '/inc/pro/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'newsmagbd-message', get_template_directory_uri() . '/inc/pro/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'newsmagbd_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'newsmagbd_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['newsmagbd-hide-notice'] ) && isset( $_GET['_newsmagbd_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_newsmagbd_notice_nonce']), 'newsmagbd_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'newsmagbd' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'newsmagbd' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['newsmagbd-hide-notice'] ) );
			update_option( 'newsmagbd_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'newsmagbd-hide-notice', 'welcome' ) ), 'newsmagbd_hide_notices_nonce', '_newsmagbd_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'newsmagbd' ); ?></a>
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing newsmagbd! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'newsmagbd' ), '<a href="' . esc_url( admin_url( 'themes.php?page=welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=welcome' ) ); ?>"><?php esc_html_e( 'Get started with newsmagbd', 'newsmagbd' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="cresta-theme-info">
				<h1>
					<?php esc_html_e('About', 'newsmagbd'); ?>
					<?php echo esc_html( $theme->get( 'Name' )) ." ". esc_html( $theme->get( 'Version' ) ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo esc_html( $theme->display( 'Description' ) ); ?>
				<p class="cresta-actions">
					<a href="<?php echo esc_url( 'https://edatastyle.com/product/newsmagbd-pro/?ref=welcome' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'newsmagbd' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'newsmagbd_pro_theme_url', 'https://eds.edatastyle.com/newsmag' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'newsmagbd' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'newsmagbd_pro_theme_url', 'https://edatastyle.com/product/newsmagbd-pro/?ref=welcome' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version Demo', 'newsmagbd' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'newsmagbd_pro_theme_url', 'https://wordpress.org/support/theme/newsmagbd/reviews/?filter=5#postform' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'newsmagbd' ); ?></a>
				</p>
				</div>

				<div class="cresta-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<h2 class="nav-tab-wrapper">
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs PRO', 'newsmagbd' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'newsmagbd' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$tabs_data = isset( $_GET['tab']  ) ? sanitize_title( wp_unslash( $_GET['tab'] ) ) : '';
		$current_tab = empty( $tabs_data ) ? /* translators: About. */ esc_html('about','newsmagbd') : $tabs_data;

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h4><?php esc_html_e( 'Theme Customizer', 'newsmagbd' ); ?></h4>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'newsmagbd' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php /* translators: %s: plugin name. */ esc_html_e( 'Customize', 'newsmagbd' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Got theme support question?', 'newsmagbd' ); ?></h4>
						<p><?php esc_html_e( 'Please put it in our support forum.', 'newsmagbd' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://edatastyle.com/support/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'newsmagbd' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Need more features?', 'newsmagbd' ); ?></h4>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'newsmagbd' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://edatastyle.com/product/newsmagbd-pro/?ref=welcome' ); ?>" class="button button-secondary"><?php esc_html_e( 'Info about PRO version', 'newsmagbd' ); ?></a></p>
					</div>

					
				</div>
			</div>

			<div class="return-to-dashboard cresta">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'newsmagbd' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'newsmagbd' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'newsmagbd' ) : esc_html_e( 'Go to Dashboard', 'newsmagbd' ); ?></a>
			</div>
		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'newsmagbd' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'newsmagbd_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'newsmagbd' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h4><?php esc_html_e('Features', 'newsmagbd'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('newsmagbd', 'newsmagbd'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('newsmagbd PRO', 'newsmagbd'); ?></h4></th>
					</tr>
				</thead>
				<tbody>
               		
                	<tr>
						<td><h4><?php esc_html_e('24/7 Priority Support', 'newsmagbd'); ?></h4></td>
						<td><?php esc_html_e('WP forum', 'newsmagbd'); ?></td>
						<td><?php esc_html_e('Ticket, email , Skype & Teamviewer', 'newsmagbd'); ?></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Theme Layout', 'newsmagbd'); ?></h4></td>
						<td><?php esc_html_e('Container', 'newsmagbd'); ?></td>
						<td><?php esc_html_e('Container And fluid', 'newsmagbd'); ?></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Navigation Fonts', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Navigation Color', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Responsive Design', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Post format', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Change Background', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Unlimited Text Color', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Logo Upload', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h4><?php esc_html_e('Choose Social Icon ', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('jQuery Lightbox Popup ', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
                    
					
                    <tr>
						<td><h4><?php esc_html_e('Extended Theme Options Panel', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Styling for most of all sections', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Google Fonts Supported (500+ Fonts)', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     
                    
					<tr>
						<td><h4><?php esc_html_e('Blog Posts ( 5+ Style ) ', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Single Posts Share ', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Home Page Layout Options', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td>4</td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Related Blog Posts', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td>4</td>
					</tr>
					
                    <tr>
						<td><h4><?php esc_html_e('Page Layout Options', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td>4</td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Page Layout Style', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Blog Layout Style', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Blog Gird Style', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('Breadcrumb', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('8+ NEWS RELATED WIDGETS', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('8+ Shortcodes', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e(' Font switcher', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                      <tr>
						<td><h4><?php esc_html_e('  Footer/Copyright Section', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('WP-Admin Welcome Section', 'newsmagbd'); ?></h4></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-no"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							
							<a href="<?php echo esc_url( apply_filters( 'newsmagbd_pro_theme_url', 'https://edatastyle.com/product/newsmagbd-pro/?ref=welcome' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'More Information', 'newsmagbd' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new newsmagbd_Admin();
