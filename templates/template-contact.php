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
		<?php if ( in_array( 'wpforms-lite/wpforms.php', apply_filters( 'benawp_active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
            <!-- On récupère ID du form -->
			<?php
			$benawp_wpforms_args = array(
				'post_type'   => 'wpforms',
				'post_status' => 'publish'
			);

			$benawp_query = new WP_Query( $benawp_wpforms_args );

			$benawp_form_titles = array(); // Array of title who conatains a "contact" word

			if ( $benawp_query->have_posts() ) {
				while ( $benawp_query->have_posts() ) {
					$benawp_query->the_post();

					$benawp_form_title = get_the_title();

					if ( stristr( $benawp_form_title, 'contact' ) ) {
						array_push( $benawp_form_titles, $benawp_form_title );
						$benawp_form_id = get_the_ID();
					}

				}

				// We have many form which name "contact"
				if ( count( $benawp_form_titles ) > 1 ) {
					esc_html_e( 'IMPORTANT : Il semble que vous avez plusieurs formulaire dont le nom contient le mot "contact".', 'benawp-bootstrap-portfolio' );
					echo '<br>';
					esc_html_e( 'Mettez "contact" seulement pour le nom du formulaire de contact que vous voulez affichez ici. Merci', 'benawp-bootstrap-portfolio' );
				}

				// Print the good contact form with the ID
				if ( count( $benawp_form_titles ) < 2 ) {
					echo do_shortcode( '[wpforms id="' . $benawp_form_id . '"]' );
				}

				// No forms contain "contact" title
				if ( empty( $benawp_form_titles ) ) {
					esc_html_e( 'Oups, pas de formulaire.', 'benawp-bootstrap-portfolio' );
					echo '<br>';
					esc_html_e( 'Veuillez créer un svp.', 'benawp-bootstrap-portfolio' );
					echo '<br>';
					esc_html_e( 'IMPORTANT : Le titre du formulaire de contact doit contenir le mot clé "contact".', 'benawp-bootstrap-portfolio' );
				}

			}

			wp_reset_postdata();

			?>

		<?php else: ?>
			<?php
			echo sprintf( __( 'Veuillez installer puis activer le plugin <a class="wp-form-link" target="_blank" href= "%s"><b>WP Forms</b></a>, c\'est obligatoire pour ce thème. Merci.', 'benawp-bootstrap-portfolio' ), 'https://wpforms.com/' );
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
