<?php
/*
Template Name: Deconnexion
*/

get_header();
?>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <main id="main" class="site-main liste-offres-tmp" role="main">
            <?php
                get_template_part( 'template-parts/compte/deconnexion', get_post_format() );
            ?>
        </main>
    </div>
</div>
<?php
get_footer(); 
?>
