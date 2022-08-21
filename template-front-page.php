<?php
/**
 * template-front-page.php
 *
 * Template Name: Homepage
 */
//Load header.php
get_header();
?>

    <!-- Jumbotron -->
    <div class="container-fluid text-center">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>
						<?php esc_html_e( 'Hello, my name is Cory Simmons.', DOMAIN ); ?>
                    </h1>
                    <p class="lead">
						<?php esc_html_e( 'I sell websites and website accessories.', DOMAIN ); ?>
                    </p>
                </div> <!-- End col -->
            </div> <!-- End row -->
        </div> <!-- End jumbotron -->
    </div> <!-- End container-fluid -->

    <!-- Filterable portfolio -->
    <div class="filterable-portfolio container-fluid">
        <!-- row for the filters categories -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills portfolio-filter">
                    <li class="portfolio-title">
						<?php esc_html_e( 'Filtres: ', DOMAIN ); ?>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#" data-filter="*"><?php esc_html_e( 'Tous', DOMAIN ); ?></a>
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
                               data-filter="<?php esc_html_e( $category->slug ); ?>"><?php esc_html_e( $category->name ); ?></a>
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
                        <figure class="portfolio-item col-sm-4 item<?php esc_html_e( $slugs ); ?>">
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