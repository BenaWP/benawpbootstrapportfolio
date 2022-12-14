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
const IMAGES = THEME_URI . '/assets/img';
const CSS    = THEME_URI . '/assets/css';
const JS     = THEME_URI . '/assets/js';
const LIBS   = THEME_URI . '/libs';
const BG     = '#424cbf';


/**
 * 2 . SETUP THEME
 */
if ( ! function_exists( 'benawp_theme_setup' ) ) {
	function benawp_theme_setup() {
		// Make the theme available for translation
		$lang_dir = THEME_ROOT . '/languages';
		load_theme_textdomain( 'benawp-bootstrap-portfolio', $lang_dir );

		// Enables plugins and themes to manage the document title tag.
		add_theme_support( "title-tag" );

		// Add support for automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// custom logo in your theme	
		add_theme_support( 'custom-logo' );

		// Add support for post thumbanails
		add_theme_support( 'post-thumbnails' );

		// Implementing Selective Refresh Support for Widgets
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Theme support recommended by WordPress Theme checker
		add_theme_support( "wp-block-styles" );
		add_theme_support( "responsive-embeds" );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'custom-header' );
		add_theme_support( "custom-background" );
		add_theme_support( 'align-wide' );

		// Register nav menus
		register_nav_menus(
			array(
				'main-menu' => __( 'Menu Principal', 'benawp-bootstrap-portfolio' )
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

		$new_read_more = '... <br><br> <a href="' . get_permalink( $post ) . '" class="more-link">' . esc_html__( 'Continuez à lire', 'benawp-bootstrap-portfolio' ) . '</a>';

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
			echo '<i class="fa-solid fa-pen-to-square"></i>';
			printf( '<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
			echo '</span>'; // <!-- post-author >

			// Post date
			echo '<span class="post-date">';
			echo '<i class="fa-sharp fa-solid fa-calendar-days"></i>';
			echo '<span>' . get_the_date() . '</span>';
			echo '</span>';    // <!-- end post-date >

			// Post comments
			echo '<span class="comment">';
			echo '<a href="#comments">';
			echo '<i class="fa fa-comment"></i>';
			echo comments_number();
			echo '</a></span>';

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
			// Main sidebar 
			register_sidebar( array(
				'name'          => esc_html__( 'Bare latérale de la page Blog', 'benawp-bootstrap-portfolio' ),
				'id'            => 'blog-sidebar',
				'description'   => esc_html__( 'Apparaît dans les pages du blog', 'benawp-bootstrap-portfolio' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div> <!-- end widget -->',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>'
			) );

			// Footer infos
			register_sidebar( array(
				'name'          => esc_html__( 'Footer | Numéro de téléphone', 'benawp-bootstrap-portfolio' ),
				'id'            => 'footer-wiget-tel',
				'description'   => esc_html__( 'Entrer votre numéro de téléphone', 'benawp-bootstrap-portfolio' ),
				'before_widget' => '<p><i class="fa-brands fa-whatsapp"></i><span class="phone-number">',
				'after_widget'  => '</span></p>'
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Footer | Adresse e-mail', 'benawp-bootstrap-portfolio' ),
				'id'            => 'footer-wiget-mail',
				'description'   => esc_html__( 'Entrer votre adresss électronique', 'benawp-bootstrap-portfolio' ),
				'before_widget' => '<p><i class="fa-regular fa-envelope"></i><span class="email-address">',
				'after_widget'  => '</span></p>'
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
		wp_register_script( 'bootstrap-js', LIBS . '/bower_components/bootstrap/dist/js/bootstrap.js', [ 'jquery' ], false, true );
		wp_register_script( 'isotope-js', LIBS . '/bower_components/isotope/dist/isotope.pkgd.min.js', false, false, true );
		wp_register_script( 'plugins-js', JS . '/plugins.js', false, false, true );
		wp_register_script( 'main-js', JS . '/main.js', false, false, true );

		// Load the custom scripts
		wp_enqueue_script( 'modernizr-js' );
		wp_enqueue_script( 'bootstrap-js' );
		wp_enqueue_script( 'isotope-js' );
		wp_enqueue_script( 'plugins-js' );
		wp_enqueue_script( 'main-js' );
        // The comment-reply script
		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Load the stylesheets
		wp_enqueue_style( 'fontawesome-css', LIBS . '/fontawesome/css/all.min.css', false, '6.2.0' );
		wp_enqueue_style( 'bootstrap-css', LIBS . '/bower_components/bootstrap/dist/css/bootstrap.css' );
		wp_enqueue_style( 'style-css', CSS . '/style.css' );
	}

	add_action( 'wp_enqueue_scripts', 'benawp_scripts' );
}

/**
 * 7. Widgets
 */
require_once THEME_ROOT . '/classes/class-benawp-recent-projects.php';
require_once THEME_ROOT . '/classes/class-benawp-phone-number.php';
require_once THEME_ROOT . '/classes/class-benawp-mail.php';

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
 * Registers options with the Theme Customizer
 *
 * @param object $wp_customize The Customize API object
 */
if ( ! function_exists( 'benawp_customize_register' ) ) {

	function benawp_customize_register( $wp_customize ) {

		// BG color
		$wp_customize->add_section( 'bg-color', array(
			'title'       => esc_html__( 'Couleur de fond', 'benawp-bootstrap-portfolio' ),
			'description' => esc_html__( 'Choisir une couleur pour le fond du site.', 'benawp-bootstrap-portfolio' ),
			'priority'    => 50,
		) );
		$wp_customize->add_setting( 'body-bg', array(
			'default'           => BG,
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_html',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'body-background-color',
			array(
				'label'    => esc_html__( 'Choisir une couleur', 'benawp-bootstrap-portfolio' ),
				'section'  => 'bg-color',
				'settings' => 'body-bg'
			)
		) );

		// Jumbotron Front
		$wp_customize->add_section( 'jumbotron', array(
			'title'       => esc_html__( 'Bannière de la page d\'accueil', 'benawp-bootstrap-portfolio' ),
			'description' => esc_html__( 'Vous êtes qui ? Et dites nous ce que vous faites.', 'benawp-bootstrap-portfolio' ),
			'priority'    => 100,
		) );
		$wp_customize->add_setting( 'jumbotron-front-title', array(
			'default'           => esc_html__( 'Hello, mon nom est Remplacer par le votre.', 'benawp-bootstrap-portfolio' ),
			'transport'         => 'refresh',
			'sanitize_callback' => 'benawp_sanitize_input',
		) );
		$wp_customize->add_setting( 'jumbotron-front-subtitle', array(
			'default'           => esc_html__( 'Ensuite, parler nous de ce que vous faites.', 'benawp-bootstrap-portfolio' ),
			'transport'         => 'refresh',
			'sanitize_callback' => 'benawp_sanitize_input',
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'jumbotron-title-customization',
			array(
				'label'    => esc_html__( 'Titre', 'benawp-bootstrap-portfolio' ),
				'section'  => 'jumbotron',
				'settings' => 'jumbotron-front-title'
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'jumbotron-subtitle-customization',
			array(
				'label'    => esc_html__( 'Sous titre', 'benawp-bootstrap-portfolio' ),
				'section'  => 'jumbotron',
				'settings' => 'jumbotron-front-subtitle'
			)
		) );
	}

	add_action( 'customize_register', 'benawp_customize_register' );
}

/**
 * Sanitizing the input data from the jumbotron on front page
 * Sanitization callback
 * @param $text
 *
 * @return string
 */
function benawp_sanitize_input ( $text ) {
    return sanitize_text_field( $text );
}

/**
 * The function called whe we change the bacgroud color
 * Hooked in wp_head to applying the style
 */
if ( ! function_exists( 'benawp_bg_color_customize_css' ) ) {
	function benawp_bg_color_customize_css() {
		?>
        <style>
            html {
                background-color: <?php echo esc_html( get_theme_mod( 'body-bg', BG ) ); ?>;
            }
        </style>
		<?php
	}

	add_action( 'wp_head', 'benawp_bg_color_customize_css' );
}

/**
 * 10. Register Required Plugins
 */

/**
 * 10.a.Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php';
add_action( 'benawp_tgmpa_register', 'benawp_register_required_plugins' );

function benawp_register_required_plugins() {

	$plugins = array(
		array(
			'name'               => 'Contact Form by WPForms – Drag & Drop Form Builder for WordPress',
			// The plugin name on wordpress.org.
			'slug'               => 'wpforms-lite',
			// Plugin slug on wordpress.org
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required.
			'version'            => '',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL.
			'is_callable'        => '',
			// If set, this callable will be checked for availability to determine if a plugin is active.

		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'           => 'benawp-bootstrap-portfolio',
		// Text domain - likely want to be the same as your theme.
		'default_path'     => '',
		// Default absolute path to pre-packaged plugins
		'menu'             => 'install-required-plugins',
		// Menu slug
		'parent_slug' => 'themes.php',
		// Parent menu slug.
		'capability'   => 'edit_theme_options',
		// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'      => true,
		// Show admin notices or not
		'dismissable'      => false,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'      => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'     => false,
		// Automatically activate plugins after installation or not
		'message'          => '',
		// Message to output right before the plugins table
		'strings'          => array(
			'page_title'                      => __( 'Installer les plugins requis', 'benawp-bootstrap-portfolio' ),
			'menu_title'                      => __( 'Installer les plugins', 'benawp-bootstrap-portfolio' ),
			'installing'                      => __( 'Installation du plugin: %s', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name
			'oops'                            => __( 'Quelque chose s\'est mal passé avec l\'API du plugin.', 'benawp-bootstrap-portfolio' ),
			'notice_can_install_required'     => _n_noop( 'Ce thème exige le plugin suivant: %1$s.', 'Ce thème exige les plugin suivants: %1$s.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop( 'La page de contact de ce thème aura besoin du plugin suivant: %1$s.', 'Ce thème sera beaucoup plus mieux avec les plugin suivants: %1$s.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop( 'Désolé, mais vous n\'avez pas les autorisations nécessaires pour installer le plugin %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin d\'installer le plugin.', 'Désolé, mais vous ne disposez pas des autorisations nécessaires pour installer les plugins %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin d\'installer les plugins.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop( 'Le plugin requis suivant est actuellement inactif : %1$s.', 'Les plugins requis suivants sont actuellement inactifs : %1$s.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop( 'Le plugin recommandé suivant est actuellement inactif: %1$s.', 'Les plugins recommandé suivant est actuellement inactif: %1$s.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop( 'Désolé, mais vous n\'avez pas les autorisations nécessaires pour activer le plugin %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin d\'activer le plugin.', 'Désolé, mais vous ne disposez pas des autorisations nécessaires pour activer les plugins %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin d\'activer les plugins.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop( 'Le plugin suivant doit être mis à jour à sa dernière version pour assurer une compatibilité maximale avec ce thème : %1$s.', 'Les plugins suivants doivent être mis à jour à leur dernière version pour assurer une compatibilité maximale avec ce thème : %1$s.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop( 'Désolé, mais vous ne disposez pas des autorisations nécessaires pour mettre à jour le plugin %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin de mettre à jour le plugin.', 'Désolé, mais vous ne disposez pas des autorisations nécessaires pour mettre à jour les plugins %s. Contactez l\'administrateur de ce site pour obtenir de l\'aide afin de mettre à jour les plugins.', 'benawp-bootstrap-portfolio' ),
			// %1$s = plugin name(s)
			'install_link'                    => _n_noop( 'Commencez à installer le plugin', 'Commencez à installer les plugins', 'benawp-bootstrap-portfolio' ),
			'activate_link'                   => _n_noop( 'Activez le plugin installé', 'Activer les plugins installés', 'benawp-bootstrap-portfolio' ),
			'return'                          => __( 'Retour à l\'installation des plugins requis', 'benawp-bootstrap-portfolio' ),
			'plugin_activated'                => __( 'Le plugin a été activé avec succès.', 'benawp-bootstrap-portfolio' ),
			'complete'                        => __( 'Tous les plugins sont installés et activés avec succès. %s', 'benawp-bootstrap-portfolio' ),
			// %1$s = dashboard link
			'nag_type'                        => 'notice-warning'
			// Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	benawp_tgmpa( $plugins, $config );

}

/**
 * 11.
 * When Submiting theme
 * Register block style
 */
/*if ( function_exists( 'register_block_style' ) ) {
	register_block_style(
		'core/quote',
		array(
			'name'         => 'blue-quote',
			'label'        => __( 'Blue Quote', 'benawp-bootstrap-portfolio' ),
			'is_default'   => true,
			'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
		)
	);
}*/

/**
 * 12.
 * When Submiting theme
 * Register block pattern
 */
/*if ( function_exists( 'register_block_style' ) ) {
	register_block_pattern(
		'wpdocs-my-plugin/my-awesome-pattern',
		array(
			'title'       => __( 'Deux boutons', 'benawp-bootstrap-portfolio' ),
			'description' => _x( 'Deux boutons horizontaux, le bouton de gauche est rempli et le bouton de droite est souligné.', 'Block pattern description', 'benawp-bootstrap-portfolio' ),
			'content'     => "<!-- wp:buttons {\"align\":\"center\"} -->\n<div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"backgroundColor\":\"very-dark-gray\",\"borderRadius\":0} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background has-very-dark-gray-background-color no-border-radius\">" . esc_html__( 'Bouton 1', 'benawp-bootstrap-portfolio' ) . "</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"textColor\":\"very-dark-gray\",\"borderRadius\":0,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color has-very-dark-gray-color no-border-radius\">" . esc_html__( 'Bouton 2', 'benawp-bootstrap-portfolio' ) . "</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->",
		)
	);
}*/

/**
 * 13.
 * Registers an editor stylesheet for the theme.
 */
function benawp_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'benawp_add_editor_styles' );

