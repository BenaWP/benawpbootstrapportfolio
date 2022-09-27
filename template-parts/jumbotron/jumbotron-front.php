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
					<?php echo esc_html( get_theme_mod( 'jumbotron-front-title', esc_html__( 'Hello, mon nom est remplacer par le votre.', 'benawp-bootstrap-portfolio' ) ) ); ?>
                </h1>
                <p class="lead">
					<?php echo esc_html( get_theme_mod( 'jumbotron-front-subtitle', esc_html__( 'Ensuite dis nous ce que vous faites.', 'benawp-bootstrap-portfolio' ) ) ); ?>
                </p>
            </div> <!-- End col -->
        </div> <!-- End row -->
    </div> <!-- End jumbotron -->
</div> <!-- End container-fluid -->