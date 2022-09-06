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
    <?php get_template_part( 'template-parts/content/content', 'single' ); ?>
<?php endwhile; ?>

<?php else: ?>
    <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
<?php endif; ?>

<?php
// Load footer.php
get_footer();
?>