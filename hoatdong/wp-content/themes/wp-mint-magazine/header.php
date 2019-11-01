<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-mint-magazine
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-mint-magazine' ); ?></a>

            <div class="sidebar-nav-overlay"></div>

            <header id="masthead" class="site-header">
				<?php
				if( is_active_sidebar( 'header-above-nav-sidebar' ) ) {
					dynamic_sidebar( 'header-above-nav-sidebar' );
				}
				?>
                <!-- /. mobile-menu-toggle  -->
                <div class="navbar-mobile-collapse" id="cc-navbar-mobile-collapse">
                    <div class="mobile-collapse-container">
                        <div class="mob-menu-header clearfix">
                            Menu
                            <a href="javascript:;" class="close-mob-menu">
                                <span>&nbsp;</span>
                            </a>
                        </div>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'toggle-nav',
							'menu_id'		 => 'toggle-nav-menu',
							'menu_class'	 => 'toggle_nav_links',
							'container'		 => 'ul',
						) );
						?>
                    </div>
                </div>
                <!-- /. mobile-menu-toggle  -->
                <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-pd-mag" role="banner">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-nav-bar-col">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span> 
                            </button>
                            <button type="button" class="sidemenu-toggle btn-mob-menu">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span> 
                            </button>  
							<?php
							if( has_custom_logo() ) {
								the_custom_logo();
							} else {
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								$wp_mint_magazine_description = get_bloginfo( 'description', 'display' );
								if( $wp_mint_magazine_description || is_customize_preview() ) {
									?>
									<p class="site-description"><?php echo $wp_mint_magazine_description; /* WPCS: xss ok. */ ?></p>
									<?php
								}
							}
							?>

                            <ul class="nav navbar-nav navbar-right search-bar">
                                <li class=""><a href="#toggle-search" class="animate"><i class="fa fa-search"></i> <i class="fa fa-times"></i></a></li>                
								<?php /* <li><a href="#"><i class="fa fa-search"></i><?php get_search_form(); ?></a></li> */ ?>
                            </ul>
                        </div>
                        <div class="collapse navbar-collapse" id="primary-nav-bar-col">
                            <button type="button" class="sidemenu-toggle btn-mob-menu">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span> 
                            </button>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'primary-nav',
								'menu_id'		 => 'primary-menu',
								'menu_class'	 => 'nav navbar-nav main-navbar clearfix',
								'container'		 => 'ul',
							) );
							?>
                            <div class="hidden-sm hidden-md hidden-lg">
								<?php
								if( has_custom_logo() ) {
									the_custom_logo();
								} else {
									?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php
								}
								?>
                            </div>
                            <ul class="nav navbar-nav navbar-right search-bar">
                                <li class=""><a href="#toggle-search" class="animate"><i class="fa fa-search"></i> <i class="fa fa-times"></i></a></li>                
                            </ul>
                        </div>
                    </div>
                    <div class="bootsnipp-search animate">
                        <div class="container">
							<?php get_search_form(); ?>
                        </div>
                    </div>
                </nav><!-- #site-navigation -->
                <div class="hidden-header-fixed"></div>
            </header><!-- #masthead -->

            <div id="content" class="site-content">
