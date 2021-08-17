<!-- Footer Widget Secton -->
   <!--start footer-->
	    <div class="site-footer">
			<div class="module-extra bg-dark">
				<div class="container">
					<div class="row">
						<?php 
						// Fetch cryptocurrency exchange Theme Footer Widget
						if ( is_active_sidebar( 'footer-widget' ) ){
							dynamic_sidebar( 'footer-widget' );
						} ?>
					</div>
				</div>
			</div>
		</div>
		<hr class="divider-d">
		<?php get_template_part('site-info'); ?>
		</div>
		<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
	</main>	
	<?php wp_head(); ?>
		<?php 
		// get footer bottom
		get_template_part('/include/widgets/footer-bottom');
		
		wp_footer();
		?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148374213-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148374213-1');
</script>
<script type="text/javascript">
    amzn_assoc_ad_type = "link_enhancement_widget";
    amzn_assoc_tracking_id = "mystoreid08-20";
    amzn_assoc_linkid = "35327afba550f1a7478b010b528206a8";
    amzn_assoc_placement = "";
    amzn_assoc_marketplace = "amazon";
    amzn_assoc_region = "US";
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0" nonce="iRF6MkRn"></script>	
</body>
</html>