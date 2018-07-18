<?php
/*
Template Name: Compte
*/
get_header();

/********************* Connexion ***********************/
if(isset($_GET['annonce'])){
    $connexion_annonce = $_GET['annonce'];
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
    }
} 
/********************* Fin connexion ***********************/

/********************* Inscription ***********************/
//$error = false;
if(isset($_POST['inscription'])){
    $civilite = htmlentities($_POST['civilite']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $adresse = htmlentities($_POST['adresse']);
    $cp = htmlentities($_POST['cp']);
    $ville = htmlentities($_POST['ville']);
    $tel = htmlentities($_POST['phone']);
    $mail = htmlentities($_POST['email']);
    $competence = htmlentities($_POST['competence']);
        $competences = substr($competence,0,-1);
    $expe = htmlentities($_POST['expe']);
    $disponibilite = htmlentities($_POST['datedebut']);
    $salaire = htmlentities($_POST['salaire']);
    $mdp = htmlentities($_POST['mdp']);
    $cv = $_FILES["cv"];
    $uploaddir = get_stylesheet_directory().'/assets/cvCRM/';

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
                "Email" => $mail,
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
            print_r($codeErrorSave);
            //echo "<section class='alert alert-success'>F&eacute;licitations ! Vous &ecirc;tes incrit</section>";

            $sujet = "Bienvenue chez Coezzio";
            $headers= "MIME-Version: 1.0\n";
            $headers.= "From: \"Coezion\" <contact@coezion.fr>\n";
            $headers.= "Content-type: multipart/mixed;\n";
            $limite = '_parties_'.md5(uniqid (rand()));

            $headers.= " boundary=\"----=$limite\"\n\n";

            $texte = "------=$limite\n";   
            $texte.= "Content-type: text/html; charset=\"iso-8859-1\"\n\n";

            $texte .= "Bonjour ".$prenom.",<br/>";
            $texte .= "Voici votre mot de passe : " . $mdp . ", connectez vous Ã  votre compte <a href='http://dev-wordp.qualis-tt.fr/connexion'>ici</a> et optimis&eacute; votre profil.<br/>";
            $texte .= "&Agrave; tout de suite sur Qualis !";
            // exit(0);
            mail($mail, $sujet, utf8_decode($texte), $headers);
        }
    }
}
/********************* Fin Inscription ***********************/

/********************* Compte ***********************/
if(isset($_POST['avatar_sub'])){
        if(!empty($_FILES['avatar'])){
            $image = $_FILES['avatar'];
            $extension = strtolower(substr($image['name'],-3));
            $nomImage = $_SESSION['id'].$image['name'];

            $allow_extension = array("jpg", "png");
            $adresse_avatar = get_stylesheet_directory().'/assets/images/profile/'.$nomImage;
            $adresse_avatar_min = get_stylesheet_directory().'/assets/images/profile/miniature';

            if(in_array($extension, $allow_extension)){
                move_uploaded_file($image['tmp_name'],$adresse_avatar);

                Img::creerMin($adresse_avatar, $adresse_avatar_min ,$nomImage,145, 145 );
                Img::convertirJPG($adresse_avatar);

                $dataInFile = file_get_contents($adresse_avatar);
                $avatar64 = base64_encode($dataInFile);

                //enregistrement dans CRM
                $dataavatar = [
                    "Id" => $_SESSION['id'],
                    "Civility" => $_SESSION['civil'],
                    "FirstName"=> $_SESSION['prenom'],
                    "LastName" => $_SESSION['nom'],
                    "Email" =>	$_SESSION['mail'],
                    "Password" => $_SESSION['mdp'],
                    "Address" =>  $_SESSION['addresse'],
                    "City" => $_SESSION['ville'],
                    "Mobile" => $_SESSION['mobile'],
                    "PostalCode" => $_SESSION['cp'],
                    "Disponibility" => $_SESSION['dispo'],
                    "Competencies" => $_SESSION['competence'],
                    "Announces" => $_SESSION['annonce'],
                    "WantedSalary" => $_SESSION['salaire'],
                    "ExperienceYears" => $_SESSION['expe'],
                    "CVFileName" => $_SESSION['cv'],
                    "AvatarFileName" =>$nomImage,
                    "AvatarEncodedBase64FileContent" =>$avatar64
                ];
                $resAvatar = fonctionCRM::saveAvatar($dataavatar);
                print_r($resAvatar);
                //echo '<section class="alert alert-success">Votre photo a bien &eacute;t&eacute; modifi&eacute;e ! </section>';
                $_SESSION['avatar'] = $nomImage;
            }else{
                echo  '<section class="alert alert-warning">Votre fichier n\'est pas une image </section>';
            }
        }
    }

    if(isset($_POST['submit_documents'])){
        $cv = $_FILES["cv"];
        $uploaddir = get_stylesheet_directory().'/assets/cvCRM/';
        if($cv["name"] == ""){
            $error = "Merci de bien vouloir joindre votre CV.";
        }else{
            $uploadfile = $uploaddir . basename(htmlentities($cv['name'], ENT_QUOTES, "UTF-8"));
            if($cv["name"] != ""){
                move_uploaded_file($cv['tmp_name'], $uploadfile);

                $dataInFile = file_get_contents($uploadfile);

                $cv64 = base64_encode($dataInFile);
//                $tab = array(2);
                $data = ["CompanyId"=>2,"AnnouceId"=>null,"FileName"=>$cv["name"],"EncodedBase64FileContent" =>$cv64];
                $data_string = json_encode($data);
                $objetCandidat = fonctionCRM::majCv($data_string);
                echo 'candidat: ';
                print_r($objetCandidat);

                $_SESSION['cv'] = $cv['name'];
            }	
        }	
    }
/********************* Fin Compte ***********************/
?>
<script>
    // Connexion menu
    var session = '<?= isset($_SESSION['id'])? $_SESSION['id']:""; ?>';
    if(session == ""){ $("li.deconnexion-menu").css("display", "none"); }
</script>
<div class="wrap fond-bois">
    <div id="primary" class="content-area">
        <main id="main" class="site-main liste-offres-tmp" role="main">
            <!--*************** Content Wordpress from admin ******************/-->
            <?php
                get_template_part( 'template-parts/post/content', get_post_format() );    // ajouter contenu inséré en admin
            ?>
            <!--*************** Fin Content Wordpress from admin ******************/-->
            
            <!--*************** connexion / inscription ******************/-->
            <?php if(empty($_SESSION) == true){ ?>
                <section class="page col-lg-12" id="main-wrapper">
                <br/>
                <?php
                    get_template_part( 'template-parts/compte/connexion', get_post_format() );
                    get_template_part( 'template-parts/compte/inscription', get_post_format() );
                ?>
                </section>
                <!--*************** Fin connexion / inscription ******************/-->
            <?php }elseif($_SESSION['id'] != ""){ ?>
                <!--*************** Compte ******************/-->
                <div id="main-wrapper">
            <?php
                get_template_part( 'template-parts/compte/compte', get_post_format() );
            }elseif($_SESSION['id'] != "" && $connexion_annonce != ""){
                //get_template_part( 'template-parts/offres/details-offre', get_post_format() );
            } ?>
            </div>
            <!--*************** Fin Compte ******************/-->
        </main>
    </div>
</div>
<?php
    get_footer();
?>