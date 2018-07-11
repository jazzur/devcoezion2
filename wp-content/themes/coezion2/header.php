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
                // Manage Menu
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
                });

                // Fix Menu
                var header = $("div#navigation-top");
                var headerOffsetTop = header[0].offsetTop; 
                function scrolled(){
                    var currentScroll = document.body.scrollTop || document.documentElement.scrollTop;

                    if(currentScroll >= headerOffsetTop){
                            header.addClass("fixed");
                    }else if(currentScroll < headerOffsetTop){
                                            header.removeClass("fixed");
                    }
                }
                addEventListener("scroll", scrolled, false);
                
                // Deconnexion menu
                var session = "<?= $_SESSION['id'] ?>";
                if(session == ""){ $("li.deconnexion-menu").css("display", "none"); }
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
			<div class="navigation-top" id="navigation-top">
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
