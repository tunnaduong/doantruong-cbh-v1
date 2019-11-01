<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-mint-magazine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "pd_post_single_article" ); ?>>

    <div class="pd_mag_post_title_wrap ">
		<?php
		if( is_singular() ) :
			the_title( '<h1 class="entry-title pd_mag_post_title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title pd_mag_post_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
    </div>
	<?php if( has_post_thumbnail() ) { ?>
		<figure class="pd_post_single_img">
			<?php wp_mint_magazine_post_thumbnail(); ?>
		</figure>
	<?php } ?>

    <div class="article-content pd_post_content">
        <div class="pd_post_single_meta">
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
				if( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta pd_post_author"> <i class="fa fa-bars"></i>
						<?php wp_mint_magazine_posted_on(); ?> |<?php
						wp_mint_magazine_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
            </header><!-- .entry-header -->
        </div>
        <div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-mint-magazine' ),
				'after'	 => '</div>',
			) );
			?>
        </div><!-- .entry-content -->
        <div class="pd_post_tag_label">
			<?php
			$tags = get_the_tags();
			if( !empty( $tags ) ) {
				foreach( $tags as $tag ) {
					echo '<a class="tag" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '"  rel="tags">' . esc_html( $tag->name ) . '</a>';
				}
			}
			?>
        </div>

        <footer class="entry-footer pd_post_single_footer">
			<?php wp_mint_magazine_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
