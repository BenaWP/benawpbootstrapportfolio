<?php

/**
 * Adds Benawp_Phone_Number widget.
 */
class Benawp_Phone_Number extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'benawp-phone-number', // Base ID
			__( 'Numéro de contact', 'benawpbootstrapportfolio' ), // Name // what we can search in widget lists
			array(
				'description'                 => __( 'Ajouter votre numméro de contact', 'benawpbootstrapportfolio' ),
				'customize_selective_refresh' => true,
			)
		);

		add_action( 'widgets_init', function () {
			register_widget( 'Benawp_Phone_Number' );
		} );

	}

	/**
	 * Front-end display of widget.
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
			esc_html_e( $title );
		} else {
			esc_html_e( '0xx xx xxx xx', 'benawpbootstrapportfolio' ); // In case the user does not put anything
		}
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = esc_html__( '0xx xx xxx xx', 'benawpbootstrapportfolio' ); // Place holder
		}
		?>
        <p>
            <label
                    for="<?php echo $this->get_field_name( 'title' ); ?>"
            >
				<?php esc_html_e( 'N° de téléphone', 'benawpbootstrapportfolio' ); ?> <!-- Label Title -->
            </label>
            <input
                    class="widefat"
                    id="<?php echo $this->get_field_id( 'title' ); ?>"
                    name="<?php echo $this->get_field_name( 'title' ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $title ); ?>"
            />
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 * @see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

new Benawp_Phone_Number();