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
					<?php esc_html_e( get_theme_mod( 'jumbotron-front-title', esc_html__( 'Hello, your name is Replace With Yours.', DOMAIN ) ) ); ?>
                </h1>
                <p class="lead">
                    <!--						--><?php //esc_html_e( 'I sell websites and website accessories.', DOMAIN ); ?>
					<?php esc_html_e( get_theme_mod( 'jumbotron-front-subtitle', esc_html__( 'Then tel us about your job.', DOMAIN ) ) ); ?>
                </p>
            </div> <!-- End col -->
        </div> <!-- End row -->
    </div> <!-- End jumbotron -->
</div> <!-- End container-fluid -->