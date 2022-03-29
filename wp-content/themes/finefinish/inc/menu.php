<?php

function register_ewd_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' ),
            'footer-social' => __( 'Footer Social' ),
        )
    );
}