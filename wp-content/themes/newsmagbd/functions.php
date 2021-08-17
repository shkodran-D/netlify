<?php

/**
 * Implement the Theme Core function.
 */
require get_template_directory() . '/inc/core.php';
/**
 * Implement the Theme Core function.
 */
require get_template_directory() . '/vendors/wp-bootstrap-navwalker/wp-bootstrap-navwalker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom function for this theme.
 */
require get_template_directory() . '/inc/theme_function.php';
/**
 * Custom hook for this theme.
 */
require get_template_directory() . '/inc/theme_hook.php';
/**
 * Custom  Post Related Hook for this theme.
 */
require get_template_directory() . '/inc/post_hooks.php';
/**
 * filter function tags for this theme.
 */
require get_template_directory() . '/inc/filter.php';

/**
 * Widgets Class
 */
require_once get_template_directory() . '/vendors/widget-helper/class-widget-helper.php';
/**
 * Custom widgets for this theme.
 */
require get_template_directory() . '/inc/wigets.php';
/**
 * customizer for this theme.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets Class
 */
require_once get_template_directory() . '/vendors/breadcrumbs/breadcrumbs.php';


/**
* Load All Filter Hook
*/
require get_template_directory() . '/inc/pro/newsmagbd-admin-page.php';

/**
* Load All Filter Hook
*/
require get_template_directory() . '/inc/tgm/loader.php';

add_theme_support( 'responsive-embeds' );

