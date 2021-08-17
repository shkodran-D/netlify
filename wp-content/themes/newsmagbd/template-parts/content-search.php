<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content post-detail">
	<div class="entry-content post-detail" style="margin-bottom:20px;">
		

		<?php if ( 'post' === get_post_type() ) : ?>
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php
        /**
        * Hook - newsmagbd_posted_on.
        *
        * @hooked newsmagbd_posted_on - 10
        */
        do_action( 'newsmagbd_posted_on' );
        ?>  
        <?php else :?>
        <?php the_title( sprintf( '<h2 class="entry-title" style="padding-bottom:15px;"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>

	<div class="clearfix"></div>

		<?php the_excerpt(); ?>
	 <a href="<?php echo esc_url( get_permalink()); ?>" class="readmore" title="<?php the_title_attribute();?>"><i class="ti-more-alt"></i></a>
	</div>
</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
