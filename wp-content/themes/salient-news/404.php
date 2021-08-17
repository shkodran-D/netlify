<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package news
 */

get_header(); ?>
	<div class="container">
		<div id="primary-404" class="content-area">
			<main id="main" class="site-main">

				<section class="error-404 not-found">
					<div class="pgae-content-error">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'salient-news' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'salient-news' ); ?></p>

							<?php
								get_search_form();
							?>
						</div><!-- .page-content -->
					</div>
				</section><!-- .error-404 -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- container -->
<?php
get_footer();
