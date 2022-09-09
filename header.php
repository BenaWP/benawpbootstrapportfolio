<?php
/**
 * header.php
 *
 * The theme header.
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Apple Touch Icon -->
	<?php
	$touchicon = IMAGES . '/icons/apple-touch-icon-precomposed.png';
	?>

    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_attr( $touchicon ); ?>" sizes="152x152">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> >

<?php wp_body_open(); ?>

<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->


<nav class="navbar" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'benawp-bootstrap-portfolio' ); ?> </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Logo -->
			<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			?>
			<?php if ( has_custom_logo() ) : ?>
                <a class="navbar-brand" href="<?php esc_attr_e( esc_url( home_url( '/' ) ) ); ?>">
					<?php echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">'; ?>
                </a>
			<?php else : ?>
                <a class="navbar-brand has-not-custom-log" href="<?php esc_attr_e( esc_url( home_url( '/' ) ) ); ?>">
                    <span class="bloginfo"><?php bloginfo( 'name' ); ?></span>
                    <span class="tagline"><?php bloginfo( 'description' ); ?></span>
                </a>
			<?php endif; ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<?php
			wp_nav_menu(
				array(
					'menu_class'     => 'nav navbar-nav navbar-right',
					'theme_location' => 'main-menu',
					'container'      => false
				)
			);
			?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>