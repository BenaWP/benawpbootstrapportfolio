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
 * 2 . SETUP THEME
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

/**
 * 3 . GET POST META
 */
if ( ! function_exists( 'benawp_post_meta' ) ) {
	function benawp_post_meta() {
		if ( get_post_type() === 'post' ) {
			// Post author
			echo '<p class="post-meta">';
			esc_html_e( 'Par', DOMAIN );
			printf( '<a href="%1$s" rel="author"> %2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
			esc_html_e( 'Le', DOMAIN );
			echo '<span>' . get_the_date() . '</span></p>';
		}
	}
}

/**
 * 4 . NUMBERED PAGINATION
 */

if ( ! function_exists( 'benawp_numbered_pagination' ) ) {
	function benawp_numbered_pagination() {
		$args = array(
			'prev_next' => false,
			'type'      => 'array'
		);

		echo '<div class="col-md-12">';
		$pagination = paginate_links( $args );

		if ( is_array( $pagination ) ){
			echo '<ul class="nav nav-pills">';
			foreach ( $pagination as $page ){
				if ( strpos( $page, 'current' ) ){
					echo '<li class="active"><a href="#"' . $page . '</a></li>';
				} else {
					echo '<li>' . $page . '</li>';
				}
			}
			echo '</ul>';
		}
		echo '</div>';
	}
}