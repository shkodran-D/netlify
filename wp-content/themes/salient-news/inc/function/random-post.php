<?php
if ( ! function_exists( 'salient_news_random_post' ) ) :
/**
 * Displays the random post
 *
 * @since salient-news 1.0.0
 */
function salient_news_random_post() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'salient-news');
}
endif;
add_action('init','salient_news_random_post');


if ( ! function_exists( 'salient_news_random_post_template' ) ) :
/**
* Templates helps to get random post
*/
  function salient_news_random_post_template() {
         if (get_query_var('random') == 1) {
                 $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
                 foreach($posts as $post) {
                         $link = get_permalink($post);
                 }
                 wp_redirect($link,307);
                 exit;
         }
  }
endif;

add_action('template_redirect','salient_news_random_post_template');