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
					<?php esc_html_e( 'Lorem ipsum dolor sit amet', DOMAIN ); ?>
                </h1>
                <p class="lead">
                    <?php esc_html_e( 'Uisque hendrerit, nunc eu molestie vulputate, leo diam dictum orci.', DOMAIN ); ?>
                </p>
            </div> <!-- End col -->
        </div> <!-- End row -->
    </div> <!-- End jumbotron -->
</div> <!-- End container-fluid -->