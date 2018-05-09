<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
        <header>
            <div id="header-logo">
                <?php //printf( wp_enqueue_style( 'style', get_stylesheet_uri() ) ); ?>
                <?php 
                    if ( function_exists( 'coezion2_custom_logo' ) ) {
                        echo '<img class="test" id="logo" src="'. coezion2_custom_logo() .'">';
                        //coezion2_custom_logo_setup();
                    }
                ?>
            </div>
        </header>
        <div class="site-content-contain">
            <div id="content" class="site-content">
