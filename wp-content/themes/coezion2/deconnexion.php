<?php
/*
Template Name: Deconnexion
*/

session_destroy();

get_header();
?>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <main id="main" class="site-main liste-offres-tmp" role="main">
            <?php
                get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu ins�r� en admin
            ?>
        </main>
    </div>
</div>
<?php
get_footer(); 
?>

