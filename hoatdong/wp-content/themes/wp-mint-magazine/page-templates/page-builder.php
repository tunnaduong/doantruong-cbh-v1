<?php
/**
 * Template Name: Page Builder Template
 *
 * Displays the Page Builder Template provided via the theme.
 * Suitable for page builder plugins
 *
 * @package wp-mint-magazine
 */
get_header();
?>

<section class="page-builder-section">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
				<?php
				while( have_posts() ) : the_post();

					the_content();

				endwhile;
				?>  
            </main>
        </div>
    </div>
</section>
<?php get_footer(); ?>
