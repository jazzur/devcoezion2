<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script>
            var $ = jQuery;
            $(document).ready(function(){
                $('.mega-menu-wrap .mega-menu-toggle').click(function(){
                    var menu_button = $("#mega-menu-wrap-Top .mega-menu-toggle + #mega-menu-Top");
                    menu_button.toggle("slow");                    
                });
                
                var lien_menu = $('#mega-menu-wrap-Top #mega-menu-Top li.mega-menu-item-has-children > a.mega-menu-link');
                lien_menu.after("<span class='arrow'><i class='fas fa-caret-down'></i></span>");
                
                var row_menu = $('#mega-menu-wrap-Top #mega-menu-Top li.mega-menu-item-has-children');
                row_menu.click(function(){
                    var show_sub_menu = $(this).find('ul.mega-sub-menu');
                    show_sub_menu.toggle("slow");
                })
            })
        </script>
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
