<?php

/**
 * wp-mint-magazine Theme Customizer
 *
 * @package wp-mint-magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_mint_magazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'			 => '.site-title a',
			'render_callback'	 => 'wp_mint_magazine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'			 => '.site-description',
			'render_callback'	 => 'wp_mint_magazine_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( 'wp_mint_magazine_layout_settings_section', array(
		'title'		 => __( 'Layout options', 'wp-mint-magazine' ),
		'priority'	 => 30,
	) );
	$wp_customize->add_setting( 'wp_mint_magazine_layout_style', array(
		'default'			 => 'box',
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'wp_mint_magazine_sanitize_choices',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_layout_style', array(
		'label'		 => __( 'Select website layout:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_layout_settings_section',
		'settings'	 => 'wp_mint_magazine_layout_style',
		'type'		 => 'radio',
		'choices'	 => array(
			'box'	 => __( 'Box Layout', 'wp-mint-magazine' ),
			'wide'	 => __( 'Wide Layout', 'wp-mint-magazine' )
) ) ) );
	$wp_customize->selective_refresh->add_partial( 'wp_mint_magazine_layout_style', array(
		'selector'			 => '#page',
		'render_callback'	 => '__return_false',
	) );
	$wp_customize->add_setting( 'wp_mint_magazine_header_style', array(
		'default'			 => 'style_1',
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'wp_mint_magazine_sanitize_choices',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_header_style', array(
		'label'		 => __( 'Select header style:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_layout_settings_section',
		'settings'	 => 'wp_mint_magazine_header_style',
		'type'		 => 'radio',
		'choices'	 => array(
			'style_1'	 => __( 'Style 1 (Center aligned)', 'wp-mint-magazine' ),
			'style_2'	 => __( 'Style 2 (Left aligned)', 'wp-mint-magazine' )
) ) ) );
	$wp_customize->selective_refresh->add_partial( 'wp_mint_magazine_header_style', array(
		'selector'			 => '#page',
		'render_callback'	 => '__return_false',
	) );

	$wp_customize->add_section( 'wp_mint_magazine_social_links_section', array(
		'title'		 => __( 'Social Links', 'wp-mint-magazine' ),
		'priority'	 => 40,
	) );
	$wp_customize->add_setting( 'wp_mint_magazine_facebook_link', array(
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_facebook_link', array(
		'type'		 => 'url',
		'label'		 => __( 'Facebook link:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_social_links_section',
		'settings'	 => 'wp_mint_magazine_facebook_link',
	) ) );
	$wp_customize->add_setting( 'wp_mint_magazine_google_plus_link', array(
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_google_plus_link', array(
		'type'		 => 'url',
		'label'		 => __( 'Google+ link:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_social_links_section',
		'settings'	 => 'wp_mint_magazine_google_plus_link',
	) ) );
	$wp_customize->add_setting( 'wp_mint_magazine_twitter_link', array(
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_twitter_link', array(
		'type'		 => 'url',
		'label'		 => __( 'Twitter link:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_social_links_section',
		'settings'	 => 'wp_mint_magazine_twitter_link',
	) ) );
	$wp_customize->add_setting( 'wp_mint_magazine_linkedin_link', array(
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_linkedin_link', array(
		'type'		 => 'url',
		'label'		 => __( 'LinkedIn link:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_social_links_section',
		'settings'	 => 'wp_mint_magazine_linkedin_link',
	) ) );
	$wp_customize->add_setting( 'wp_mint_magazine_email_link', array(
		'transport'			 => 'postMessage',
		'sanitize_callback'	 => 'sanitize_email',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'wp_mint_magazine_email_link', array(
		'type'		 => 'email',
		'label'		 => __( 'Email Address:', 'wp-mint-magazine' ),
		'section'	 => 'wp_mint_magazine_social_links_section',
		'settings'	 => 'wp_mint_magazine_email_link',
	) ) );
	$wp_customize->selective_refresh->add_partial( 'wp_mint_magazine_facebook_link', array(
		'selector'			 => '.social-media-links',
		'render_callback'	 => '__return_false',
	) );
}

add_action( 'customize_register', 'wp_mint_magazine_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_mint_magazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_mint_magazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_mint_magazine_customize_preview_js() {
	wp_enqueue_script( 'wp-mint-magazine-customizer', wp_mint_magazine_get_tmplt_dir_uri_esc() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'wp_mint_magazine_customize_preview_js' );


function wp_mint_magazine_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}