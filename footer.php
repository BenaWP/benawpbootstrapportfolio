<?php
/**
 * footer.php
 *
 * The template for loading the footer.
 */
?>

<footer class="container-fluid site-footer">
    <div class="row">
        <div class="col-md-12 contact-infos">
			<?php if ( is_active_sidebar( 'footer-wiget-tel' ) ) : ?><?php dynamic_sidebar( 'footer-wiget-tel' ); ?><?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-wiget-mail' ) ) : ?><?php dynamic_sidebar( 'footer-wiget-mail' ); ?><?php endif; ?>
        </div>
    </div> <!-- end row -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
