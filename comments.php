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

        </div><!-- .comments-inner -->

    </div><!-- comments -->

	<?php
	if ( comments_open() ) :

		//Declare Vars
		$comment_send     = 'Send';
		$comment_reply    = 'Leave a Message';
		$comment_reply_to = 'Reply';
		$comment_author   = 'Name';
		$comment_email    = 'E-Mail';
		$comment_body     = 'Comment';
		$comment_url      = 'Website';
		$comment_cookies  = ' Save my name, email, and website in this browser for the next time I comment.';
		$comment_before   = 'Your email address will not be published. Required fields are marked *';
		$comment_cancel   = 'Cancel Reply';

		// Array comments_args
		$comments_args = array(
			// Define Fields
			'fields'               => array(
				//Author field
				'author'  => '<p class="comment-form-author"><label for="author">' . _x( 'Name *', 'benawpbootstrapportfolio' ) . '</label><br /><input id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></p>',
				// Email Field
				'email'   => '<p class="comment-form-email"><label for="email">' . _x( 'E-Mail', 'benawpbootstrapportfolio' ) . '</label><br /><input id="email" name="email" placeholder="' . $comment_email . '"></input></p>',
				// URL Field
				'url'     => '<p class="comment-form-url"><label for="url">' . _x( 'Website', 'benawpbootstrapportfolio' ) . '</label><br /><input id="url" name="url" placeholder="' . $comment_url . '"></input></p>',
				//Cookies
				'cookies' => '<input type="checkbox" required>' . $comment_cookies . '<a href="' . get_privacy_policy_url() . '"></a>',
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
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment *', 'benawpbootstrapportfolio' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true" placeholder="' . $comment_body . '"></textarea></p>',
			//Message Before Comment
			'comment_notes_before' => __( $comment_before ),
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after'  => '',
			//Submit Button ID
			'id_submit'            => __( 'comment-submit' ),
		);

		comment_form( $comments_args );

	endif;

	?>

</div> <!-- comments-wrapper -->
