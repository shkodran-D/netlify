<?php
/**
* Returns word count of the sentences.
*
* @since salient-news 1.0.0
*/
if ( ! function_exists( 'salient_news_words_count' ) ) :
	function salient_news_words_count( $length = 25,$salient_news_content = null ) {
		$length = absint( $length );
		$source_content = preg_replace( '`\[[^\]]*\]`', '',$salient_news_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;