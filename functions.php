<?php

/**
 * functions.php
 * The theme's functions.php
 */

/**
 * 1 . CONSTANTS
 */
define( 'THEME_URI', get_stylesheet_directory_uri() );
const IMAGES = THEME_URI . '/assets/img';
const JS     = THEME_URI . '/assets/js';
const DOMAIN = 'benawpbootstrapportfolio';

/**
 * 2 . CONSTANTS
 */
if ( ! function_exists( 'benawp_theme_setup' ) ) {
	function benawp_theme_setup() {
		// Make the theme available for translation
		$lang_dir = THEME_URI . '/languages';
		load_theme_textdomain( DOMAIN, $lang_dir );

		// Add support for automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Add support for post thumbanails
		add_theme_support( 'post-thumbnails' );

		// Register nav menus
		register_nav_menus(
			array(
				'main-menu' => __( 'Menu Principal', DOMAIN )
			)
		);
	}

	add_action( 'after_setup_theme', 'benawp_theme_setup' );
}