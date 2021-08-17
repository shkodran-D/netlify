<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package salient themes
 * @subpackage salient-news
 * @since salient-news 1.0.0
 */


/**
 * salient_news_action_after_content hook
 * @since salient-news 1.0.0
 *
 * @hooked null
 */
do_action( 'salient_news_action_after_content' );

/**
 * salient_news_action_before_footer hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_before_footer - 10
 */
do_action( 'salient_news_action_before_footer' );

/**
 * salient_news_action_widget_before_footer hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_widget_before_footer - 10
 */
do_action( 'salient_news_action_widget_before_footer' );

/**
 * salient_news_action_footer hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_footer - 10
 */
do_action( 'salient_news_action_footer' );

/**
 * salient_news_action_after_footer hook
 * @since salient-news 1.0.0
 *
 * @hooked null
 */
do_action( 'salient_news_action_after_footer' );

/**
 * salient_news_action_after hook
 * @since salient-news 1.0.0
 *
 * @hooked salient_news_page_end - 10
 */
do_action( 'salient_news_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>