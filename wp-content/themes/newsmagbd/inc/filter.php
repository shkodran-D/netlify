<?php
/**
 * HOOK
 *
 * @package NewsMagbd
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( !function_exists( 'newsmagbd_widget_title' ) ) : 
/**
 * Wraps the first half of the provided string inside a span with the class lol_class.
 *
 * @param  string  $title  The string.
 * @return string          The modified string.
 */
function newsmagbd_widget_title($title) {
    // Cut the title into two halves.
    $halves = explode(' ', $title, 2);
    // Add the remaining words if any.
    if (isset($halves[1])) {
		$title = '<span class="color_style">' . $halves[0] . '</span>';
        return $title . ' ' . $halves[1];
    }else{
		return $title;
	}

  
}

// Hook our function into the WordPress system.
add_filter('widget_title', 'newsmagbd_widget_title');
endif;



if ( ! function_exists( 'newsmagbd_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function newsmagbd_walker_comment($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? ' shift' : '' ) ?> id="comment-<?php comment_ID() ?>">
        
       
            <div class="comment">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 70 ); ?>
                <div class="comment-detail">
                    <h4><?php echo get_comment_author_link();?></h4><span><?php
                    /* translators: 1: date, 2: time */
                    printf( esc_html__('%1$s at %2$s', 'newsmagbd' ), get_comment_date(),  get_comment_time() ); ?></span>
                    <div class="clearfix"></div>
                    <?php comment_text(); ?>
                  
                     <?php 
					$args ['reply_text'] = '<i class="fa fa-reply"></i>'. esc_html__( 'Reply', 'newsmagbd' );
                    comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
           
        
	   </li>
		<?php
	}
	
	function newsmagbd_replace_reply_link_class($class){
		$class = str_replace("class='comment-reply-link", "class='reply", $class);
		return $class;
	}
	add_filter('comment_reply_link', 'newsmagbd_replace_reply_link_class');
endif;


if( ! function_exists( 'newsmagbd_blog_expert_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     *
     * @param null
     * @return int
     */
    function newsmagbd_blog_expert_excerpt_length( $length ){
        $excerpt_length = newsmagbd_get_option( 'excerpt_length_blog' );

        if ( absint( $excerpt_length ) > 0 ) {
        	$length = absint( $excerpt_length );
        }

        return $length;

    }

add_filter( 'excerpt_length', 'newsmagbd_blog_expert_excerpt_length', 999 );
endif; 