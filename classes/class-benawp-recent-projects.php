<?php

class Benawp_Recent_Projects extends WP_Widget {

	/**
	 * 1. SETUP
	 * Register widget with WordPress.
	 *
	 * Widget ID
	 * Widget Name
	 * Widget html Class name
	 * Widget Description
	 *
	 * The the registration
	 */
	public function __construct() {

		parent::__construct(
			'benawp-recent-projects', // Base ID
			__( 'BenaWP Projets récent', 'benawp-bootstrap-portfolio' ), // Name
			array(
				'class'                       => 'benawp-recent-projects',
				'description'                 => __( 'Un widget personnalisé qui affiche les vignettes des qautre projets les plus récents.', 'benawp-bootstrap-portfolio' ),
				'customize_selective_refresh' => true,
			)
		);

		// The registration
		add_action( 'widgets_init', function () {
			register_widget( 'Benawp_Recent_Projects' );
		} );
	}

	/**
	 * 2. FO
	 * Front-end display of widget.
	 *
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		// Create a custom query and get the most recent 6 projects
		$queryArgs = array(
			'cat'            => '-1', // Do not get pots form the Uncategorized category.
			'orderby'        => 'date', // Defaults order 'DESC'
			'posts_per_page' => '6'
		);
		$query     = new WP_Query( $queryArgs );

		// The Loop
		if ( $query->have_posts() ) :
			?>
            <ul class="row">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <li class="col-md-6">
                        <a
                                href="<?php the_permalink(); ?>"
                                title="<?php the_title_attribute(); ?>"
                        >
							<?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?>
                        </a>
                    </li>
				<?php endwhile; ?>
            </ul>
		<?php
		endif;

		echo $after_widget;

	}

	/**
	 * 3. BO
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$defaults = array(
			'title' => __( 'Projets récents', 'benawp-bootstrap-portfolio' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); // Fusionne $instance dans le tableau $defaults.
		?>
        <p>
            <label
                    for="<?php esc_attr_e( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Titre: ', 'benawp-bootstrap-portfolio' ); ?>
            </label>

            <input
                    type="text"
                    class="widefat"
                    id="<?php echo $this->get_field_id( 'title' ); ?>"
                    name="<?php echo $this->get_field_name( 'title' ); ?>"
                    value="<?php echo esc_attr( $instance['title'] ); ?>"
            >
        </p>
		<?php
	}

	/**
	 * 4.SAVE
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 *
	 * @see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( stripcslashes( $new_instance['title'] ) ); // Update values.

		return $instance;
	}

}

new Benawp_Recent_Projects();