<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-mint-magazine
 */
get_header();
?>

<section class="pd_post_list_section pd_post_with_add_sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="page-header pd_post_list_page_header">
					<?php
					if( have_posts() ) :

						if( is_home() && !is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
							<?php
						endif;
					endif;
					?>
                </header>
            </div>
            <div class="col-md-9 col-sm-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="pd_post_list_wrap">
							<?php
							if( have_posts() ) :


								/* Start the Loop */
								while( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content' );

								endwhile;

								//the_posts_navigation();
								the_posts_pagination();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>
                        </div>
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
