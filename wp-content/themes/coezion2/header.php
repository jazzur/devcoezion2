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
                <?php
                    // print_r("test: ".has_nav_menu( 'navigation-top' ));
                    // if ( has_nav_menu( 'navigation-top' ) ) : 
					// TEST !!!!!
					?>
			<div class="navigation-top">
                            <div class="wrap">
                                <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                            </div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php //endif; ?>
            </div>
        </header>
        <div class="site-content-contain">
            <div id="content" class="site-content">
