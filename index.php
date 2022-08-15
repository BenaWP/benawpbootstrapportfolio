<?php
/**
 * index.php
 *
 * The main template file.
 */

/**
 * Load header.php
 */
get_header();
?>
    <div class="container-fluid text-center">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>
						<?php esc_html_e( 'My thoughts on and off the web.', DOMAIN ); ?>
                    </h1>
                    <p class="lead">
						<?php esc_html_e( 'Web-design, development, and parent-teacher conferences.', DOMAIN ); ?>
                    </p>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end jumbotron -->
    </div> <!-- end container-fluid -->

    <div class="page-blog container-fluid">
        <div class="row">
            <aside class="sidebar col-md-3 col-md-offset-1 col-md-push-8">
                Sidebar here
            </aside>
            <div class="posts col-md-8 col-md-pull-4">
                <div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
						<?php get_template_part( 'partials/content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php else: ?>
						<?php get_template_part( 'partials/content', 'none' ); ?>
					<?php endif; ?>
                    <?php
                        // Load numbered pagination
                        benawp_numbered_pagination();
                    ?>
                </div> <!-- end row -->
            </div> <!-- end posts -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

<?php
// Load footer.php
get_footer();
?>