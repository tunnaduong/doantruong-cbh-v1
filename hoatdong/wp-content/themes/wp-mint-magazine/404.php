<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp-mint-magazine
 */
get_header();
?>
<section class="pd_post_list_section pd_post_with_add_sidebar">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-8">
				<header class="page-header pd_post_list_page_header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-mint-magazine' ); ?></h1>
				</header><!-- .page-header -->
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<div class="pd_post_list_wrap">
							<div class="page-content">
								<p class="pd_mag_404_text"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-mint-magazine' ); ?></p>
								<div class="pd_mag_404_search_form_wrap">
									<?php get_search_form(); ?>
								</div>
							</div><!-- .page-content -->
						</div><!-- .error-404 -->
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div class="col-md-3 col-sm-4">
				<div class="swift_sidebar_wrap">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
