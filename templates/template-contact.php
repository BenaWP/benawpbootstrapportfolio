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
		<!-- Check if WP Forms is installed and active -->
		<?php if ( in_array('wpforms-lite/wpforms.php', apply_filters('active_plugins', get_option('active_plugins'))) ) : ?>
			<!-- On récupère ID du form -->
			<?php 
				$action_scheduler_hybrid_store_demarkation = get_option( 'action_scheduler_hybrid_store_demarkation' );
				$form_infos = get_option( '_transient_wpforms_dash_widget_lite_entries_by_form' );
				$form_title = ( string ) $form_infos[$action_scheduler_hybrid_store_demarkation]['title'];

				if ( strcasecmp( $form_title, 'contact ' ) ) {
					$form_id =  $form_infos[$action_scheduler_hybrid_store_demarkation]['form_id'];
				}else {
					esc_html_e( 'Oups, pas de formulaire.', 'benawp-bootstrap-portfolio' );
					echo '<br>';
					esc_html_e( 'IMPORTANT : Le titre du formulaire de contact doit contenir le mot clé "contact".', 'benawp-bootstrap-portfolio' );
				}
			?>

			<?php echo do_shortcode( '[wpforms id="' . $form_id . '"]' ); ?>

		<?php else: ?>	
			<?php 
				esc_html_e( 'Veuillez installer puis activer le plugin WP Forms, c\'est obligatoire pour cet thème. Merci.', 'benawp-bootstrap-portfolio' );
				echo '<br>';
				esc_html_e( 'IMPORTANT : Le titre du formulaire de contact doit contenir le mot clé "contact".', 'benawp-bootstrap-portfolio' );
			?>
		<?php endif; ?>
	</div>
</div>

<?php
/* Load footer.php */
get_footer();
?>
