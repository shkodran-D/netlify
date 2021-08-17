<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsMagbd
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="theme-layout">
          
<?php
	/**
	* Hook - newsmagbd_header_container.
	*
	* @hooked newsmagbd_header_start - 10
	* @hooked newsmagbd_header_top_bar - 20
	* @hooked newsmagbd_header_logo_bar - 30
	* @hooked newsmagbd_header_menu_bar - 30
	* @hooked newsmagbd_header_end - 30
	*/
	do_action( 'newsmagbd_header_container' );
?>


