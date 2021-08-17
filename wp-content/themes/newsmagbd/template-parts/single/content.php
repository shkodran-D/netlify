<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('blog-single') ); ?>>
<div class="post-head">
    
    <?php
	do_action('newsmagbd_breadcrumb');
	?>
   <div class="fly_category_list static cat_link_<?php echo esc_attr(  rand(0,6) );?>"><?php echo get_the_category_list();?></div>
   	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    <p>  <?php if( function_exists('the_subtitle') ) the_subtitle(); ?></p>
    <div class="single-post-info">
    
    	
        <div class="pull-left post-author">
             
              
            <?php 
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';?>
        </div>

        <ul class="views-comments pull-right">
           
            <li><i class="fa fa-comments"></i><?php comments_popup_link(); ?></li>
        </ul>
    </div>
</div>

<div class="clearfix"></div>
	<?php
    /**
    * Hook - newsmagbd_posts_formats_thumbnail.
    *
    * @hooked newsmagbd_header_start - 10
    */
    do_action( 'newsmagbd_posts_formats_thumbnail' );
    ?>
<div class="single-post-detail">
	<?php the_content();?>
	
    <ul class="tag">
        <li><span><i class="fa fa-tags" aria-hidden="true"></i></span></li>
       <?php echo get_the_tag_list('<li>','</li><li>','</li>');?>
    </ul>
  
</div>
</article><!-- #post-<?php the_ID(); ?> -->
