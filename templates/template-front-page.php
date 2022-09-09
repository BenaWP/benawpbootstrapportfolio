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
						<?php esc_html_e( 'Mes projets: ', 'benawp-bootstrap-portfolio' ); ?>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#" data-filter="*"><?php esc_html_e( 'Tous', 'benawp-bootstrap-portfolio' ); ?></a>
                    </li>
					<?php
					$args       = array(
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => 'true',
						'exclude'    => '1'
					);
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						?>
                        <li role="presentation">
                            <a href="#"
                               data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
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
			$queryArgs = array(
				'cat'            => '-1', // No Uncategorized
				'posts_per_page' => '-1', // Show all posts
			);
			$query     = new WP_Query( $queryArgs );

			// Start the Loop
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					// If this posts has a thumbanail,
					// Then, we have to get the curent categorie for that post
					if ( has_post_thumbnail() ) {
						$slugs             = '';
						$currentCategories = get_the_category();

						foreach ( $currentCategories as $currentCategory ) {
							$slugs .= ' ' . $currentCategory->slug;
						}

						?>
                        <figure class="portfolio-item col-sm-4 item<?php echo $slugs; ?>">
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