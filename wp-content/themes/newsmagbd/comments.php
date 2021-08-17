<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage newsmagbd
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>
 <div class="space no-top comments-sec" id="comments">
    <div class="single-title">      
		<h4 class="custom-title"> <i class="fa fa-comments"></i>
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'newsmagbd' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'newsmagbd'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h4>
	 	</div>
	
		<ul>
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'callback' => 'newsmagbd_walker_comment',
					
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'newsmagbd' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'newsmagbd' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'newsmagbd' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>
		</div><!-- #comments -->
	<?php endif; // Check for have_comments(). ?>

<?php
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
 <div class="space no-top comments-sec">
	<h4 class="custom-title"> <i class="fa fa-comments"></i><?php esc_html_e( 'Comments are closed.', 'newsmagbd' ); ?></h4>
</div>
<?php else :?>


<div  class="contact-form">

	<?php 
	
	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="col-md-6">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'newsmagbd'  ) . '" name="author"  type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="col-md-6">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'newsmagbd'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"  />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="col-md-12">' .
			 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'newsmagbd' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"  /> ' .
			
	           '</div><div class="clearfix"',
			   
		)
	),
	 'comment_field' =>  '<div class="col-md-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'newsmagbd' ) . '" >' .
    '</textarea></div>',
    'comment_notes_after' => '',
	'class_form'      => 'row ',
	'title_reply_before'	=> '<div class="single-title"> <h4>',
	'title_reply_after'	=>	'</h4></div>'
	//'title_reply'       => '<div class="single-title"> <h4>'.esc_html__( 'Leave a Reply', 'newsmagbd' ).'</h4></div>',
	
);
	?>
    <?php comment_form($args); ?>
  

</div>

<?php endif; ?>