<?php
get_header();
echo '<h1> Page.php </h1>';

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	the_content();

endwhile; // End of the loop.

get_footer();
