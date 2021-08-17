<?php 

/*image alignment single post*/

if( ! function_exists( 'salient_news_single_post_image_align' ) ) :
    /**
     * salient-news default layout function
     *
     * @since  salient-news 1.0.0
     *
     * @param int
     * @return string
     */
    function salient_news_single_post_image_align( $post_id = null ){
        global$salient_news_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
       $salient_news_single_post_image_align =$salient_news_customizer_all_values['salient-news-single-post-image-align'];
       $salient_news_single_post_image_align_meta = get_post_meta( $post_id, 'salient-news-single-post-image-align', true );

        if( false !=$salient_news_single_post_image_align_meta ) {
           $salient_news_single_post_image_align =$salient_news_single_post_image_align_meta;
        }
        return$salient_news_single_post_image_align;
    }
endif;