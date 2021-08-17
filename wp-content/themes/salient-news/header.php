<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package salient-news
 */

/**
 * salient_news_action_before_head hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_set_global -  0
 * @hooked salient_news_doctype -  10
 */
do_action( 'salient_news_action_before_head' );?>



<head>

	<?php
	/**
	 * salient_news_action_before_wp_head hook
	 * @since salient-news 1.0.0
	 *
	 * @hooked salient_news_before_wp_head -  10
	 */
	do_action( 'salient_news_action_before_wp_head' );

	wp_head();

	/**
	 * salient_news_action_after_wp_head hook
	 * @since salient-news 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'salient_news_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>
	<div id="preloader"><!-- pre loader -->
		<div id="status"><i class="fa fa-spinner fa-spin"></i></div>
	</div><!-- end of pre loader -->

<?php
/**
 * salient_news_action_before hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_page_start - 15
 */
do_action( 'salient_news_action_before' );

/**
 * salient_news_action_before_header hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_skip_to_content - 10
 */
do_action( 'salient_news_action_before_header' );

/**
 * salient_news_action_header hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_after_header - 10
 */
do_action( 'salient_news_action_header' );

/**
 * salient_news_action_nav_page_start hook
 * @since salient-news 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'salient_news_action_nav_page_start' );

/**
 * salient_news_action_on_header hook
 * @since salient-news 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'salient_news_action_on_header' );

/**
 * salient_news_action_before_content hook
 * @since salient-news 1.0.0
 *
 * @hooked null
 */
do_action( 'salient_news_action_before_content' );
?>

