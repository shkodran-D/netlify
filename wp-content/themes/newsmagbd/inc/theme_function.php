<?php
/**
 * Functions
 *
 * @package NewsMagbd
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

if( !function_exists('newsmagbd_breaking_news') ){
	/**
	* Add breaking news
	*
	* @since 1.0.0
	*/
	function newsmagbd_breaking_news(){
		
		if( newsmagbd_get_option('show_news_ticker_section_settings') == 1 ){
			if( newsmagbd_get_option('news_ticker_title') != "" ) :
			echo ' <span class="breaking-title"> <span class="fa fa-bolt" aria-hidden="true"></span> <span class="breaking-title-text">' . esc_html( newsmagbd_get_option('news_ticker_title') ) .'</span> </span>';
			endif;
			
			$qargs = array(
				'posts_per_page'      => absint( newsmagbd_get_option('news_ticker_number') ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);	
			
			if ( absint( newsmagbd_get_option('select_category_for_news_ticker') ) > 0 ) {
				$qargs['cat'] = absint( newsmagbd_get_option('select_category_for_news_ticker') );
			}
			$the_query = new WP_Query( $qargs );
			if ( $the_query->have_posts() ) : ?>
                <div class="panel-body">
                    <ul id="newsTicker">
                    
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    
                        <li class="news-item">
                            <p><a href="<?php echo esc_url( get_permalink()); ?>"><?php the_title(); ?></a></p>
                        </li>
                    
                    <?php endwhile; ?>
                    
                    </ul>
                </div>
                <div class="panel-footer"> </div>

				<?php
				wp_reset_postdata();
				
           endif;
		}
	}
}

if( !function_exists('newsmagbd_header_start') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_header_start(){
	?>	
    <header class="header-menu">
	<?php
	}
}

if( !function_exists('newsmagbd_header_top_bar') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_header_top_bar(){
	?>	
    <!--START TOP BAR-->
    <div class="top-bar row">
        <div class="container">
            <div class="sub-top-bar">
                <div class="tracking-news pull-left">
                    <div class="panel panel-default">
                    	
                      	<?php newsmagbd_breaking_news();?>
                    </div>
                </div>
                <?php if( newsmagbd_get_option('social_profile') == 1 ) :?>
                <div class="login-register">
                 <?php $social_link = newsmagbd_get_option('newsmagbd_social_profile_link');?>
                    <ul class="social-btns">
					<?php  
                    if( count( $social_link['social'] ) > 0 ) :
                    
                        foreach ($social_link['social'] as $key => $link): 
                        
                            if( $link != ""):
                            ?>
                            
                            <li><a href="<?php echo esc_url( $link );?>" target="_blank"><i class="fa <?php echo esc_html($key);?>"></i></a></li>
                            <?php 
                            
                            endif;
                            
                        endforeach; 
                        
                    endif;?>  
                    </ul>
                    
                </div>
                <?php endif;?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--/END TOP BAR-->
	<?php
	}
}

if( !function_exists('newsmagbd_header_logo_bar') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_header_logo_bar(){
	?>	
        <!--START BOTTOM HEADER-->
        <div class="logo-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo">
                           
							<?php
                            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                            
                            the_custom_logo();
                            
                            }else{
                            ?>	
                            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html( $description ); ?></p>
                            <?php endif; ?>
                            <?php }?>   
                        </div>
                    </div>
                    <?php if ( is_active_sidebar( 'header_ad' ) ) : ?>
                    <div class="col-sm-9">
                        <?php dynamic_sidebar( 'header_ad' ); ?>    
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div><!-- Logo Bar -->
	<?php
	}
}

if( !function_exists('newsmagbd_header_menu_bar') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_header_menu_bar(){
	?>	
     <div class="container">
     
        <nav class="navbar navbar-default" role="navigation">
         
           
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              
            </div>
        
            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 3,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse navbar-left',
                    'container_id'      => 'bs-example-navbar-collapse-1',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker())
                );
            ?>
             <ul class="nav navbar-nav navbar-right">
                  
                  <li><a href="javascript:void(0)" class="header-search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                  
                </ul>
               
        </nav><!-- Menu Bar -->
        
      </div>
	<?php
	}
}
if( !function_exists('newsmagbd_fallback') ):
	/**
	* Menu Fallback
	* =============
	* If this function is assigned to the wp_nav_menu's fallback_cb variable
	* and a menu has not been assigned to the theme location in the WordPress
	* menu manager the function with display nothing to a non-logged in user,
	* and will add a link to the WordPress menu manager if logged in as an admin.
	*
	* @param array $args passed from the wp_nav_menu function.
	*/
	function newsmagbd_fallback( $args ) {
		if ( current_user_can( 'edit_theme_options' ) ) {
			/* Get Arguments. */
			$container = $args['container'];
			$container_id = $args['container_id'];
			$container_class = $args['container_class'];
			$menu_class = $args['menu_class'];
			$menu_id = $args['menu_id'];
			if ( $container ) {
				echo '<' . esc_attr( $container );
				if ( $container_id ) {
					echo ' id="' . esc_attr( $container_id ) . '"';
				}
				if ( $container_class ) {
					echo ' class="' . sanitize_html_class( $container_class ) . '"'; }
				echo '>';
			}
			echo '<ul';
			if ( $menu_id ) {
				echo ' id="' . esc_attr( $menu_id ) . '"'; }
			if ( $menu_class ) {
				echo ' class="' . esc_attr( $menu_class ) . '"'; }
			echo '>';
			echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_html__( 'Add a menu', 'newsmagbd' ). '</a></li>';
			echo '</ul>';
			if ( $container ) {
				echo '</' . esc_attr( $container ) . '>'; }
	}
}
endif;

if( !function_exists('newsmagbd_header_end') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_header_end(){
	?>	
    </header>
	<?php
	}
}



if( !function_exists('newsmagbd_footer_widgets') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_footer_widgets(){
	if ( is_active_sidebar( 'footer' ) ) :
	?>	
    <!--START FOOTER-->
    <footer>
        <div class="container">
                <div class="row">
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer' ); ?>    
                    </div>
                </div>
            </div>
    </footer>	
    <!--/END FOOTER-->
	<?php
	endif;
	}
}

if( !function_exists('newsmagbd_footer_end') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsmagbd_footer_end(){
	?>	
        <!--START BOTTOM BAR-->
    <div class="bottom-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 text-left">
                  <p class="copyright"><?php echo esc_html( newsmagbd_get_option('copyright_text') );?> <a href="<?php /* translators:straing */ echo esc_url(  'https://wordpress.org/' ); ?>"><?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s', 'newsmagbd' ),esc_html__( 'WordPress', 'newsmagbd' ) ); ?></a>
            | 
        <?php
        printf(  /* translators: %s: aThemeArt */ esc_html__( 'Theme: %1$s by %2$s.', 'newsmagbd' ), 'NewsMagbd', '<a href="' . esc_url('http://edatastyle.com' ) . '" target="_blank">' . esc_html__( 'eDataStyle', 'newsmagbd' ) . '</a>' ); ?>
                   </p>
                </div>
                
                
                <div class="col-md-4 col-sm-4 text-right">
                   
						<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'footer',
                            'depth'             => 1,
                            'container'         => 'div',
                            'container_class'   => 'footer-imp-links',
                            'menu_class'        => '',
                            'fallback_cb'       => 'newsmagbd_fallback',
                            )
                        );
                    ?>
                   
                </div>
            </div>
        </div>
    </div>
    <!--END BOTTOM BAR-->
    <a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>
	<?php
	}
}

if( !function_exists('newsmagbd__popup_search') ){
	/**
	* Add newsmagbd__popup_search
	*
	* @since 1.0.0
	*/
	function newsmagbd__popup_search(){
	?>
  
    <div class="search-here ">
        <?php get_search_form(); ?>
        <i class="fa fa-close"></i>
    </div>
    
    <?php
	}
}


/* -----------------------
/* BLOG START
/*-----------------------*/

if( !function_exists('newsmagbd_blog_content_start_wrp') ):
	/**
	* Add newsmagbd_blog_content_before_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_blog_content_before_wrp(){
	
	?>	
    <section>
     <div class="space">
       <div class="container">
        <div class="row">
	<?php
	
	}
endif;

if( !function_exists('newsmagbd_blog_start_loop_wrp') ):
	/**
	* Add newsmagbd_blog_start_loop_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_blog_start_loop_wrp(){
	
	?>	
    <!--START Left Section-->
    <div class="col-md-8" id="primary" class="content-area">
     <?php if( is_single() ){ ?>
     <main id="main" class="site-main postgrid-horiz grid-style-2">  
     <?php }else{ ?>
     <main id="main" class="site-main row postgrid-horiz grid-style-2">  
	<?php
		}
	}
endif;


if( !function_exists('newsmagbd_blog_end_loop_wrp') ):
	/**
	* Add newsmagbd_blog_end_loop_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_blog_end_loop_wrp(){
	
	?>	
      </main>   
     </div>
	<?php

	}
endif;


if( !function_exists('newsmagbd_blog_content_sidebar') ):
	/**
	* Add newsmagbd_blog_content_sidebar
	*
	* @since 1.0.0
	*/
	function newsmagbd_blog_content_sidebar(){
	
	?>	
    <div class="col-md-4">
   	 <?php get_sidebar(); ?>
    </div>
	<?php

	}
endif;

if( !function_exists('newsmagbd_blog_content_end_wrp') ):
	/**
	* Add newsmagbd_blog_content_end_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_blog_content_end_wrp(){
	
	?>	
   		 </div>
    	</div>
   	 </div>
    </section>
	<?php

	}
endif;


/* -----------------------
/* PAGE FUNCTION START
/*-----------------------*/

if( !function_exists('newsmagbd_page_content_start_wrp') ):
	/**
	* Add newsmagbd_page_content_start_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_page_content_start_wrp(){
	
	?>	
    <section>
     <div class="space">
       <div class="container">
        <div class="row">
	<?php
	
	}
endif;

if( !function_exists('newsmagbd_page_start_loop_wrp') ):
	/**
	* Add newsmagbd_blog_start_loop_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_page_start_loop_wrp(){
	
	?>	
    <!--START Left Section-->
    <div class="col-md-8" id="primary" class="content-area">
     <main id="main" class="site-main  postgrid-horiz grid-style-2">  
	<?php

	}
endif;


if( !function_exists('newsmagbd_page_end_loop_wrp') ):
	/**
	* Add newsmagbd_page_end_loop_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_page_end_loop_wrp(){
	
	?>	
      </main>   
     </div>
	<?php

	}
endif;


if( !function_exists('newsmagbd_page_content_sidebar') ):
	/**
	* Add newsmagbd_blog_content_sidebar
	*
	* @since 1.0.0
	*/
	function newsmagbd_page_content_sidebar(){
	
	?>	
    <div class="col-md-4">
   	 <?php get_sidebar(); ?>
    </div>
	<?php

	}
endif;

if( !function_exists('newsmagbd_page_content_end_wrp') ):
	/**
	* Add newsmagbd_blog_content_end_wrp
	*
	* @since 1.0.0
	*/
	function newsmagbd_page_content_end_wrp(){
	
	?>	
   		 </div>
    	</div>
   	 </div>
    </section>
	<?php

	}
endif;


if ( ! function_exists( 'newsmagbd_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_breadcrumb() {
		
			
		
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() .'/vendors/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
	
		breadcrumb_trail( $breadcrumb_args );
	
		
		
	}

endif;
add_action( 'newsmagbd_breadcrumb', 'newsmagbd_breadcrumb',10 );