<?php 
/*
* Template Name: reset_pwd
*/

if(isset($_POST["reset_pass"])){
    $error = "";
    $mail = htmlentities($_POST['mail']);
    $mdp = rand()."coe".rand()."zion";
    $url = get_site_url() . '/mon-compte';
    
    $sujet = 'Nouveau mot de passe';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $texte .= '<html>Bonjour,<br/>';
    $texte .= 'Voici votre nouveau mot de passe g&eacute;n&eacute;r&eacute; : ' . $mdp . 
            ',<br/> connectez vous &agrave; <a href="' . $url . '">votre compte ' .
            ' ici</a>, et modifier votre mot de passe si vous souhaitez.<br/><br/>';
    $texte .= '&Agrave; tout de suite sur Coezion</html>';

    $mail_send = wp_mail($mail, $sujet, utf8_decode($texte), $headers);
    if (mail_send) {
        
        $error = "Un mail vous &agrave; &eacute;t&eacute; envoy&eacute;";
    }else{
        $error = "Erreur, votre mail n'est pas parti";
    }
}

get_header();
?>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <mai
            n id="main" class="site-main liste-offres-tmp" role="main">
            <div id="main-wrapper">
                <?php
                    get_template_part( 'template-parts/compte/reset_pwd', get_post_format() );
                ?>
            </div>
        </main>
    </div>
</div>

<script>
// Validation formulaire
$(document).ready(function(){
    var input_reset_pwd = $("section.reset-pass input.form-control");
    
    // Reste a invalider en fonction du type de champs
    function validate_type(item){
        if(item[0].validity.valid == true){
            item.addClass("success").removeClass("error");
        }else{
            item.addClass("error").removeClass("success");
        }
    }
    
    var validate_button = function(){
        // Bouton de Réinitialisation de mot de passe non grisé => tous les champs doivent être rempli
        var valid_fields_reset_pwd = $("section.reset-pass input.form-control.success");
        if(valid_fields_reset_pwd.length >= input_reset_pwd.length){
            $("input#reset_pass[name='reset_pass']").prop( "disabled", false );
        }else{
            $("input#reset_pass[name='reset_pass']").prop( "disabled", true );
        }
    }

    // Validation du type de champ
    if(input_reset_pwd.length > 0){
        input_reset_pwd.each(function(i, a){
            if($(this).val() != ""){
                validate_type($(this));
            }
        });
        validate_button();
    }
    
    // Validation des champs non vide
    $("input.form-control").change(function(){
        if($(this).val() == ""){
            $(this).addClass("error").removeClass("success");
        }else{
            validate_type($(this));
        }
        validate_button();
    });
});
</script>

<?php
get_footer(); 
?>

