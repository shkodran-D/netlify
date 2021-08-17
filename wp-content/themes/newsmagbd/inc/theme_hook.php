<?php
/**
 * HOOK
 *
 * @package NewsMagbd
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 


/**
* Hook - newsmagbd_header_container.
*
* @hooked newsmagbd_header_start - 10
* @hooked newsmagbd_header_top_bar - 20
* @hooked newsmagbd_header_logo_bar - 30
* @hooked newsmagbd_header_menu_bar - 30
* @hooked newsmagbd_header_end - 30
*/
add_action( 'newsmagbd_header_container', 'newsmagbd_header_start', 10 );
add_action( 'newsmagbd_header_container', 'newsmagbd_header_top_bar', 20 );
add_action( 'newsmagbd_header_container', 'newsmagbd_header_logo_bar', 30 );
add_action( 'newsmagbd_header_container', 'newsmagbd_header_menu_bar', 40 );
add_action( 'newsmagbd_header_container', 'newsmagbd_header_end', 50 );


/**
* Hook - newsmagbd_footer_container.
*
* @hooked newsmagbd_footer_widgets - 10
* @hooked newsmagbd_footer_end - 20
*/
add_action( 'newsmagbd_footer_container', 'newsmagbd_footer_widgets', 10 );
add_action( 'newsmagbd_footer_container', 'newsmagbd_footer_end', 20 );
add_action( 'newsmagbd_footer_container', 'newsmagbd__popup_search', 30 );


/**
* Hook - newsmagbd_blog_content_start_wrp.
*
* @hooked newsmagbd_blog_content_before_wrp - 10
* @hooked newsmagbd_blog_before_loop_wrp - 20
*/
add_action( 'newsmagbd_blog_content_start_container', 'newsmagbd_blog_content_before_wrp', 10 );
add_action( 'newsmagbd_blog_content_start_container', 'newsmagbd_blog_start_loop_wrp', 20 );


/**
* Hook - newsmagbd_blog_content_end_container.
*
* @hooked newsmagbd_blog_end_loop_wrp - 10
* @hooked newsmagbd_blog_content_sidebar - 20
* @hooked newsmagbd_blog_content_end_wrp - 30
*/
add_action( 'newsmagbd_blog_content_end_container', 'newsmagbd_blog_end_loop_wrp', 10 );
add_action( 'newsmagbd_blog_content_end_container', 'newsmagbd_blog_content_sidebar', 20 );
add_action( 'newsmagbd_blog_content_end_container', 'newsmagbd_blog_content_end_wrp', 30 );



/**
* Hook - newsmagbd_page_content_start_container.
*
* @hooked newsmagbd_page_content_before_wrp - 10
* @hooked newsmagbd_page_start_loop_wrp - 20
*/
add_action( 'newsmagbd_page_content_start_container', 'newsmagbd_page_content_start_wrp', 10 );
add_action( 'newsmagbd_page_content_start_container', 'newsmagbd_page_start_loop_wrp', 20 );


/**
* Hook - newsmagbd_page_content_end_container.
*
* @hooked newsmagbd_page_end_loop_wrp - 10
* @hooked newsmagbd_page_content_sidebar - 20
* @hooked newsmagbd_page_content_end_wrp - 30
*/
add_action( 'newsmagbd_page_content_end_container', 'newsmagbd_page_end_loop_wrp', 10 );
add_action( 'newsmagbd_page_content_end_container', 'newsmagbd_page_content_sidebar', 20 );
add_action( 'newsmagbd_page_content_end_container', 'newsmagbd_page_content_end_wrp', 30 );