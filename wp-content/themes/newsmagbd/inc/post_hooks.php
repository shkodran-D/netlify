<?php
/**
 * Functions hooked to post page.
 *
 * @package newsmagbd
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( ! function_exists( 'newsmagbd_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
		?>
           <div class="post-grid-image <?php echo esc_attr( $formats );?>">
           		<?php if ( is_singular() ) :?>
               		 <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
                <?php else: ?>
                	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
                <?php endif;?>
                	<span class="style_1"><?php the_post_thumbnail('full');?></span>
                </a>
            </div>
         <?php else:?>
        	 <div class="post-grid-image"></div>
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'newsmagbd_posts_formats_thumbnail', 'newsmagbd_posts_formats_thumbnail' );


if ( ! function_exists( 'newsmagbd_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="post-grid-image"><div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div></div>';
				}
			else: 
				do_action('newsmagbd_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'newsmagbd_posts_formats_video', 'newsmagbd_posts_formats_video' ); 


if ( ! function_exists( 'newsmagbd_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo '<div class="post-grid-image">';
					echo $audio_html;
				echo '</div>';
			}
		else: 
			do_action('newsmagbd_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'newsmagbd_posts_formats_audio', 'newsmagbd_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'newsmagbd_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_posts_formats_gallery() {
		
		if ( get_post_gallery() ) :
			echo '<div class="gallery-media">';
				echo get_post_gallery();
			echo '</div>';
		else: 
			do_action('newsmagbd_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'newsmagbd_posts_formats_gallery', 'newsmagbd_posts_formats_gallery' ); 




if ( ! function_exists( 'newsmagbd_posts_formats_header' ) ) :

	/**
	 * Post newsmagbd_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('newsmagbd_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('newsmagbd_posts_formats_gallery');
			break;
			case 'audio':
				do_action('newsmagbd_posts_formats_audio');
			break;
			case 'video':
				do_action('newsmagbd_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'newsmagbd_posts_blog_media', 'newsmagbd_posts_blog_media' ); 





if ( ! function_exists( 'newsmagbd_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_single_post_navigation( ) {
		echo '<div class="row single-prev-next">';
		$prevPost = get_previous_post(true);
		if( $prevPost ) :
			echo '<div class="col-md-6 col-sm-6 ">';
				$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(40,40) );
				//previous_post_link('%link',$prevthumbnail , TRUE); 
				echo '<div class="text"><h6><i class="fa fa-long-arrow-left"></i>'.esc_html__('Previous Article','newsmagbd').'</h6>';
					previous_post_link('%link',"<span>%title</span>", TRUE); 
				echo '</div>';
			echo '</div>';
			
		endif;
		
		$nextPost = get_next_post(true);
		if( $nextPost ) : 
			echo '<div class="col-md-6 col-sm-6 text-right">';
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(40,40) );
				//next_post_link('%link',$nextthumbnail, TRUE);
				echo '<div class="text"><h6>'.esc_html__('Next Article','newsmagbd').'<i class="fa fa-long-arrow-right" ></i></h6>';
					next_post_link('%link',"<span>%title</span>", TRUE);
				echo '</div>';
			echo '</div>';
			
		endif;
		echo '</div><hr class="dashedhr">';
	} 

endif;
add_action( 'newsmagbd_single_post_navigation', 'newsmagbd_single_post_navigation', 10 ); 


if( ! function_exists( 'newsmagbd_blog_loop_content_type' ) && ! is_admin() ) :

    /**
     * Excerpt length
     *
     * @since  Blog Expert 1.0.0
     *
     * @param null
     * @return int
     */
    function newsmagbd_blog_loop_content_type( $length ){
        $type = newsmagbd_get_option( 'blog_loop_content_type' );

        if ( $type === 'excerpt-only' ) {
        	the_excerpt();
        }else{
			$content = preg_replace("/<embed[^>]+>/i", "", get_the_content() , 1);
			echo strip_shortcodes( $content  );
		}

        return $length;

    }

endif; 
add_action( 'newsmagbd_blog_loop_content_type', 'newsmagbd_blog_loop_content_type', 10 ); 



if ( ! function_exists( 'newsmagbd_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function newsmagbd_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		
		$posted_on = '<i class="ti-time"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		
		$byline = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" ><i class="ti-user"></i> ' . esc_html( get_the_author() ) . ' </a>';
		
		echo '<ul class="post-meta3 pull-left">';
		echo '<li class="posted-on">' . $posted_on . '</li><li class="admin"> ' . $byline . '</li>'; // WPCS: XSS OK.
		echo '</ul>';
		
		echo '<ul class="post-meta3 pull-right">';
		
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link"><i class="fa fa-comment-o"></i>';
			comments_popup_link();
			echo '</li>';
		}
		echo '</ul>';

	}
endif;

add_action( 'newsmagbd_posted_on', 'newsmagbd_posted_on', 10 ); 


if ( ! function_exists( 'newsmagbd_count' ) ) :
	/**
	 * newsmagbd_count
	 *
	 *
	 * @param int
	 * @return int
	 */
	
	function newsmagbd_count( $add = 0 )
	{
		static $counter = 0;
		if( $counter == 6 ){
			$counter =1;	
		}
		if ( FALSE === $add )
			$counter = 0;
		else
			$counter += (int) $add;
	
		return $counter;
	}
endif;