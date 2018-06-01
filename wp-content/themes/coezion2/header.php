<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <?php wp_head(); ?>
    </head>
    <body>
        <header>
            <div id="header-logo">
                <?php 
                    if ( function_exists( 'coezion2_custom_logo' ) ) {
                        echo '<img id="logo" src="'. coezion2_custom_logo() .'">';
                    }
                ?>
                <?php
                    if ( has_nav_menu( 'Top' ) ) : 
                ?>
			<div class="navigation-top">
                            <div class="wrap">
                                <?php 
                                    wp_nav_menu( array( 
                                        'theme_location' => 'Top',
                                        'menu_id' => 'mega-menu-Top',
                                        'container_id' => 'mega-menu-wrap-Top',
                                        'fallback_cb'=> 'false'
                                    ) ); 
                                ?>
                            </div>
			</div>
		<?php endif; ?>
            </div>
        </header>
        <div class="site-content-contain">
            <div id="content" class="site-content">
