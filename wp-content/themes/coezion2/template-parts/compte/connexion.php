<?php
/*
Template Name: Connexion
*/
/********************* Connexion ***********************/
if(isset($_GET['annonce'])){
    $connexion_annonce = $_GET['annonce'];
}
if(isset($_SESSION['id']) != ""){
    echo "session vide";
}

$error = false;
if(isset($_POST['connexion'])){
    $mail = htmlentities($_POST['mail']);	
    $mdp = htmlentities($_POST['mdp']);

    $data = ["Email"=>$mail,"Password"=>$mdp];
    $data_string = json_encode($data);
     // Appel et param&eacute;trage de l'API
    $ch = curl_init('http://api.infolor.fr/api/CRM/GetCandidateByLogin');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    $resultlogin = curl_exec($ch);
    $codeErrorSave = json_decode($resultlogin);

    if($codeErrorSave == Null){
        $error="Vos identifiants ne sont pas corrects";
    }else{
        $_SESSION['id'] = $codeErrorSave->Id;
        $_SESSION['mail'] = $codeErrorSave->Email;
        $_SESSION['nom'] = $codeErrorSave->LastName;
        $_SESSION['prenom'] = $codeErrorSave->FirstName;
        $_SESSION['addresse'] = $codeErrorSave->Address;
        $_SESSION['salaire'] = $codeErrorSave->WantedSalary;
        $_SESSION['expe'] = $codeErrorSave->ExperienceYears;
        $_SESSION['cp'] = $codeErrorSave->PostalCode;
        $_SESSION['ville'] = $codeErrorSave->City;
        $_SESSION['competence'] = $codeErrorSave->Competencies;
        $_SESSION['civil'] = $codeErrorSave->Civility;
        $_SESSION['dispo'] = $codeErrorSave->Disponibility;
        $_SESSION['annonce'] = $codeErrorSave->Announces;
        $_SESSION['mdp'] = $codeErrorSave->Password;
        $_SESSION['cv'] = $codeErrorSave->CVFileName;
        $_SESSION['avatar'] = $codeErrorSave->AvatarFileName;
        $_SESSION['avatarcode'] = $codeErrorSave->AvatarEncodedBase64FileContent;
        $_SESSION['mobile'] =  $codeErrorSave->Mobile;

        if($_SESSION['id'] != ""){
            /**************************************************************/
            header("Location: http://localhost/devcoezion2/index.php/mon-compte/");
        }
        if($_SESSION['id'] != "" && $connexion_annonce != ""){
            /*************************************************************/
            header("Location: http://localhost/devcoezion2/index.php/repondre-aux-offres/details-offre/?id=".$connexion_annonce);
        }
    }
} 
/********************* Fin connexion ***********************/

/********************* Inscription ***********************/
$error = false; 
if(isset($_POST['inscription'])){
    $civilite = htmlentities($_POST['civilite']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $adresse = htmlentities($_POST['adresse']);
    $cp = htmlentities($_POST['cp']);
    $ville = htmlentities($_POST['ville']);
    $tel = htmlentities($_POST['phone']);
    $mail = htmlentities($_POST['mail']);
    $competence = htmlentities($_POST['competence']);
    $competences = substr($competence,0,-1);
    $expe = htmlentities($_POST['expe']);
    $disponibilite = htmlentities($_POST['datedebut']);
    $salaire = htmlentities($_POST['salaire']);
    $mdp = htmlentities($_POST['mdp']);
    $cv = $_FILES["cv"];
    $uploaddir = get_stylesheet_directory().'/cv/';

    if($cv["name"] == ""){
        $error = "Merci de bien vouloir joindre votre CV.";
    }else{
        $uploadfile = $uploaddir . basename($cv['name']);
        if($cv["name"] != ""){
            move_uploaded_file($cv['tmp_name'], $uploadfile);
            $dataInFile = file_get_contents($uploadfile);
            $cv64 = base64_encode($dataInFile);
            $data = ["CompanyId"=>2,"AnnouceId"=>null,"FileName"=>$cv["name"],"EncodedBase64FileContent" =>$cv64];
            $data_string = json_encode($data);
            $objetCandidat = fonctionCRM::getCandidatByCv($data_string);			
            $datasave = [
                "Id" => $objetCandidat->Id,
                "Civility" => $civilite,
                "FirstName"=> $nom, 
                "LastName" => $prenom,
                "Email" =>	$mail,
                "Password" => $mdp,
                "Address" =>  $adresse,
                "City" => $ville,
                "Mobile" => $tel,
                "PostalCode" => $cp, 
                "Disponibility" => $disponibilite, 
                "Competencies" => $competences,
                "Announces" => null,
                "WantedSalary" => $salaire,
                "ExperienceYears" => $expe,
                "CVFileName" => $cv['name'],
                "AvatarFileName" => null,
                "AvatarEncodedBase64FileContent" => null
            ];

            $datasave_string = json_encode($datasave);
        
             // Appel et param&eacute;trage de l'API
            $ch = curl_init('http://api.infolor.fr/api/CRM/SaveCandidate');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datasave_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            $resultsave = curl_exec($ch);
            $codeErrorSave = json_decode($resultsave);
            // var_dump("<br/>enregistrement : ".$resultsave);/**/	
            echo "<section class='alert alert-success'>F&eacute;licitations ! Vous &ecirc;tes incrit, <a href='http://dev-wordp.qualis-tt.fr/connexion'>Connectez-vous ici </a></section>";

            $sujet = "Bienvenue chez Qualis";  
            $headers= "MIME-Version: 1.0\n";   
            $headers.= "From: \"Qualis\" <contact@qualis-tt.fr>\n"; 
            $headers.= "Content-type: multipart/mixed;\n";   
            $limite = '_parties_'.md5(uniqid (rand()));   

            $headers.= " boundary=\"----=$limite\"\n\n";   

            $texte = "------=$limite\n";   
            $texte.= "Content-type: text/html; charset=\"iso-8859-1\"\n\n";

            $texte .= "Bonjour ".$prenom.",<br/>";
            $texte .= "Voici votre mot de passe : " . $mdp . ", connectez vous Ã  votre compte <a href='http://dev-wordp.qualis-tt.fr/connexion'>ici</a> et optimis&eacute; votre profil.<br/>";
            $texte .= "Ã€ tout de suite sur Qualis !";
            // exit(0);
            mail($mail, $sujet, utf8_decode($texte), $headers);
        }
    }
}
$params= "";
$competencesTab = fonctionCRM::getCompetences($params);
$experiences = fonctionCRM::getExperiences();
$civility = fonctionCRM::getCivilities();
/********************* Fin Inscription ***********************/

//get_header();

get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu inséré en admin
?>
<!------------------------- Connexion ------------------------->
<section class="page col-lg-12" id="main-wrapper">
<br/>
    <section class="connexion col-lg-5 col-lg-push-1">
        <h1>Connectez vous et g&eacute;rer vos candidatures </h1>
        <hr/>
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_connexion col-lg-10" enctype="multipart/form-data" >
            <section class="col-lg-9">
                <label for="mail">Email </label>
                <input type="email" name="mail" id="mail" class="form-control" value="azur.mathieu@gmail.com" />
            </section>
            <section class="col-lg-9">
                <label for="mdp">Mot de passe </label>
                <input type="text" name="mdp" id="mdp" class="form-control"  value="ok" />
            </section>
            <section class="col-lg-9 submit_form"><br/>
                <input type="submit" name="connexion" class="submit_profil btn btn-primary" value="Connexion" />
            </section>
        </form>
        <?php
        if(isset($error)){ ?>
            <section class="col-xs-12 col-sm-6  col-md-5 col-lg-9 alert-warning"><?=$error; ?></section>
        <?php } ?>
    </section>
    <!--<section class="col-xs-12 col-sm-6  col-md-5 col-lg-4">
        <p>Connectez vous avec vos comptes sociaux</p>
        <?php //do_action( 'wordpress_social_login' ); ?> 
        <p>Aucune information ne sera partag&eacute;e sans votre consentement</p>
    </section>-->
<!------------------------- Fin Connexion ------------------------->

<!------------------------- Inscrioption ------------------------->

    <section class="inscription col-lg-5 col-lg-push-1">
        <h1 class="titre_page">Vous n'&ecirc;tes pas encore inscrit ?</h1>
        <hr/>
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_inscr col-lg-12" enctype="multipart/form-data" >
            <section class="col-lg-3">
                <label for="civ">Civilit&eacute;</label>
                <select id="civ" class="form-control" name="civilite">
                    <option value="M" selected>Homme</option>
                    <option value="Mme">Femme</option>
                </select>
            </section>
            <section class="col-lg-3">
                <label for="nom">Nom </label>
                <input type="text" name="nom" id="nom" placeholder="Jean" class="form-control" />
            </section>
            <section class="col-lg-3">
                <label for="prenom">Pr&eacute;nom </label>
                <input type="text" name="prenom" id="prenom" class="form-control"  placeholder="Bernard" />
            </section>
            <section class="col-lg-3">
                <label for="mail">E-mail </label>
                <input type="mail" name="email" id="email" class="form-control"  placeholder="Votre mail" />
            </section>
            <section class="col-lg-3">
                <label for="mdp">Mot de passe </label>
                <input type="password" name="mdp" id="mdpass" class="form-control"  value="<?=rand()."qua".rand()."lis"; ?>" />
            </section>
            <section class="col-lg-3">
                <label for="phone">Mobile </label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="06 07 08 09 10" />
            </section>
            <section class="col-lg-9">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control"  />
            </section>
            <section class="col-lg-3">
                <label for="cp">Code Postal </label>
                <input type="text" name="cp" id="cp" placeholder="75000"  class="form-control"/>
            </section>
            <section class="col-lg-3">
                <label for="ville">Ville </label>
                <input type="text" name="ville" id="ville" class="form-control" />
            </section>
            <section class="col-lg-9">
                <label for="competence">Comp&eacute;tences </label>
                <input type="text" name="competence" id="competence" class="form-control"  />
            </section>
            <section class="col-lg-3">
                <label for="expe">Exp&eacute;rience</label>
                <select id="expe" name="expe"  class="form-control" >
                    <?php for($i=0;$i<count($experiences);$i++){ ?>
                        <option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
                    <?php } ?>
                </select>
            </section>
            <section class="col-lg-3">
                <label for="datedebut">Disponibilit&eacute; </label>
                <input type="date" name="datedebut" id="datedebut" class="form-control" />
            </section>
            <section class="col-lg-6">
                <label for="salaire">Salaire souhait&eacute; (K)</label>
                <input type="text" name="salaire" id="salaire" class="form-control"  placeholder="43" />
            </section>
            <section class="col-lg-9">
                <label for="cv">CV </label>
                <input type="file" name="cv" id="cv" />
            </section>

            <section class="col-lg-9 submit_form"><br/>
                <input type="submit" name="inscription" class="submit_profil btn btn-primary" value="Inscription" />
            </section>
        </form>
    </section>
</section>

<script>
jQuery(function($){
var availableTags =  <?php echo json_encode($competencesTab); ?>;

function split( val ) {
  return val.split( /,\s*/ );
}
function extractLast( term ) {
  return split( term ).pop();
}
$( "#competence" )
    // don't navigate away from the field on tab when selecting an item
    .on( "keydown", function( event ) {
      if ( event.keyCode === $.ui.keyCode.TAB &&
          $( this ).autocomplete( "instance" ).menu.active ) {
        event.preventDefault();
      }
    })
    /*.autocomplete({
      minLength: 3,
      source: function( request, response ) {
        // delegate back to autocomplete, but extract the last term
        response( $.ui.autocomplete.filter(
          availableTags, extractLast( request.term ) ) );
      },
      focus: function() {
        // prevent value inserted on focus
        return false;
      },
      select: function( event, ui ) {
        var terms = split( this.value );
        // remove the current input
        terms.pop();
        // add the selected item
        terms.push( ui.item.value );
        // add placeholder to get the comma-and-space at the end
        terms.push( "" );
        this.value = terms.join( ", " );
        return false;
      }
    });*/
});
</script>
<!------------------------- Inscrioption ------------------------->

<?php 
    get_footer(); 
?>