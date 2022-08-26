<?php
/**
 * sidebar.php
 *
 * The sidebar template.
 */

if ( is_active_sidebar( 'blog-sidebar' ) ) {
	dynamic_sidebar( 'blog-sidebar' );
}
