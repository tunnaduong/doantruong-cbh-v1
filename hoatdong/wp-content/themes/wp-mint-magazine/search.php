<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
                    <h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'wp-mint-magazine' ), '<span>' . get_search_query() . '</span>' );
						?>
                    </h1>
                </header>
            </div>
            <div class="col-md-9 col-sm-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="pd_post_list_wrap">
							<?php if( have_posts() ) : ?>


								<?php
								/* Start the Loop */
								while( have_posts() ) :
									the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

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
