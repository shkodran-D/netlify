<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

?>
<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMagbd
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('blog-single','page-content') ); ?>>
<div class="post-head">
  <?php
	do_action('newsmagbd_breadcrumb');
	?>
 
   	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
   <p>  <?php if( function_exists('the_subtitle') ) the_subtitle(); ?></p>
    
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
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
