<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('col-sm-6')); ?>>
 <div class="post-grid-style">
 	
 	<div class="fly_category_list cat_link_<?php echo esc_attr( newsmagbd_count(1) );?>"><?php echo get_the_category_list();?></div>
   
	<?php
    /**
    * Hook - newsmagbd_posts_blog_media.
    *
    * @hooked newsmagbd_posts_blog_media - 10
    */
    do_action( 'newsmagbd_posts_blog_media' );
    ?>

	<div class="entry-content post-detail">
     <?php 
	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
	?>
	<?php
    /**
    * Hook - newsmagbd_posted_on.
    *
    * @hooked newsmagbd_posted_on - 10
    */
    do_action( 'newsmagbd_posted_on' );
    ?>  
    
   
  
		<?php
			
			/**
			* Hook - newsbd24_blog_loop_content_type.
			*
			* @hooked newsbd24_blog_loop_content_type - 10
			*/
			do_action('newsmagbd_blog_loop_content_type');
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newsmagbd' ),
				'after'  => '</div>',
			) );
			
		?>
        
         <a href="<?php echo esc_url( get_permalink()); ?>" class="readmore" title="<?php the_title_attribute();?>"><i class="ti-more-alt"></i></a>
	</div><!-- .entry-content -->


    </div>
</article><!-- #post-<?php the_ID(); ?> -->
