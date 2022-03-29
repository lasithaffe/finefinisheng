<?php

class wpb_footer_bottom_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

            'footer_bottom_widget',
            __('Footer Bottom Widget', 'wpb_widget_domain'),
            array( 'description' => __( 'Footer Booter Widget by EWD', 'wpb_widget_domain' ), )
        );
    }

    public function widget( $args, $instance ) {
        $title          = apply_filters( 'widget_title', $instance['title'] );
        $address        = apply_filters( 'widget_desc',  $instance['address'] );
        $phone          = apply_filters( 'widget_label', $instance['phone'] );
        $email          = apply_filters( 'widget_link',  $instance['email'] );
        $web            = apply_filters( 'widget_link',  $instance['web'] );



        if (! empty( $phone ) )
            echo '<a class="call">'.$phone.'</a>';

        if (! empty( $email ) )
            echo '<a class="mail" href="mailto:'.$email.'">'.$email.'</a>';

        if (! empty( $web ) )
            echo '<a class="web" href="'.$web.'">'.$web.'</a>';

    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) && isset( $instance[ 'address' ] ) && isset( $instance[ 'phone' ]) && isset( $instance[ 'email' ] ) && isset( $instance[ 'web' ] )) {
            $title          =  $instance[ 'title' ];
            $address        =  $instance[ 'address' ];
            $phone          =  $instance[ 'phone' ];
            $email          =  $instance[ 'email' ];
            $web            =  $instance[ 'web' ];
        }
        else {

            $title          = __( 'New Title', 'wpb_widget_domain' );
            $address        = __( 'New Address', 'wpb_widget_domain' );
            $phone          = __( 'New Phone', 'wpb_widget_domain' );
            $email          = __( 'New Email', 'wpb_widget_domain' );
            $web            = __( 'New Website', 'wpb_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"  ><?php echo esc_attr( $address ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'web' ); ?>"><?php _e( 'Web:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'web' ); ?>" name="<?php echo $this->get_field_name( 'web' ); ?>" type="url" value="<?php echo esc_attr( $web ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
        $instance['web'] = ( ! empty( $new_instance['web'] ) ) ? strip_tags( $new_instance['web'] ) : '';
        return $instance;
    }
}