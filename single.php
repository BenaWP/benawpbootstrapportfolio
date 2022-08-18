<?php
/**
 * single.php
 *
 * The single post template file.
 */

/**
 * Load header.php
 */
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'partials/single', 'post' ); ?>
<?php endwhile; ?>

<?php else: ?>
    <?php esc_html_e( 'Oups, il semble qu\'il n\'y ait rien ici' , DOMAIN ); ?>
<?php endif; ?>

<?php
// Load footer.php
get_footer();
?>