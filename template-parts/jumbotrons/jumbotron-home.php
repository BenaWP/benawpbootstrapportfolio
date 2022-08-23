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
					<?php esc_html_e( 'My thoughts on and off the web', DOMAIN ); ?>
                </h1>
                <p class="lead">
                    <?php esc_html_e( 'Web-design, development, and parent-teacher conferences.', DOMAIN ); ?>
                </p>
            </div> <!-- End col -->
        </div> <!-- End row -->
    </div> <!-- End jumbotron -->
</div> <!-- End container-fluid -->