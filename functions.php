<?php

/**
 * functions.php
 * The theme's functions.php
 */

/**
 * 1 . CONSTANTS
 */
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'THEME_ROOT', get_template_directory() );
const IMAGES     = THEME_URI . '/assets/img';
const CSS        = THEME_URI . '/assets/css';
const JS         = THEME_URI . '/assets/js';
const COMPONENTS = THEME_URI . '/components';
const DOMAIN     = 'benawpbootstrapportfolio';
const BG         = '#222222';


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
 * REPLACE THE DEFAULT READ MORE LINK By WP
 */
if ( ! function_exists( 'benawp_new_excerpt_more' ) ) {
	function benawp_new_excerpt_more( $more ) {
		global $post;

		$new_read_more = '...<a href="' . get_permalink( $post ) . '" class="more-link">' . esc_html__( ' Continuez à lire', DOMAIN ) . '</a>';

		return $new_read_more;
	}

	add_filter( 'excerpt_more', 'benawp_new_excerpt_more', 10, 1 );
}

/**
 * 3 . GET POST META
 */
if ( ! function_exists( 'benawp_post_meta' ) ) {
	function benawp_post_meta() {
		if ( get_post_type() === 'post' ) {
			echo '<p class="post-meta">';
			// Post author
			echo '<span class="post-author">';
			echo '<i class="fa-solid fa-user"></i>';
			printf( '<a href="%1$s" rel="author"> %2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
			echo '</span>'; // <!-- post-author >

			// Post date
			echo '<span class="post-date">';
			echo '<i class="fa-solid fa-calendar"></i>';
			echo '<span>' . get_the_date() . '</span>';
			echo '</span>';    // <!-- end post-date >
			echo '</p>'; // <!-- end post-meta >
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

		if ( is_array( $pagination ) ) {
			echo '<ul class="nav nav-pills">';
			foreach ( $pagination as $page ) {
				if ( strpos( $page, 'current' ) ) {
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

/**
 * 5. REGISTER WIDGET AREAS
 */
if ( ! function_exists( 'benawp_widget_init' ) ) {
	function benawp_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar( array(
				'name'          => __( 'Bare latérale de la page d\'accueil', DOMAIN ),
				'id'            => 'main-sidebar',
				'description'   => __( 'Apparaît dans les pages du blog', DOMAIN ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div> <!-- end widget -->',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>'
			) );
		}
	}

	add_action( 'widgets_init', 'benawp_widget_init' );
}

/**
 * 6. SCRIPTS
 */
if ( ! function_exists( 'benawp_scripts' ) ) {
	function benawp_scripts() {
		// Register scripts
		wp_register_script( 'modernizr-js', JS . '/vendor/modernizr-2.6.2.min.js', false, false, false );
		wp_register_script( 'bootstrap-js', COMPONENTS . '/bower_components/bootstrap/dist/js/bootstrap.js', [ 'jquery' ], false, true );
		wp_register_script( 'isotope-js', COMPONENTS . '/bower_components/isotope/dist/isotope.pkgd.min.js', false, false, true );
		wp_register_script( 'plugins-js', JS . '/plugins.js', false, false, true );
		wp_register_script( 'main-js', JS . '/main.js', false, false, true );

		// Load the custom scripts
		wp_enqueue_script( 'modernizr-js' );
		wp_enqueue_script( 'bootstrap-js' );
		wp_enqueue_script( 'isotope-js' );
		wp_enqueue_script( 'plugins-js' );
		wp_enqueue_script( 'main-js' );

		// Load the stylesheets
		wp_enqueue_style( 'fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css' );
		wp_enqueue_style( 'bootstrap-css', COMPONENTS . '/bower_components/bootstrap/dist/css/bootstrap.css' );
		wp_enqueue_style( 'style-css', CSS . '/style.css' );
	}

	add_action( 'wp_enqueue_scripts', 'benawp_scripts' );
}

/**
 * 7. Widgets
 */
require_once THEME_ROOT . '/inc/widgets/benawp-recent-projects.php';

/**
 * 8. Validate forms
 * Vaidate field length
 */
if ( ! function_exists( 'benawp_validate_length' ) ) {
	function benawp_validate_length( $fieldValue, $minLength ) {
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}


/**
 * 9. Customizer API
 * Customizing the site backgrund-color
 *
 * @param object $wp_customize The Customize API object
 */
if ( ! function_exists( 'benawp_customize_register' ) ) {

	function benawp_customize_register( $wp_customize ) {

		// BG color
		$wp_customize->add_section( 'bg-color', array(
			'title'       => esc_html__( 'Couleur de fond', DOMAIN ),
			'description' => esc_html__( 'Choisir une couleur pour le fond', DOMAIN ),
			'priority'    => 50,
		) );
		$wp_customize->add_setting( 'body-bg', array(
			'default'   => BG,
			'transport' => 'refresh'
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'body-background-color',
			array(
				'label'    => esc_html__( 'Choisir une couleur', DOMAIN ),
				'section'  => 'bg-color',
				'settings' => 'body-bg'
			)
		) );

		// Jumbotron Front
		$wp_customize->add_section( 'jumbotron', array(
			'title'       => esc_html__( 'Bannière de la page d\'accueil', DOMAIN ),
			'description' => esc_html__( 'Personnalisez les textes', DOMAIN ),
			'priority'    => 100,
		) );
		$wp_customize->add_setting( 'jumbotron-front-title', array(
			'default'   => esc_html__( 'Hello, your name is Replace With Yours.', DOMAIN ),
			'transport' => 'refresh'
		) );
		$wp_customize->add_setting( 'jumbotron-front-subtitle', array(
			'default'   => esc_html__( 'Then tel us about your job.', DOMAIN ),
			'transport' => 'refresh'
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'jumbotron-title-customization',
			array(
				'label'    => esc_html__( 'Titre', DOMAIN ),
				'section'  => 'jumbotron',
				'settings' => 'jumbotron-front-title'
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'jumbotron-subtitle-customization',
			array(
				'label'    => esc_html__( 'Sous titre', DOMAIN ),
				'section'  => 'jumbotron',
				'settings' => 'jumbotron-front-subtitle'
			)
		) );
	}

	add_action( 'customize_register', 'benawp_customize_register' );
}

/**
 * The function called whe we change the bacgroud color
 * Hooked in wp_head to applying the style
 */
if ( ! function_exists( 'benawp_bg_color_customize_css' ) ) {
	function benawp_bg_color_customize_css() {
		?>
        <style>
            html{
                background-color: <?php esc_html_e( get_theme_mod( 'body-bg', BG ) ); ?>;
            }
        </style>
		<?php
	}

	add_action( 'wp_head', 'benawp_bg_color_customize_css' );
}
