<?php
/**
 * jumbotron.php
 * Template for dispaying the jumbotron
 */
?>
<!-- Jumbotron -->
<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>
                    <!--						--><?php //esc_html_e( 'Hello, my name is Cory Simmons.', DOMAIN ); ?>
					<?php esc_html_e( get_theme_mod( 'jumbotron-home-title', esc_html__( 'Hello, my name is Yvon Aulien Benahita.', DOMAIN ) ) ); ?>
                </h1>
                <p class="lead">
                    <!--						--><?php //esc_html_e( 'I sell websites and website accessories.', DOMAIN ); ?>
					<?php esc_html_e( get_theme_mod( 'jumbotron-home-subtitle', esc_html__( 'I\'m a WordPress Expert Developer.', DOMAIN ) ) ); ?>
                </p>
            </div> <!-- End col -->
        </div> <!-- End row -->
    </div> <!-- End jumbotron -->
</div> <!-- End container-fluid -->