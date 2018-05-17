<?php

function monprefixe_session_start() {
   if ( ! session_id() ) {
      @session_start();
   }
}
add_action( 'init', 'monprefixe_session_start', 1 );

if ( function_exists('register_sidebar') ) register_sidebar(); 

function theme_multipages_scripts() {
wp_deregister_script( 'jquery' );
wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.9.1.min.js');
wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-1.12.4.min.js');
wp_enqueue_script( 'jquery','https://code.jquery.com/ui/1.12.1/jquery-ui.js');
wp_enqueue_script( 'bootstrapjs','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',array('jquery'), false, false);
wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.css' );
wp_enqueue_script( 'script', get_template_directory_uri() . '/js/fonction.js', array('jquery'), false, false );
// require_once( get_stylesheet_directory() .'/fpdf/fpdf.php');
}add_action( 'wp_enqueue_scripts', 'theme_multipages_scripts' );

?>