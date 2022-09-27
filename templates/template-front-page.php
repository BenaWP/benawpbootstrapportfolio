<?php
/**
 * template-front-page.php
 *
 * Template Name: Homepage
 */
//Load header.php
get_header();
?>
    <!--    Jumbotron -->
    <?php get_template_part( 'template-parts/jumbotron/jumbotron-front' ); ?>

    <!-- Filterable portfolio -->
    <div class="filterable-portfolio container-fluid">
        <!-- row for the filters categories -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills portfolio-filter">
                    <li class="portfolio-title">
						<?php esc_html_e( 'Mes expertises: ', 'benawp-bootstrap-portfolio' ); ?>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#" data-filter="*"><?php esc_html_e( 'Tous', 'benawp-bootstrap-portfolio' ); ?></a>
                    </li>
					<?php
					$benawp_cat_args       = array(
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => 'true',
						'exclude'    => '1'
					);
					$benawp_categories = get_categories( $benawp_cat_args );
					foreach ( $benawp_categories as $benawp_category ) {
						?>
                        <li role="presentation">
                            <a href="#"
                               data-filter=".<?php echo $benawp_category->slug; ?>"><?php echo $benawp_category->name; ?></a>
                        </li>
						<?php
					}
					?>
                </ul> <!-- End nav -->
            </div> <!-- End col -->
        </div> <!-- End row -->

        <!-- row for the thumbnails categories -->
        <div class="portfolio-items row">
			<?php
			$benawp_query_args = array(
				'cat'            => '-1', // No Uncategorized
				'posts_per_page' => '-1', // Show all posts
			);
			$benawp_query     = new WP_Query( $benawp_query_args );

			// Start the Loop
			if ( $benawp_query->have_posts() ) {
				while ( $benawp_query->have_posts() ) {
					$benawp_query->the_post();
					// If this posts has a thumbanail,
					// Then, we have to get the curent categorie for that post
					if ( has_post_thumbnail() ) {
						$benawp_slugs             = '';
						$benawp_currentCategories = get_the_category();

						foreach ( $benawp_currentCategories as $benawp_currentCategory ) {
							$benawp_slugs .= ' ' . $benawp_currentCategory->slug;
						}

						?>
                        <figure class="portfolio-item col-sm-4 item<?php echo $benawp_slugs; ?>">
                            <a
                                    href="<?php the_permalink(); ?>"
                                    title="<?php the_title_attribute(); ?>"
                            >
								<?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?>
                            </a>
                        </figure>
						<?php
					}
				}
			}// End the Loop
			?>
        </div>
    </div> <!-- End filterable-portfolio -->

<?php
//Load footer.php
get_footer();