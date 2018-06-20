<?php
/*   add_action( 'after_setup_theme', 'coezion2_custom_logo_setup' );
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
*/    
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
    
    
    
    function monprefixe_session_start() {
        if ( ! session_id() ) {
            @session_start();
        }
    }
    add_action( 'init', 'monprefixe_session_start', 1 );
    
    function theme_multipages_scripts() {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.9.1.min.js');
        wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.12.4.min.js');
        wp_enqueue_script( 'jquery','https://code.jquery.com/ui/1.12.1/jquery-ui.js');
        wp_enqueue_script( 'bootstrapjs','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',array('jquery'), false, false);
        wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.css' );
        wp_enqueue_style( 'jqueryuicss', get_template_directory_uri() . '/css/jquery-ui.css' );
        
//         wp_enqueue_script( 'parallaxe', get_template_directory_uri() . '/js/parallaxe.js', array('jquery'), false, false );
//         wp_enqueue_script( 'parallaxefonction', get_template_directory_uri() . '/js/parallaxefonction.js', array('jquery'), false, false );
        wp_enqueue_script( 'tablesorter', get_template_directory_uri() . '/js/tablesorter.js', array('jquery'), false, false );
        wp_enqueue_script( 'tablesorterPager', get_template_directory_uri() . '/js/tablesorterPager.js', array('jquery'), false, false );
        wp_enqueue_script( 'announce', get_template_directory_uri() . '/js/annonce.js', array('jquery'), false, false );
        wp_enqueue_script( 'autocomplete_departement', get_template_directory_uri() . '/js/autocomplete_departement.js', array('jquery'), false, false );
        wp_enqueue_script( 'jquery-ui_auto', get_template_directory_uri() . '/js/jquery-ui_auto.js', array('jquery'), false, false );
        
        wp_enqueue_script( 'script', get_template_directory_uri() . '/js/fonction.js', array('jquery'), false, false );
        require_once( get_stylesheet_directory() .'/fonctionCRM.php');
        require_once( get_stylesheet_directory() .'/fonctionmin.php');
        
    }add_action( 'wp_enqueue_scripts', 'theme_multipages_scripts' );
    add_theme_support( 'menus' );
    
    add_filter('wp_mail_from_name', 'new_mail_from_name');
    function new_mail_from_name() { return 'Qualis'; }
?>