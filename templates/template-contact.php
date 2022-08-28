<?php
/**
 * template-contact.php
 *
 * Template Name: Contact Page
 */
?>

<?php
/* Load header.php */
get_header();
?>

<!-- Jumbotron -->
<?php get_template_part( 'template-parts/jumbotron/jumbotron-contact' ); ?>

<!-- Contact Form -->
<?php echo do_shortcode( '[wpforms id="222" title="false"]' ); ?>

<?php
/* Load footer.php */
get_footer();
?>
