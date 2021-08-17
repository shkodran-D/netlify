<?php
if( ! function_exists( 'salient_news_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  salient-news 1.0.0
     *
     * @param null
     * @return int
     */
    function salient_news_excerpt_length( $length ){
        global$salient_news_customizer_all_values;
        if( is_admin() ) {
            return $length;
        }
        
        $excerpt_length =$salient_news_customizer_all_values['salient-news-excerpt-length'];
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
    
        return absint( $excerpt_length );


    }

endif;
add_filter( 'excerpt_length', 'salient_news_excerpt_length', 999 );