<?php
/**
 * Template Name: Page Home Template
 *
 * Displays pre build layout for home page 
 *
 * @package wp-mint-magazine
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

		<?php if( is_active_sidebar( 'front-page-section-1-sidebar' ) ) { ?>
			<section class="pd_featured_post_section pd_featured_post">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php dynamic_sidebar( 'front-page-section-1-sidebar' ); ?>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
		if( is_active_sidebar( 'front-page-section-2-sidebar' ) || is_active_sidebar( 'front-page-section-3-sidebar' ) ) {
			?>
			<section class="pd_post_list_section pd_post_with_add_sidebar">
				<div class="container">
					<div class="row">          
						<div class="col-md-9 col-sm-10">
							<?php
							if( is_active_sidebar( 'front-page-section-2-sidebar' ) ) {
								dynamic_sidebar( 'front-page-section-2-sidebar' );
							}
							?>
						</div>
						<div class="col-md-3 col-sm-2">
							<div class="swift_sidebar_wrap swift-vertical-add-wrap">
								<?php
								if( is_active_sidebar( 'front-page-section-3-sidebar' ) ) {
									dynamic_sidebar( 'front-page-section-3-sidebar' );
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
		if( is_active_sidebar( 'front-page-section-4-sidebar' ) ) {
			?>
			<section class="pd-post-section">
				<div class="container">
					<?php dynamic_sidebar( 'front-page-section-4-sidebar' ); ?>
				</div>
			</section>
		<?php } ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
