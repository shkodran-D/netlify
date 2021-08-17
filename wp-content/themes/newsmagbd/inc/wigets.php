<?php
/**
 * Custom theme widgets.
 *
 * @package NewsMagbd
 */

if ( ! function_exists( 'newsmagbd_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function newsmagbd_register_widgets() {

		// Recent Posts extended widget.
		register_widget( 'NewsMagbd_Slider_Widget' );

	}

endif;

add_action( 'widgets_init', 'newsmagbd_register_widgets' );


if ( ! class_exists( 'NewsMagbd_Slider_Widget' ) ) :

	/**
	 * Recent posts extended widget class.
	 *
	 * @since 1.0.0
	 */
	class NewsMagbd_Slider_Widget extends NewsMagbd_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'newsmagbd-slider-extended';
			$args['label'] = esc_html__( 'News Mag: Slider', 'newsmagbd' );

			$args['widget'] = array(
				'classname'                   => 'newsmagbd_widget_slider_extended',
				'description'                 => esc_html__( 'Add News Slider Widgets', 'newsmagbd' ),
				'customize_selective_refresh' => true,
			 	'panels_groups' => array('newsmagbd')
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'newsmagbd' ),
					'type'  => 'text',
					'class' => 'widefat',
					'default'     => esc_html__( ' Trending News ', 'newsmagbd' ),
					),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'newsmagbd' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'newsmagbd' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'newsmagbd' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 100,
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			
			$values = $this->get_field_values( $instance );
			

			echo $args['before_widget'];

			$qargs = array(
				'posts_per_page'      => absint( $values['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);	
			
			if ( absint( $values['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $values['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>
				
        <section>
        <div class="posts-with-carousel">
            <div class="pp-featured-caro">
            
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="pp-caro-unit">
                   
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); } else { echo ' <img src="'.esc_url( get_template_directory_uri(). '/assets/images/846x450.png' ).'">'; } ?>
                    <div class="entrance">
                        <div class="post-detail">
                            <h3> <a href="<?php echo esc_url( get_permalink()); ?>"  title="<?php the_title_attribute();?>"> <?php the_title();?></a></h3>
                            <?php
                            /**
                            * Hook - newsmagbd_posted_on.
                            *
                            * @hooked newsmagbd_posted_on - 10
                            */
                            do_action( 'newsmagbd_posted_on' );
                            ?>  
                        </div>
        
                    </div>
                </div>
                
               <?php endwhile; ?>
                
                
            </div>
        </div>	
        </section>
				

				<?php
					wp_reset_postdata();
					
                ?>

			<?php endif; ?>

			<?php

			echo $args['after_widget'];

		}

	}

endif;


