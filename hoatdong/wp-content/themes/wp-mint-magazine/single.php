<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp-mint-magazine
 */
get_header();
?>
<section class="pd_post_single_section pd_post_with_add_sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">

						<?php
						while( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

							the_post_navigation();

							// If comments are open or we have at least one comment, load up the comment template.
							if( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-3 col-sm-4">
				<?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>



<?php
get_footer();
