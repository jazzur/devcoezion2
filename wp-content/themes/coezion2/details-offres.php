<?php
/*
 * Template Name: details-offre
 */
    get_header();
?>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
                //get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu ins�r� en admin
                get_template_part( 'template-parts/offres/details-offre', get_post_format() );
            ?>
        </main>
    </div>
    <?php //get_sidebar(); ?>
</div><!-- .wrap -->
<?php
    get_footer();
?>