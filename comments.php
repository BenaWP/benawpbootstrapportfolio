<?php
/**
 * comments.php
 * template for displaying a comment form
 */
?>

<div class="comments-wrapper">

    <div class="comments" id="comments">

        <div class="comments-inner">

			<?php
			$args = array(
				"avatar_size" => 60,
				"style"       => "div"
			);
			wp_list_comments( $args );
			?>

            <?php

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Commentaires plus récents', 'benawpbootstrapportfolio' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Commentaires plus anciens', 'benawpbootstrapportfolio' ),
				)
			);

            if ( $comment_pagination ) {
	            $pagination_classes = '';

	            // If we're only showing the "Next" link, add a class indicating so.
	            if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
		            $pagination_classes = ' only-next';
	            }
	            ?>

                <nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>" aria-label="<?php esc_attr_e( 'Commentaires', 'benawpbootstrapportfolio' ); ?>">
		            <?php echo wp_kses_post( $comment_pagination ); ?>
                </nav>
            <?php
            }

            ?>

        </div><!-- .comments-inner -->

    </div><!-- comments -->

	<?php
	if ( comments_open() ) :

		//Declare Vars
		$comment_send     = esc_html__( 'Envoyer', 'benawpbootstrapportfolio' );
		$comment_reply    = '<i class="fa fa-comment"></i>' . esc_html__( ' Commenter', 'benawpbootstrapportfolio' );
		$comment_reply_to = esc_html__( 'Répondre', 'benawpbootstrapportfolio' );
		$comment_author   = esc_html__( 'Votre Nom', 'benawpbootstrapportfolio' );
		$comment_email    = esc_html__( 'Votre E-Mail', 'benawpbootstrapportfolio' );
		$comment_body     = esc_html__( 'Votre commentaire', 'benawpbootstrapportfolio' );
		$comment_url      = esc_html__( 'Votre Site Web', 'benawpbootstrapportfolio' );
		$comment_cookies  = esc_html__( ' Enregistrez mon nom, mon adresse électronique et mon site Web dans ce navigateur pour la prochaine fois que je commenterai.', 'benawpbootstrapportfolio' );
		$comment_before   = esc_html__( 'Votre adresse électronique ne sera pas publiée. Les champs obligatoires sont marqués d\'un *', 'benawpbootstrapportfolio' );
		$comment_cancel   = esc_html__( 'Annuler la réponse', 'benawpbootstrapportfolio' );

		// Array comments_args
		$comments_args = array(
			// Define Fields
			'fields'               => array(
				//Author field
				'author'  => '<p class="comment-form-author"><label for="author">' . _x( 'Nom *', 'benawpbootstrapportfolio' ) . '</label><br /><input class="form-control" id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></p>',
				// Email Field
				'email'   => '<p class="comment-form-email"><label for="email">' . _x( 'E-Mail', 'benawpbootstrapportfolio' ) . '</label><br /><input class="form-control" id="email" name="email" placeholder="' . $comment_email . '"></input></p>',
				// URL Field
				'url'     => '<p class="comment-form-url"><label for="url">' . _x( 'Site Web', 'benawpbootstrapportfolio' ) . '</label><br /><input class="form-control" id="url" name="url" placeholder="' . $comment_url . '"></input></p>',
				//Cookies
				'cookies' => '<p><input type="checkbox" required>' . $comment_cookies . '</p>',
			),
			// Form container class
			'class_container'      => 'comment-form-wrap',
			// Change the title of send button
			'label_submit'         => __( $comment_send ),
			// Change the title of the reply section
			'title_reply'          => __( $comment_reply ),
			// Change the title of the reply section
			'title_reply_to'       => __( $comment_reply_to ),
			//Cancel Reply Text
			'cancel_reply_link'    => __( $comment_cancel ),
			// Redefine your own textarea (the comment body).
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Commentaire *', 'benawpbootstrapportfolio' ) . '</label><br /><textarea class="form-control" id="comment" name="comment" aria-required="true" placeholder="' . $comment_body . '" rows="4"></textarea></p>',
			//Message Before Comment
			'comment_notes_before' => '<p class="comment-before">' . __( $comment_before ) . '</p>',
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after'  => '',
			//Submit Button ID
			'id_submit'            => __( 'comment-submit' ),
			'class_submit'         => __( 'btn btn-default' )
		);

		comment_form( $comments_args );

	endif;

	?>

</div> <!-- comments-wrapper -->
