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
<div id="contact-form-wprap" class="contact-form-wrap container-fluid">
	<div class="row">
		<?php echo do_shortcode( '[wpforms id="222" title="false"]' ); ?>
	</div>
</div>

<?php
/* Load footer.php */
get_footer();
?>
