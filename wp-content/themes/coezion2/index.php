<?php
    define('WP_USE_THEMES', true);
    get_header();
?>
<div id="fond_bois"></div>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
                get_template_part( 'template-parts/post/content', get_post_format() );
            ?>
        </main>
    </div>
    <?php //get_sidebar(); ?>
</div><!-- .wrap -->
<div id="fond_bois"></div>
<?php
get_footer();
