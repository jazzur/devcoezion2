<div id="main-wrapper">
<br/>
<?php
    session_destroy();
    get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu ins�r� en admin
?>
</div>
<script>
    // Deconnexion menu
    $("li.deconnexion-menu").css("display", "none");
</script>

