<?php
/**
 * home.php
 * Template for listing our blog lists
 */
get_header();
?>
    <!--    Jumbotron-->
    <?php get_template_part( 'template-parts/jumbotron/jumbotron-home' ); ?>

    <div class="page-blog container-fluid">
        <div class="row">
            <aside class="sidebar col-md-3 col-md-offset-1 col-md-push-8">
				<?php get_sidebar(); ?> <!-- Load sidebar.php -->
            </aside>
            <div class="posts col-md-8 col-md-pull-4">
                <div class="row">
					<?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
						<?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php else: ?>
						<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
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
get_footer();
