<?php

/*
 * wp-mint-magazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-mint-magazine
 */

define( 'WP_MINT_MAGAZINE_VERSION', '1.0.0' );
if( !isset( $content_width ) ) {
	$content_width = 900;
}

/**
 * Use to get escaped url of template directory
 * @return string $url
 */
function wp_mint_magazine_get_tmplt_dir_uri_esc() {
	global $wp_mint_magazine_tmplt_dir_uri;
	if( empty( $wp_mint_magazine_tmplt_dir_uri ) ) {
		$wp_mint_magazine_tmplt_dir_uri = esc_url( get_template_directory_uri() );
	}
	return $wp_mint_magazine_tmplt_dir_uri;
}

/**
 * Use to get escaped url of stylesheet directory
 * @return string $url
 */
function wp_mint_magazine_get_stlst_dir_uri_esc() {
	global $wp_mint_magazine_stlst_dir_uri;
	if( empty( $wp_mint_magazine_stlst_dir_uri ) ) {
		$wp_mint_magazine_stlst_dir_uri = esc_url( get_stylesheet_directory_uri() );
	}
	return $wp_mint_magazine_stlst_dir_uri;
}

if( !function_exists( 'wp_mint_magazine_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_mint_magazine_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wp-mint-magazine, use a find and replace
		 * to change 'wp-mint-magazine' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-mint-magazine', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		// set_post_thumbnail_size(100, 100);
		add_image_size( 'wp_mint_magazine_image_255x208', 255, 208, true );
		add_image_size( 'wp_mint_magazine_image_652x540', 652, 540, true );
		add_image_size( 'wp_mint_magazine_image_682x505', 682, 505, true );
		add_image_size( 'wp_mint_magazine_image_325x230', 325, 230, true );
		add_image_size( 'wp_mint_magazine_image_680x415', 680, 415, true );

		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus( array(
			'primary-nav'	 => esc_html__( 'Primary', 'wp-mint-magazine' ),
			'footer-nav'	 => esc_html__( 'Footer', 'wp-mint-magazine' ),
			'toggle-nav'	 => esc_html__( 'Toggle menu', 'wp-mint-magazine' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css' ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'		 => 50,
			'width'			 => 200,
			'flex-width'	 => true,
			'flex-height'	 => true,
		) );

		add_post_type_support( 'post', 'excerpt' );
	}

endif;
add_action( 'after_setup_theme', 'wp_mint_magazine_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_mint_magazine_widgets_init() {
	register_sidebar( array(
		'name'			 => esc_html__( 'Single post right sidebar', 'wp-mint-magazine' ),
		'id'			 => 'sidebar-1',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Front page section 1 sidebar', 'wp-mint-magazine' ),
		'id'			 => 'front-page-section-1-sidebar',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Front page section 2 sidebar', 'wp-mint-magazine' ),
		'id'			 => 'front-page-section-2-sidebar',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Front page section 3 sidebar', 'wp-mint-magazine' ),
		'id'			 => 'front-page-section-3-sidebar',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );
	register_sidebar( array(
		'name'			 => esc_html__( 'Front page section 4 sidebar', 'wp-mint-magazine' ),
		'id'			 => 'front-page-section-4-sidebar',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );

	register_sidebar( array(
		'name'			 => esc_html__( 'Footer full width sidebar', 'wp-mint-magazine' ),
		'id'			 => 'footer-full-width-sidebar',
		'description'	 => esc_html__( 'Add widgets here.', 'wp-mint-magazine' ),
		'before_widget'	 => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</section>',
		'before_title'	 => '<h2 class="widget-title">',
		'after_title'	 => '</h2>',
	) );

	require get_template_directory() . '/inc/widgets.php';
	register_widget( "wp_mint_magazine_post_grid_layout_style_1" );
	register_widget( "wp_mint_magazine_post_grid_layout_style_2" );
	register_widget( "wp_mint_magazine_post_grid_layout_style_3" );
	register_widget( "wp_mint_magazine_post_grid_layout_style_4" );
}

add_action( 'widgets_init', 'wp_mint_magazine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_mint_magazine_scripts() {
	wp_enqueue_style( 'wp-mint-magazine-google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' );
	wp_enqueue_style( 'bootstrap', wp_mint_magazine_get_tmplt_dir_uri_esc() . '/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', wp_mint_magazine_get_tmplt_dir_uri_esc() . '/css/font-awesome.css' );

	wp_enqueue_style( 'wp-mint-magazine-style', esc_url( get_stylesheet_uri() ) );

	wp_enqueue_script( 'bootstrap', wp_mint_magazine_get_tmplt_dir_uri_esc() . '/js/bootstrap.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'wp-mint-magazine-custom-js', wp_mint_magazine_get_tmplt_dir_uri_esc() . '/js/custom.js', array( 'jquery' ), false, true );

	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'wp_mint_magazine_scripts' );

/*
 * Only load if is admin area
 */
if( is_admin() ) {

	/**
	 * Enqueue admin area scripts and styles
	 */
	function wp_mint_magazine_admin_enqueue_script() {
		global $wp_mint_magazine_admin_js_onetime_loaded;
		if( !empty( $wp_mint_magazine_admin_js_onetime_loaded ) ) {
			return;
		}
		$wp_mint_magazine_admin_js_onetime_loaded = true;

		wp_enqueue_style( 'wp-mint-magazine-admin-custome-css', wp_mint_magazine_get_stlst_dir_uri_esc() . '/css/admin.css' );
		wp_enqueue_script( 'wp-mint-magazine-admin-custome-js', wp_mint_magazine_get_stlst_dir_uri_esc() . '/js/admin.js' );
		$wp_mint_magazine_data = array(
			'stylesheet_directory_uri'	 => wp_mint_magazine_get_stlst_dir_uri_esc(),
			'template_directory_uri'	 => wp_mint_magazine_get_tmplt_dir_uri_esc(),
		);
		wp_localize_script( 'wp-mint-magazine-admin-custome-js', 'wp_mint_magazine_data', $wp_mint_magazine_data );
		wp_enqueue_script( 'wp-mint-magazine-admin-custome-js' );
	}

	add_action( 'admin_enqueue_scripts', 'wp_mint_magazine_admin_enqueue_script' );
	add_action( 'customize_controls_enqueue_scripts', 'wp_mint_magazine_admin_enqueue_script' );

	/*
	 * setup for plugins recommnded by theme
	 */
	require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/theme-recommnded-plugins.php';

	/*
	 * add some custom widgets and menus when wordpress importer is runs
	 */
	require_once get_template_directory() . '/inc/demo-data-importer.php';
}

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if( defined( 'JETPACK__VERSION' ) ) {
	require_once get_template_directory() . '/inc/jetpack.php';
}

/**
 * used to show social media icons from theme customizer
 */
function wp_mint_magazine_rendar_social_links( $echo = true ) {
	$facebook = esc_url( get_theme_mod( 'wp_mint_magazine_facebook_link', '' ) );
	$google = esc_url( get_theme_mod( 'wp_mint_magazine_google_plus_link', '' ) );
	$twitter = esc_url( get_theme_mod( 'wp_mint_magazine_twitter_link', '' ) );
	$linkedin = esc_url( get_theme_mod( 'wp_mint_magazine_linkedin_link', '' ) );
	$email = esc_url( 'mailto:' . sanitize_email( get_theme_mod( 'wp_mint_magazine_email_link', '' ) ) );

	$html = '';
	if( !empty( $facebook ) ) {
		$lbl = __( 'Facebook', 'wp-mint-magazine' );
		$html .= '<li class="social-facebook"><a href="' . $facebook . '" title="' . $lbl . '" data-toggle="tooltip"><i class="fa fa-facebook"></i><span>' . $lbl . '</span></a></li>';
	}
	if( !empty( $google ) ) {
		$lbl = __( 'Google+', 'wp-mint-magazine' );
		$html .= '<li class="social-google_plus"><a href="' . $google . '" title="' . $lbl . '" data-toggle="tooltip"><i class="fa fa-google-plus"></i><span>' . $lbl . '</span></a></li>';
	}
	if( !empty( $twitter ) ) {
		$lbl = __( 'Twitter', 'wp-mint-magazine' );
		$html .= '<li class="social-twitter"><a href="' . $twitter . '" title="' . $lbl . '" data-toggle="tooltip"><i class=" fa fa-twitter"></i><span>' . $lbl . '</span></a></li>';
	}
	if( !empty( $linkedin ) ) {
		$lbl = __( 'LinkedIn', 'wp-mint-magazine' );
		$html .= '<li class="social-linkedin"><a href="' . $linkedin . '" title="' . $lbl . '" data-toggle="tooltip"><i class=" fa fa-linkedin"></i><span>' . $lbl . '</span></a></li>';
	}
	if( !empty( $email ) ) {
		$lbl = __( 'Email', 'wp-mint-magazine' );
		$html .= '<li class="social-email"><a href="' . $email . '" title="' . $lbl . '" data-toggle="tooltip"><i class="fa fa-envelope"></i><span>' . $lbl . '</span></a></li>';
	}
	if( !empty( $html ) ) {
		$html = '<ul class="social-media-links footer_social_link">' . $html . '</ul>';
	}
	if( !$echo ) {
		return $html;
	}
	echo $html;
}

/**
 * Filter the excerpt length.
 */
function wp_mint_magazine_excerpt_length( $length ) {
	if( is_admin() ) {
		return $length;
	}
	return 20;
}

add_filter( 'excerpt_length', 'wp_mint_magazine_excerpt_length' );
