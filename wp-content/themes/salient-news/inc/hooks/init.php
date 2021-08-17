<?php
/**
 * Implement Editor Styles
 *
 * @since salient-news 1.0.0
 *
 * @param null
 * @return null
 *
 */
add_action( 'init', 'salient_news_add_editor_styles' );

if ( ! function_exists( 'salient_news_add_editor_styles' ) ) :
    function salient_news_add_editor_styles() {
        add_editor_style( 'editor-style.css' );
    }
endif;