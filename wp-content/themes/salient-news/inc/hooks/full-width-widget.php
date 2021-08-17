<?php

if ( !function_exists('salient_news_widget_blcok') ) :

	/**
     * Blank Block Widgeet Section
     *
     * @since Bizlight Pro 1.0.0
     *
     * @param null
     * @return null
     *
     */
	function salient_news_widget_blcok()
	{
		global $salient_news_customizer_all_values;

		if ( is_active_sidebar('full-width-widget')  ) {  ?>
			<div class="container">
				<div class="row">
					<section class="st-full-width-widget-style clearfix" id="st-full-width">
						<?php dynamic_sidebar('full-width-widget'); ?>
					</section>
				</div>
			</div>			
		<?php }
	}
endif;
add_action('salient_news_action_front_page','salient_news_widget_blcok');