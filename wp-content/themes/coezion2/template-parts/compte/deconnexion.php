<div id="main-wrapper">
<br/>
<?php
    session_destroy();
    get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu inséré en admin
?>
</div>
<script>
    // Deconnexion menu
    $("li.deconnexion-menu").css("display", "none");
</script>

