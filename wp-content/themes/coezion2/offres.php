<?php
/*
 * Template Name: offre
 */
    get_header();
?>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <main id="main" class="site-main liste-offres-tmp" role="main">
            <?php
                //get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu inséré en admin
                get_template_part( 'template-parts/offres/liste-offres', get_post_format() );
            ?>
        </main>
    </div>
</div>
<?php
    get_footer();
?>