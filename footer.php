<?php
/**
 * footer.php
 *
 * The template for loading the footer.
 */
?>

<footer class="container-fluid site-footer">
    <div class="row">
		<?php get_sidebar( 'footer-tel' ); ?>
		<?php get_sidebar( 'footer-mail' ); ?>
    </div> <!-- end row -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
