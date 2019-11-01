<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-mint-magazine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "pd_post_list_article" ); ?>>
    <div class="row">
		<?php if( has_post_thumbnail() ) { ?>
			<div class="col-md-6">
				<figure class="pd_post_img">
					<?php wp_mint_magazine_post_thumbnail(); ?>
				</figure>
			</div>
			<div class="col-md-6">
			<?php } else { ?>
				<div class="col-md-12"> 
				<?php } ?>
                <div class="article-content pd_post_content">
                    <div class="pd_post_cat_label">
						<?php
						$categories = get_the_category();
						if( !empty( $categories ) ) {
							foreach( $categories as $category ) {
								echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"  rel="category tag">' . esc_html( $category->cat_name ) . '</a>';
							}
						}
						?>
                    </div>
                    <header class="entry-header">
						<?php
						if( is_singular() ) :
							?>
						<h1 class="entry-title pd_post_content_title" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</h1>
							<?php
						else :
							?>                    
							<h2 class="entry-title pd_post_content_title" title="<?php the_title_attribute() ?>"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a></h2><?php
						endif;

						if( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta pd_post_author"> <i class="fa fa-bars"></i>
								<?php wp_mint_magazine_posted_on(); ?> |<?php
								wp_mint_magazine_posted_by();
								?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
                    </header><!-- .entry-header -->
                    <div class="pd_post_excerpt_info">
						<?php the_excerpt(); ?>
                    </div>
                    <footer class="entry-footer pd_post_list_footer">
						<?php wp_mint_magazine_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </div>
            </div>
        </div>







</article><!-- #post-<?php the_ID(); ?> -->
