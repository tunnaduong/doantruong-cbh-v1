<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-mint-magazine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "pd_post_single_article" ); ?>>
    <header class="entry-header pd_mag_post_title_wrap">
		<?php the_title( '<h1 class="entry-title pd_mag_post_title">', '</h1>' ); ?>
    </header><!-- .entry-header -->
	<?php if( has_post_thumbnail() ) { ?>
		<figure class="pd_post_single_img">
			<?php wp_mint_magazine_post_thumbnail(); ?>
		</figure>
	<?php } ?>

    <div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-mint-magazine' ),
			'after'	 => '</div>',
		) );
		?>
    </div><!-- .entry-content -->

	<?php if( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
					sprintf(
							wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-mint-magazine' ), array(
				'span' => array(
					'class' => array(),
				),
									)
							), get_the_title()
					), '<span class="edit-link">', '</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
