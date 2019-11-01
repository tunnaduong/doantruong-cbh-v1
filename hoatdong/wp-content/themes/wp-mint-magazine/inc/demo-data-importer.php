<?php

add_action( 'import_end', 'wp_mint_magazine_demo_data_importer' );

/**
 * Hooked with "WordPress Importer" plugin's "import_end" hook
 * Pre-import configuration: Configure demo data related to widgets and other Customizer options which cannot be imported via the importer.
 * Configurations added are for aesthetics reasons so as to display proper layout with demo data.
 */
function wp_mint_magazine_demo_data_importer() {
	//update_option('wp_mint_magazine_demo_import_once', 'false');
	if( get_option( 'wp_mint_magazine_demo_import_once', 'false' ) === 'false' ) {

		/* removing 'Hello world!' and 'Sample page */
		$post = get_page_by_title( 'Hello world!', OBJECT, 'post' );
		if( !empty( $post ) ) {
			wp_trash_post( $post->ID );
		}
		$page = get_page_by_title( 'Sample page' );
		if( !empty( $page ) ) {
			wp_trash_post( $page->ID );
		}

		/* setting social links */
		set_theme_mod( 'wp_mint_magazine_facebook_link', 'https://www.facebook.com/TheMintTM/' );
		set_theme_mod( 'wp_mint_magazine_google_plus_link', 'https://plus.google.com/117111863723608022688' );
		set_theme_mod( 'wp_mint_magazine_twitter_link', 'https://twitter.com/TheMintTM' );
		set_theme_mod( 'wp_mint_magazine_linkedin_link', 'https://www.linkedin.com/company/theminttm/' );
		set_theme_mod( 'wp_mint_magazine_email_link', 'info@minttm.com' );

		/* setting home page and blog page as static page */
		$site_type = get_option( 'show_on_front' );
		if( $site_type == 'posts' ) {
			update_option( 'show_on_front', 'page' );
			$blog = get_page_by_title( 'Blog' );
			if( !empty( $blog ) ) {
				update_option( 'page_for_posts', $blog->ID );
			}
			$home = get_page_by_title( 'Home' );
			if( !empty( $home ) ) {
				update_option( 'page_on_front', $home->ID );
			}
		}

		/* setting widgets start */
		$term = get_term_by( 'name', 'Featured', 'category' );
		wp_mint_magazine_pre_set_widget( 'front-page-section-1-sidebar', 'wp_mint_magazine_post_grid_layout_style_1', array(
			"title"		 => "",
			"text"		 => "",
			"number"	 => 5,
			"type"		 => (empty( $term ) ? 'latest' : 'category'),
			"category"	 => (empty( $term ) ? '' : $term->term_id),
			"image"		 => "",
		) );
		wp_mint_magazine_pre_set_widget( 'front-page-section-1-sidebar', 'custom_html', array(
			'title'		 => '',
			'content'	 => '<a href="https://www.minttm.com/" style="display:block;text-align:center;background-color:#eee;padding:10px 0;">'
			. '<img alt="MintTM" src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/advetisement-banner2.png" style="max-width:100%;">'
			. '</a>',
		) );
		wp_mint_magazine_pre_set_widget( 'front-page-section-1-sidebar', 'wp_mint_magazine_post_grid_layout_style_2', array(
			"title"		 => "Latest posts",
			"text"		 => "",
			"number"	 => 4,
			"type"		 => 'latest',
			"category"	 => '',
			"image"		 => "",
		) );
		$term = get_term_by( 'name', 'Health', 'category' );
		wp_mint_magazine_pre_set_widget( 'front-page-section-1-sidebar', 'wp_mint_magazine_post_grid_layout_style_3', array(
			"title"		 => "Latest in Health",
			"text"		 => "",
			"number"	 => 7,
			"type"		 => (empty( $term ) ? 'latest' : 'category'),
			"category"	 => (empty( $term ) ? '' : $term->term_id),
			"image"		 => wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/cat_health.jpg',
		) );
		$term = get_term_by( 'name', 'Popular', 'category' );
		wp_mint_magazine_pre_set_widget( 'front-page-section-2-sidebar', 'wp_mint_magazine_post_grid_layout_style_4', array(
			"title"		 => "",
			"text"		 => "",
			"number"	 => 3,
			"type"		 => (empty( $term ) ? 'latest' : 'category'),
			"category"	 => (empty( $term ) ? '' : $term->term_id),
			"image"		 => "",
		) );
		wp_mint_magazine_pre_set_widget( 'front-page-section-3-sidebar', 'custom_html', array(
			'title'		 => '',
			'content'	 => '<a href="https://www.minttm.com/">'
			. '<img alt="MintTM" src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/advetisement-banner.png" style="max-width:100%;">'
			. '</a>',
		) );
		$term = get_term_by( 'name', 'Music', 'category' );
		wp_mint_magazine_pre_set_widget( 'front-page-section-4-sidebar', 'wp_mint_magazine_post_grid_layout_style_3', array(
			"title"		 => "Latest in Music",
			"text"		 => "",
			"number"	 => 7,
			"type"		 => (empty( $term ) ? 'latest' : 'category'),
			"category"	 => (empty( $term ) ? '' : $term->term_id),
			"image"		 => wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/cat_music.jpg',
		) );
		wp_mint_magazine_pre_set_widget( 'front-page-section-4-sidebar', 'custom_html', array(
			'title'		 => '',
			'content'	 => '<a href="https://www.minttm.com/" style="display:block;text-align:center;background-color:#eee;padding:10px 0;">'
			. '<img alt="MintTM" src="' . wp_mint_magazine_get_tmplt_dir_uri_esc() . '/img/advetisement-banner2.png" style="max-width:100%;">'
			. '</a>',
		) );
		$term = get_term_by( 'name', 'Popular', 'category' );
		wp_mint_magazine_pre_set_widget( 'front-page-section-4-sidebar', 'wp_mint_magazine_post_grid_layout_style_4', array(
			"title"		 => "",
			"text"		 => "",
			"number"	 => 4,
			"type"		 => (empty( $term ) ? 'latest' : 'category'),
			"category"	 => (empty( $term ) ? '' : $term->term_id),
			"image"		 => "",
		) );
		wp_mint_magazine_pre_set_widget( 'footer-full-width-sidebar', 'text', array(
			"title"	 => "",
			"text"	 => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
		) );

		update_option( 'wp_mint_magazine_demo_import_once', 'true' );
	}
}

/**
 * Pre-configure and save a widget, designed for plugin and theme activation.
 * 
 * @param   string  $sidebar    The database name of the sidebar to add the widget to.
 * @param   string  $name       The database name of the widget.
 * @param   mixed   $args       The widget arguments (optional).
 */
function wp_mint_magazine_pre_set_widget( $sidebar, $name, $args = array() ) {
	if( !$sidebars = get_option( 'sidebars_widgets' ) )
		$sidebars = array();

	// Create the sidebar if it doesn't exist.
	if( !isset( $sidebars[ $sidebar ] ) )
		$sidebars[ $sidebar ] = array();

	// Check for existing saved widgets.
	if( $widget_opts = get_option( "widget_$name" ) ) {
		// Get next insert id.
		ksort( $widget_opts );
		end( $widget_opts );
		$insert_id = intval( key( $widget_opts ) );
	} else {
		// None existing, start fresh.
		$widget_opts = array( '_multiwidget' => 1 );
		$insert_id = 0;
	}
	if( empty( $insert_id ) ) {
		$insert_id = 0;
	}

	// Add our settings to the stack.
	$widget_opts[ ++$insert_id ] = $args;
	// Add our widget!
	$sidebars[ $sidebar ][] = "$name-$insert_id";

	update_option( 'sidebars_widgets', $sidebars );
	update_option( "widget_$name", $widget_opts );
}
