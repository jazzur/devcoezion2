<?php
    add_action( 'after_setup_theme', 'coezion2_custom_logo_setup' );
    function coezion2_custom_logo_setup() {
        $defaults = array(
            'height'      => 1000,
            'width'       => 4000,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    
    add_action('after_setup_theme' ,'coezion2_custom_logo');
    function coezion2_custom_logo() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
            return esc_url( $logo[0] );
        } else {
            echo "There is no logo in the admin panel";
        }
    }
    
    add_theme_support('menus');
    
    add_action('wp_enqueue_scripts', 'coezion_insert_css_in_head');
    function coezion_insert_css_in_head() {
        wp_register_style('style', get_bloginfo( 'stylesheet_url' ),'',false,'screen');
        wp_enqueue_style( 'style' );
    }
    
    function register_my_menus() {
        //register_nav_menu();
        register_nav_menus( array(
            'Top' => __( 'Menu Top' ),
            'footer-menu' => __( 'Menu Footer' )
        ));
    }
    add_action( 'init', 'register_my_menus' );
    
?>