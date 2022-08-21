<?php
/*
* Template Name: Contact
*/
?>

<?php
$errors  = array();
$isError = false;

$errorName    = __( 'Entrer voter nom s\'il vous plaît.', DOMAIN );
$errorEmail   = __( 'Entrer un addresse e-mail valide s\'il vous plaît.', DOMAIN );
$errorMessage = __( 'Entrer un message s\'il vous plaît.', DOMAIN );

/* Get the posted variables and validate them. */
if ( isset( $_POST['is-submitted'] ) ) {
	$name    = $_POST['cName'];
	$email   = $_POST['cEmail'];
	$message = $_POST['cMessage'];

	/* Check the name. */
	if ( ! benawp_validate_length( $name, 2 ) ) {
		$isError             = true;
		$errors['errorName'] = $errorName;
	}

	/* Check the email. */
	if ( ! is_email( $email ) ) {
		$isError              = true;
		$errors['errorEmail'] = $errorEmail;
	}

	/* Check the message. */
	if ( ! benawp_validate_length( $message, 2 ) ) {
		$isError                = true;
		$errors['errorMessage'] = $errorMessage;
	}

	/* If there's no error, send email. */
	if ( ! $isError ) {
		/* Get admin email. */
		$emailReceiver = get_option( 'admin_email' );

		$emailSubject = sprintf( __( 'Vous avez été contacté par %s', DOMAIN ), $name );
		$emailBody    = sprintf( __( 'Vous avez été contacté par %1$s. Son message est:', DOMAIN ), $name ) . PHP_EOL . PHP_EOL;
		$emailBody    .= $message . PHP_EOL . PHP_EOL;
		$emailBody    .= sprintf( __( 'Vous pouvez contacter %1$s par e-mail ici %2$s', DOMAIN ), $name, $email );
		$emailBody    .= PHP_EOL . PHP_EOL;

		$emailHeaders[] = "Reply-To: $email" . PHP_EOL;

		$emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
	}
}
?>

<?php
/* Load header.php */
get_header();
?>

<!-- Jumbotron -->
<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1><?php esc_html_e( 'Thanks for getting in touch.', DOMAIN ); ?></h1>

                <p class="lead">
					<?php esc_html_e( 'I can\'t wait to hear from you.', DOMAIN ); ?>
                </p>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end jumbotron -->
</div> <!-- end container-fluid -->

<!-- Contact Form -->
<div class="page-contact container-fluid">
    <div class="row">
        <div class="col-md-6">
			<?php if ( isset( $emailIsSent ) && $emailIsSent ) : ?>
                <div class="alert alert-success">
					<?php esc_html_e( 'Your message has been sucessfully sent, thank you!', DOMAIN ); ?>
                </div> <!-- end alert -->
			<?php else : ?>

                <p>
					<?php esc_html_e( 'I\'m glad you\'ve decided to contact me. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla pariatur totam quam, repellendus, molestias id veniam. Aspernatur officiis, ducimus quasi.', DOMAIN ); ?>
                </p>

				<?php if ( isset( $isError ) && $isError ) : ?>
                    <div class="alert alert-danger">
						<?php esc_html_e( 'Sorry, it seems there was an error.', DOMAIN ); ?>
                    </div> <!-- end alert -->
				<?php endif; ?>
			<?php endif; ?>
        </div> <!-- end col -->
    </div> <!-- end row -->

	<?php if ( ! isset( $emailIsSent ) || isset( $isError ) && $isError ) : ?>
        <div class="row">
            <div class="contact-form col-md-6">
                <form role="form" action="<?php the_permalink(); ?>" method="post">
                    <div class="form-group <?php if ( isset( $errors['errorName'] ) ) {
						echo "has-error";
					} ?>">
                        <label for="contact-name"><?php esc_html_e( 'Nom', DOMAIN ); ?></label>
                        <input type="text" class="form-control" id="contact-name" name="cName"
                               placeholder="<?php esc_html_e( 'Entrer votre nom', DOMAIN ); ?>"
                               value="<?php if ( isset( $_POST['cName'] ) ) {
							       esc_html_e( $_POST['cName'] );
						       } ?>">
						<?php if ( isset( $errors['errorName'] ) ) : ?>
                            <p class="help-block"><?php esc_html_e( $errors['errorName'] ); ?></p>
						<?php endif; ?>
                    </div> <!-- end form-group -->
                    <div class="form-group <?php if ( isset( $errors['errorEmail'] ) ) {
						echo "has-error";
					} ?>">
                        <label for="contact-email"><?php esc_html_e( 'Adresse e-mail', DOMAIN ); ?></label>
                        <input type="email" class="form-control" id="contact-email" name="cEmail"
                               placeholder="<?php esc_html_e( 'Entrer votre adresse e-mail', DOMAIN ); ?>"
                               value="<?php if ( isset( $_POST['cEmail'] ) ) {
							       esc_html_e( $_POST['cEmail'] );
						       } ?>">
						<?php if ( isset( $errors['errorEmail'] ) ) : ?>
                            <p class="help-block"><?php esc_html_e( $errors['errorEmail'] ); ?></p>
						<?php endif; ?>
                    </div> <!-- end form-group -->
                    <div class="form-group <?php if ( isset( $errors['errorMessage'] ) ) {
						echo "has-error";
					} ?>">
                        <label for="contact-message"><?php esc_html_e( 'Message', DOMAIN ); ?></label>
                        <textarea class="form-control" rows="3" id="contact-message" name="cMessage"
                                  placeholder="<?php esc_html_e( 'Entrer votre message', DOMAIN ); ?>"><?php if ( isset( $_POST['cMessage'] ) ) {
								esc_html_e( $_POST['cMessage'] );
							} ?></textarea>
						<?php if ( isset( $errors['errorMessage'] ) ) : ?>
                            <p class="help-block"><?php echo $errors['errorMessage']; ?></p>
						<?php endif; ?>
                    </div> <!-- end form-group -->

                    <input type="hidden" name="is-submitted" id="is-submitted" value="true">
                    <button type="submit" class="btn btn-default"><?php esc_html_e( 'Envoyer', DOMAIN ); ?></button>
                </form>
            </div> <!-- end col -->
        </div> <!-- end row -->
	<?php endif; ?>
</div> <!-- end container-fluid -->

<?php
/* Load footer.php */
get_footer();
?>
