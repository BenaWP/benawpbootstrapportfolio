<?php
/**
 * footer.php
 *
 * The template for loading the footer.
 */
?>

<footer class="container-fluid site-footer">
    <div class="row">
      <div class="col-md-12">
        <p>	<?php get_sidebar( 'footer-tel' ); ?> </p>
        <p> <?php get_sidebar( 'footer-mail' ); ?> </p>
      </div>
    </div> <!-- end row -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
