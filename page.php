<?php
/**
 * page.php
 * Diplaying a page content, if the user dont use one of our template page
 */
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	the_content();

endwhile; // End of the loop.

get_footer();
