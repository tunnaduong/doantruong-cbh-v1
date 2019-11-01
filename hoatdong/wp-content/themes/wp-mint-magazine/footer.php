<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-mint-magazine
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer pd_mag_footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pd_mag_footer_logo_wrap">
					<?php
					if( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer_brand" rel="home">
								<span class="pd-mag-brand-title"><?php bloginfo( 'name' ); ?></span>
							</a>
						</h1>
					<?php } ?>
                </div>
                <div class="pd_mag_footer_social_wrap">
					<?php wp_mint_magazine_rendar_social_links(); ?>
                </div>
                <div class="pd_mag_footer_links_wrap clearfix">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-nav',
						'menu_id'		 => 'footer-menu',
						'menu_class'	 => 'footer_links',
						'container'		 => 'ul',
					) );
					?>
                </div>
            </div>
        </div>
    </div>

    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
                    <div class="pd_mag_footer_content">
						<?php
						if( is_active_sidebar( 'footer-full-width-sidebar' ) ) {
							dynamic_sidebar( 'footer-full-width-sidebar' );
						}
						?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pd_mag_footer_copyright_wrap">
                        <div class="copyright_contnet">
							<?php echo esc_html__( '&copy; Copyrights', 'wp-mint-magazine' ) . esc_html( date_i18n( __( ' Y,', 'wp-mint-magazine') ) ) ?>
                            <?php bloginfo( 'name' ); ?>
                            <span class="swm-themeby">
								<?php esc_html_e( 'A theme by', 'wp-mint-magazine' ) ?>
                                <a href="<?php echo esc_url( __( 'https://www.minttm.com/', 'wp-mint-magazine' ) ); ?>">
									<?php esc_html_e( 'MintTM', 'wp-mint-magazine' ); ?>
                                </a>
                            </span>
                        </div>
                        <div class="pd_mag_poweredby">
							<?php esc_html_e( 'Proudly powered by', 'wp-mint-magazine' ) ?>
                            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp-mint-magazine' ) ); ?>">
								<?php esc_html_e( 'WordPress', 'wp-mint-magazine' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .site-info -->
    <a id="back-to-top" href="#" class="back-to-top" title="<?php echo esc_attr_x( 'Back to Top', 'title', 'wp-mint-magazine' ) ?>" role="button" >
        <span class="fa fa-angle-up"></span>
    </a>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
