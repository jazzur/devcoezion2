<!------------------------- Inscrioption ------------------------->
<section class="inscription col-lg-5 col-lg-push-1">
    <h1 class="titre_page">Vous n'&ecirc;tes pas encore inscrit ?</h1>
    <hr/>
    <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_inscr col-lg-12" enctype="multipart/form-data" >
        <section class="col-lg-3">
            <label for="civ">Civilit&eacute;*</label>
            <select id="civ" class="form-control" name="civilite">
                <option value="M" selected>Homme</option>
                <option value="Mme">Femme</option>
            </select>
        </section>
        <section class="col-lg-3">
            <label for="nom">Nom*</label>
            <input type="text" name="nom" id="nom" placeholder="" class="form-control" />
        </section>
        <section class="col-lg-3">
            <label for="prenom">Pr&eacute;nom*</label>
            <input type="text" name="prenom" id="prenom" class="form-control"  placeholder="" />
        </section>
        <section class="col-lg-3">
            <label for="mail">E-mail*</label>
            <input type="email" name="email" id="email" class="form-control"  placeholder="" oninvalid="invalid()" />
        </section>
        <section class="col-lg-3">
            <label for="mdp">Mot de passe*</label>
            <input type="password" name="mdp" id="mdpass" class="form-control"  value="<?=rand()."coe".rand()."zion"; ?>" />
        </section>
        <section class="col-lg-3">
            <label for="phone">Mobile*</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="" />
        </section>
        <section class="col-lg-9">
            <label for="adresse">Adresse*</label>
            <input type="text" name="adresse" id="adresse" class="form-control"  />
        </section>
        <section class="col-lg-3">
            <label for="cp">Code Postal*</label>
            <input type="text" name="cp" id="cp" placeholder=""  class="form-control"/>
        </section>
        <section class="col-lg-3">
            <label for="ville">Ville*</label>
            <input type="text" name="ville" id="ville" class="form-control" />
        </section>
        <section class="col-lg-9">
            <label for="competence">Comp&eacute;tences*</label>
            <input type="text" name="competence" id="competence" class="form-control"  />
        </section>
        <section class="col-lg-3">
            <label for="expe">Exp&eacute;rience*</label>
            <select id="expe" name="expe"  class="form-control" >
                <?php 
                    $experiences = fonctionCRM::getExperiences();
                    for($i=0;$i<count($experiences);$i++){ 
                ?>
                    <option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
                <?php } ?>
            </select>
        </section>
        <section class="col-lg-3">
            <label for="datedebut">Disponibilit&eacute;*</label>
            <input type="date" name="datedebut" id="datedebut" class="form-control" />
        </section>
        <section class="col-lg-6">
            <label for="salaire">Salaire souhait&eacute; (K)*</label>
            <input type="text" name="salaire" id="salaire" class="form-control"  placeholder="" />
        </section>
        <section class="col-lg-9">
            <label for="cv">CV*</label>
            <input type="file" name="cv" id="cv" class="form-control"/>
        </section>

        <section class="col-lg-9 submit_form"><br/>
            <input type="submit" name="inscription" class="submit_profil btn btn-primary" value="Inscription" disabled="true" />
        </section>
    </form>
</section>
<!------------------------- Inscrioption ------------------------->
<script>
    var validate = function(){
        // Bouton inscription non grisé => tous les champs doivent être rempli
        var input_inscription = $("form.form_inscr input.form-control");
        var valid_fields = $("form.form_inscr .form-control.success");
        if(valid_fields.length > input_inscription.length){
            $("input.submit_profil[name='inscription']").prop( "disabled", false );
        }else{            
            $("input.submit_profil[name='inscription']").prop( "disabled", true );
        }
    }
    
    //invalid = function(){
    function invalid(){
        console.log('test', $("input#email"))                
    }
    
    // Validation des champs non vide
    $("input.form-control").focusout(function(){
        if($(this).val() == ""){
            $(this).addClass("error");
            $(this).removeClass("success");
        }else{
            $(this).addClass("success");
            $(this).removeClass("error");
        }
        validate();
    });
    
    // Validation des selects non vide
    $("select.form-control").focusout(function(){
        if($(this)[0].value == ""){
            $(this).addClass("error");
            $(this).removeClass("success");
        }else{
            $(this).addClass("success");
            $(this).removeClass("error");
        }
        // validate(); // les selects sont remplis par defaut
    });
</script>