<!---------------------------------------- Compte ---------------------------------------------->
<section class="menu_gauche col-lg-3">
    <ul>
        <li><a href="#coordonnees" class="lien_coord">Mes coordonn&eacute;es</a></li>
        <li><a href="#documents" class="lien_docu">Mes documents</a></li>
        <!--<li><a href="#candidatures" class="lien_candidature">Mes candidatures</a></li>-->
    </ul>
</section>

<div id="coordonnees"></div>
<section class="contenu_profil col-xs-12 col-sm-12 col-md-12 col-lg-7 col-lg-push-1">
    <h2>Bonjour <?= $_SESSION['civil']." ".ucfirst(strtolower($_SESSION['prenom']))." ".ucfirst(strtolower($_SESSION['nom']));?></h2>	
    <section class="interf_coord">
        <section class="avatar col-xs-3 col-xs-push-1 col-sm-5 col-md-push-1 col-md-5 col-lg-3">
            <section class="avatar_profil">
                <?php
                if($_SESSION['avatar']){ ?>
                    <img src="<?= get_stylesheet_directory_uri().'/assets/images/profile/miniature/'.$_SESSION['avatar'];?>" alt="avatar profil" class="img-responsive mon_avatar" />
                <?php 
                }else{?>
                    <img src="<?= get_stylesheet_directory_uri().'/assets/images/profile/avatar.png';?>" alt="avatar profil" class="img-responsive mon_avatar" />
                <?php } ?>
                <span  class="icon_modif_avatar"><img src="<?= get_stylesheet_directory_uri().'/assets/images/profile/modif-avatar.png';?>" /><br/>Modifier</span>
            </section>
            <section class="modifavatar2">
                <form action="#" method="post" class="form_avatar" enctype="multipart/form-data">
                    <input type="file" name="avatar" class="bouton_file2" id="avatar_file" />
                    <input type="submit" name="avatar_sub" id="avatar_sub" class="avatar_sub2" value="Modifier avatar" />
                </form>
            </section>
        </section>
    </section>
    <script>
        // Manage Avatar
        var avatar = $("section.avatar_profil");
        var choose_file_button = $("input#avatar_file");
        avatar.click(function(){
            var modif_avatar = $("section.modifavatar2");
            choose_file_button = $("input#avatar_file");
            choose_file_button.click();
            modif_avatar.toggle("slow");
        });
        choose_file_button.on("change", function(){
            var tab_new_avatar_name = choose_file_button[0].value.split('\\');
            var new_avatar_name = tab_new_avatar_name[2];
            var modif_avatar_button = $("input#avatar_sub");
            modif_avatar_button[0].value = "Save "+new_avatar_name;
            console.log(tab_new_avatar_name)
        })
    </script>

    <section class="presentation_profil col-xs-12 col-sm-5 col-md-5 col-md-push-1 col-lg-push-1 col-lg-7">
        <ul class="coordonnees">
            <li><strong>Mail: </strong> <?=$_SESSION['mail']; ?></li>
            <li><strong>Mobile: </strong> <?=$_SESSION['mobile']; ?></li>
            <li><strong>Adresse: </strong> <?= $_SESSION['addresse']; ?></li>
            <li><strong>Cp et ville: </strong> <?=$_SESSION['cp'].' | '.$_SESSION['ville']; ?></li>				
            <li><strong>Exp&eacute;rience et Disponibilit&eacute;: </strong> <?php $date = new DateTime($_SESSION['dispo']); echo $_SESSION['expe'].' | '. $date->format('d-m-Y'); ?></srong></li>
            <li><strong>Comp&eacute;tence: </strong> <?= implode(',', $_SESSION['competence']) ?></li>
            <li><strong>Salaire souhait&eacute;: </strong> <?= $_SESSION['salaire'] ?></li>
        </ul>
        <span class="modifier"><img id="modif_coord" src="<?= get_stylesheet_directory_uri().'/assets/images/modif_coord.png' ?>" title="Modifier vos coordonn&eacute;es" alt="Modifier coordonees"></span>
    </section>
</section>

<section class="col-lg-12 modif-coordonnees">
    <h4>Vos coordonn&eacute;es</h4>
    <section class="col-lg-3">
        <label for="civ">Civilit&eacute;*</label>
        <select name="civilite" id="civ-coord" class="form-control">
            <option value="M." selected>Homme</option>
            <option value="Mme">Femme</option>	
        </select>
    </section>
    <section class="col-lg-3">
        <label for="prenom">Pr&eacute;nom* </label>
        <input type="text" name="prenom" id="prenom-coord" value="<?=$_SESSION['prenom']; ?>" class="form-control" />
    </section>
    <section class="col-lg-3">	
        <label for="nom">Nom*</label>
        <input type="text" name="nom" id="nom-coord" value="<?=$_SESSION['nom']; ?>" class="form-control" />
    </section>
    <section class="col-lg-3">
        <label for="mail">E-mail*</label>			
        <input type="mail" name="mail" id="mail-coord" class="form-control"  value="<?=$_SESSION['mail']; ?>" />
    </section>
    <section class="col-lg-3">
        <label for="mdp">Mot de passe*</label>
        <input type="text" name="mdp" id="mdp-coord" value="<?=$_SESSION['mdp']; ?>" class="form-control" />
    </section>
    <section class="col-lg-3">	
        <label for="mobile">T&eacute;l&eacute;phone*</label>			
        <input type="text" name="mobile" id="mobile-coord" class="form-control"  value="<?=$_SESSION['mobile']; ?>" />
    </section>
    <section class="col-lg-9">
        <label for="adresse">Adresse*</label>
        <input name="adresse" id="adresse-coord" class="form-control" value="<?=$_SESSION['addresse'];?>" />
    </section>
    <section class="col-lg-3">
        <label for="cp">Code Postal*</label>
        <input type="text" name="cp" id="cp-coord" class="form-control" value="<?=$_SESSION['cp']; ?>" />	
    </section>
    <section class="col-lg-3">	
        <label for="ville">Ville*</label>			
        <input type="text" name="ville" id="ville-coord" class="form-control" value="<?=$_SESSION['ville']; ?>"  />
    </section>
    <section class="col-lg-9">
        <label for="competence">Comp&eacute;tences*</label>
        <input type="text" name="competence" id="competence-coord" class="form-control" value="<?= implode(",", $_SESSION['competence']) ?>" />
    </section>
    <section class="col-lg-3">								
        <label for="expe">Exp&eacute;rience*</label>							
        <select id="expe-coord" name="expe"  class="form-control" >
            <option value="<?=$_SESSION['expe'];?>"><?=$_SESSION['expe'];?></option>
            <?php for($i=0;$i<count($experiences);$i++){ ?>
                <option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
            <?php } ?>
        </select>
    </section>
    <section class="col-lg-3">				
        <label for="dispo">Disponibilit&eacute;*</label>			
        <input type="date" name="dispo" id="dispo-coord" class="form-control"  value="<?php $date = new DateTime($_SESSION['dispo']); echo $date->format('Y-m-d'); ?>" />
    </section>
    <section class="col-lg-3">								
        <label for="salaire">Salaire souhait&eacute; (K)*</label>							
        <input type="text" name="salaire" id="salaire-coord" class="form-control" value="<?=$_SESSION['salaire']; ?>"/>			
    </section>
    <section class="col-lg-9 submit_form">
        <input type="submit" name="modifier_coord" id="modifier_coord" class="btn btn-primary" value="Modifier" disabled="true" />
        <span class='save-message coordonnees'></span>
        <img src="<?= get_stylesheet_directory_uri().'/assets/images/waiting.gif' ?>" alt="waiting..." class="waiting-gif coordonnees"/>
    </section>
</section>
<script>
    var modif_coord_button = $('img#modif_coord');
    modif_coord_button.click(function(){
        var show_coord_form = $('section.modif-coordonnees');
        show_coord_form.toggle("slow");
        validate();
    })
</script>

<div id="documents"></div>
<section class="col-lg-12">
    <h4>votre cv</h4>
    <section class="col-lg-12">
        <table class="table-hover table_profil">
            <tr>
                <td><?=$_SESSION['cv'];?></td>				
                <td><!--<a href="">Supprimer</a> | --><a href="<?=get_stylesheet_directory_uri().'/assets/cvCRM/'. $_SESSION['cv']; ?>" target="_blank" >Voir</a> | <span class="modif_cv">Modifier</span></td>
            </tr>
        </table>
    </section>
    <section class="col-lg-12 upload_cv">
        <form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" class="form_telcv col-xs-12 col-sm-5 col-md-5 col-lg-10" enctype="multipart/form-data" >
            <input type="file" name="cv" id="cv-coord">
            <input type="submit" value="T&eacute;l&eacute;charger cv" name="submit_documents" class="submit_profil btn btn-primary" />
        </form>	
    </section>
    <script>
        var modif_cv_button = $('span.modif_cv');
        modif_cv_button.click(function(){
            var show_cv_form = $('section.upload_cv');
            show_cv_form.toggle("slow");
        })
    </script>
</section>
<!---------------------------------------- Fin Compte ---------------------------------------------->