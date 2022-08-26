<?php

/**
 * Adds Benawp_Phone_Number widget.
 */
class Benawp_Mail extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        parent::__construct( 
            'benawp-mail', // Base ID
            'E-mail de contact' // Name // what we can search in widget lists
        );

        add_action( 'widgets_init', function() {
            register_widget( 'Benawp_Mail' );
        } );
        
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        if ( ! empty( $title ) ) {
            esc_html_e( $title );
        }else{
            esc_attr_e( 'votre@email.com' ); // In case the user does not put anything
        }
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = esc_html__( 'votre@email.com', DOMAIN ); // Place holder
        }
        ?>
        <p>
            <label 
                for="<?php echo $this->get_field_name( 'title' ); ?>"
            >
                <?php esc_html_e( 'Adresse e-mail' ); ?> <!-- Label Title -->
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
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
 
        return $instance;
    }
}

new Benawp_Mail();