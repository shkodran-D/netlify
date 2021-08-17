<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsMagbd
 */

?>


<?php
	/**
	* Hook - newsmagbd_footer_container.
	*
	* @hooked newsmagbd_footer_widgets - 10
	* @hooked newsmagbd_footer_end - 20
	*/
	do_action( 'newsmagbd_footer_container' );
?>


</div>

<?php wp_footer(); ?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>
