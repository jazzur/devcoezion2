<?php
/*
Template Name: Compte
*/

get_header();
if(isset($_POST['avatar_sub'])){
    if(!empty($_FILES['avatar'])){

        $image = $_FILES['avatar'];
        $extension = strtolower(substr($image['name'],-3));
        $nomImage = $_SESSION['id'].$image['name'];

        $allow_extension = array("jpg", "png");
        $adresse_avatar = get_stylesheet_directory().'/assets/images/profile/image/'.$nomImage;
        $adresse_avatar_min = get_stylesheet_directory().'/assets/images/profile/image/miniature';

        if(in_array($extension, $allow_extension)){
            move_uploaded_file($image['tmp_name'],$adresse_avatar);

            Img::creerMin($adresse_avatar, $adresse_avatar_min ,$nomImage,145, 145 );
            Img::convertirJPG($adresse_avatar);

            $dataInFile = file_get_contents($adresse_avatar);
            $avatar64 = base64_encode($dataInFile);
            // echo $avatar64;
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
            // var_dump($dataavatar);
            $resAvatar = fonctionCRM::saveAvatar($dataavatar);
                    //print_r(json_encode($dataavatar));
            // var_dump($resAvatar);
            echo '<section class="alert alert-success">Votre photo a bien &eacute;t&eacute; modifi&eacute;e ! </section>';
            $_SESSION['avatar'] = $nomImage;
            // $session->set('avatar', $nomImage);
            // header('Refresh:3; URL=http://dev-wordp.qualis-tt.fr/mon-compte');

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
            $tab = array(2);
            //echo $cv["name"];
            //exit(0);
            $data = ["CompanyId"=>2,"AnnouceId"=>null,"FileName"=>$cv["name"],"EncodedBase64FileContent" =>$cv64];
            $data_string = json_encode($data);
            $objetCandidat = fonctionCRM::majCv($data_string);
            print_r($objetCandidat);
            
            $_SESSION['cv'] = $cv['name'];
        }	
    }	
}

?>
<div id="main-wrapper">
    <section class="menu_gauche col-lg-3">	
    	<ul>	
            <li><a href="#coordonnees" class="lien_coord">Mes coordonn&eacute;es</a></li>		
            <!--<li><a href="#documents" class="lien_docu">Mes documents</a></li>	-->	
            <li><a href="#offres" class="lien_offre">Mes offres</a></li>		
            <li><a href="#candidatures" class="lien_candidature">Mes candidatures</a></li>	
    	</ul>
    </section>
    <section class="contenu_profil col-xs-12 col-sm-12 col-md-12 col-lg-7 col-lg-push-1">	
    	<h2>Bonjour <?=$_SESSION['civil']." ".ucfirst(strtolower($_SESSION['nom']));?></h2>	
    	<section class="interf_coord">
            <section class="avatar col-xs-3 col-xs-push-1 col-sm-5 col-md-push-1 col-md-5 col-lg-3">
                    <section class="avatar_profil">
                            <?php
                            if($_SESSION['avatar']){ ?>
                                    <img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/image/miniature/'.$_SESSION['avatar'];?>" alt="avatar profil" class="img-responsive mon_avatar" />
                            <?php 
                            }else{?>
                                    <img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/avatar.png';?>" alt="avatar profil" class="img-responsive mon_avatar" />
                            <?php } ?>
                    <!--<section></section>-->
                            <span  class="icon_modif_avatar"><img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/modif-avatar.png';?>" /><br/>Modifier</span>

                    </section>

                    <section class="modifavatar2">
                        <form action="#" method="post" class="form_avatar" enctype="multipart/form-data">
                            <input type="file" name="avatar" class="bouton_file2" id="avatar_file" />
                            <input type="submit" name="avatar_sub" id="avatar_sub" class="avatar_sub2" value="Modifier avatar" />
                            <span class='save-message avatar'></span>
                        </form>
                    </section>
    		</section>
    		
    		<section class="presentation_profil col-xs-12 col-sm-5 col-md-5 col-md-push-1 col-lg-push-1 col-lg-7">						
    			<ul class="coordonnees">							
    				<li><strong>Adresse :</strong><?= $_SESSION['addresse']; ?></li>				
    				<li><strong>Code Postal et ville :</strong> <?=$_SESSION['cp']; ?> | <?=$_SESSION['ville']; ?></li>				
    				<li><strong>Mail :</strong> <?=$_SESSION['mail']; ?></li>
    				<li><strong>Disponibilit&eacute; :</strong> <?php $date = new DateTime($_SESSION['dispo']); echo $date->format('Y-m-d'); ?></srong></li>		
					<li><span class="modifier">Modifier mes coordonn&eacute;es</span></li>
    			</ul>			
    			<section class="dispo">				
    			</section>		
    		</section>			
            
			<section class="col-lg-12 modif-coordonnees">
<!--         		<form action="<?php //$_SERVER['REQUEST_URI'];?>" method="post" class="form_modifcoord col-xs-12 col-sm-5 col-md-5 col-lg-10"> -->
    				<label for="civ">Civilit&eacute;</label>
    				<select id="civ" class="form-control" name="civilite">
    					<option value="M." selected>Homme</option>
    					<option value="Mme">Femme</option>	
    				</select>			
        			<section class="col-lg-5">	
        				<label for="mdp">mdp </label>			
        				<input type="text" name="mdp" id="mdp" value="<?=$_SESSION['mdp']; ?>" class="form-control" />
        			</section>	
        			<section class="col-lg-5">	
        				<label for="cv">cv </label>			
        				<input type="text" name="cv" id="cv" value="<?=$_SESSION['cv']; ?>" class="form-control" />
        			</section>	
        			<section class="col-lg-5">	
        				<label for="nom">Nom </label>			
        				<input type="text" name="nom" id="nom" value="<?=$_SESSION['nom']; ?>" class="form-control" />
        			</section>
        			<section class="col-lg-5 col-lg-push-1">	
        				<label for="prenom">Pr&eacute;nom </label>
        				<input type="text" name="prenom" id="prenom"   value="<?=$_SESSION['prenom']; ?>" class="form-control" />
        			</section>
        			<section class="col-lg-11">	
        				<label for="adresse">Adresse</label>			
        				<input name="adresse" id="adresse" class="form-control" value="<?=$_SESSION['addresse'];?>" />
        			</section>
        			<section class="col-lg-5">	
        				<label for="cp">Code Postal </label>
        				<input type="text" name="cp" id="cp" class="form-control" value="<?=$_SESSION['cp']; ?>" />	
        			</section>
        			<section class="col-lg-11">							
        				<label for="competence">Comp&eacute;tences </label>
        				<input type="text" name="competence" id="competence" class="form-control" value="<?= implode(",", $_SESSION['competence']) ?>" />
        			</section>	
        			<section class="col-lg-5">	
        				<label for="ville">Ville </label>			
        				<input type="text" name="ville" id="ville" class="form-control" value="<?=$_SESSION['ville']; ?>"  />
        			</section>
        			<section class="col-lg-5 col-lg-push-1">								
        				<label for="salaire">Salaire souhait&eacute; (K)</label>							
        				<input type="text" name="salaire" id="salaire" class="form-control" value="<?=$_SESSION['salaire']; ?>"/>			
        			</section>
        			<section class="col-lg-5">	
        				<label for="mobile">T&eacute;l&eacute;phone </label>			
        				<input type="text" name="mobile" id="mobile" class="form-control"  value="<?=$_SESSION['mobile']; ?>" />
        			</section>
        			<section class="col-lg-5 col-lg-push-1">	
        				<label for="mail">E-mail </label>			
        				<input type="mail" name="mail" id="mail" class="form-control"  value="<?=$_SESSION['mail']; ?>" />
        			</section>
        			<section class="col-lg-11">				
        				<label for="dispo">Disponibilit&eacute; </label>			
        				<input type="date" name="dispo" id="dispo" class="form-control"  value="<?php $date = new DateTime($_SESSION['dispo']); echo $date->format('Y-m-d'); ?>" />
        			</section>
        			<section class="col-lg-5 col-lg-push-1">								
        				<label for="expe">Exp&eacute;rience</label>							
        				<select id="expe" name="expe"  class="form-control" >
        					<option value="<?=$_SESSION['expe'];?>"><?=$_SESSION['expe'];?></option>
        					<?php
        					for($i=0;$i<count($experiences);$i++){ ?>
        						<option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
        						<?php 
        					}
        					?>
        				</select>
        			</section>
        			<section class="col-lg-12 submit_form">				
        				<input type="submit" name="modifier_coord" id="modifier_coord" class="btn btn-primary" value="Modifier" />
                                        <span class='save-message coordonnees'></span>
        				<img src="<?= get_stylesheet_directory_uri().'/assets/images/waiting.gif' ?>" alt="waiting..." class="waiting-gif coordonnees"/>
                                </section>
	    		<!-- </form>-->
			</section>
			<section class="col-lg-6"><h4>Mettez à jour votre cv</h4> 
    			<section class="col-lg-12">
    				<table class="table-hover table_profil">			
    					<tr>				
    						<td>Votre CV</td>				
    						<td><?=$_SESSION['cv'];?></td>				
    						<td><a href="">Supprimer</a> | <a href="<?=get_stylesheet_directory_uri().'/assets/cvCRM/'. $_SESSION['cv']; ?>" target="_blank" >Voir</a></td>	
    						<!--<td><a href="">Supprimer</a> | <a href="<?php//echo $_SERVER['REQUEST_URI'];?>?fichier=cv" >Voir</a></td>			-->		
    					</tr>	
    				</table>
    			</section>
    			
			<section class="col-lg-12">
				<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" class="form_telcv col-xs-12 col-sm-5 col-md-5 col-lg-10" enctype="multipart/form-data" >
					<label for="cv">Selectionnez votre cv: </label>
					<input type="file" name="cv" id="cv"><br/>
					<input type="submit" value="T&eacute;l&eacute;charger cv" name="submit_documents" class="submit_profil btn btn-primary" />							
				</form>	
			</section>

    	
            
            
    
    	<section class="interf_offres">
    		<section class="col-lg-12">
        		<h3 class="menu_profil">Liste de vos candidatures</h3>		
        		<table class="table-hover table_profil">			
        			
        			<tr>				
        				<th>Intitul&eacute; du poste</th>				
        				<th>Exp&eacute;rience souahit&eacute;e</th>				
        				<th>Date</th>				
        				<th>Ville</th>				
        				<th></th>			
        			</tr>
        			<?php
        			for($i=0;$i<count($_SESSION['annonce']);$i++){ 
            			$dateEn = explode('T', $_SESSION['annonce'][$i]->Date);
            			$dateFr = explode('-', $dateEn[0]);
        			?>
        			<tr>
        				<td><?=$_SESSION['annonce'][$i]->Title;?></td>
        				<td><?=$_SESSION['annonce'][$i]->Experience;?></td>
        				<!--<td><?//=$dateFr[2] .'-'. $dateFr[1] .'-'. $dateFr[0];?></td>-->
        				<td><?=$_SESSION['annonce'][$i]->Date;?></td>
        				<td><?=$_SESSION['annonce'][$i]->Place;?></td>
        				<td><td><a href="http://dev-wordp.qualis-tt.fr/detail-annonce?id=<?=$_SESSION['annonce'][$i]->AnnouceId;?>">d&eacute;tails</a></td>
        			</tr>
        			<?php } ?>
        		</table>		
        		<h3>Ou si aucune pr&eacute;f&eacute;rences</h3>		
			</section>
    		<section class="col-lg-12">
    			<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_preference">			
    				<section class="col-lg-6">
    					<label for="poste">Nom de poste</label>			
    					<input id="poste" name="poste" class="form-control" type="text" />
    				</section>
    				<section class="col-lg-6 ">
    					<label for="salaire">Salaire souhait&eacute;</label>			
    					<input id="salaire" class="form-control" name="salaire" type="text" />
    				</section>
    				<section class="col-lg-6">				
    					<label for="niveau">Niveau recherch&eacute;</label>			
    					<select id="niveau" name="expe"  class="form-control" >
    					<?php
    					for($i=0;$i<count($experiences);$i++){ ?>
    						<option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
    						<?php 
    					} ?>
    				</select>
    				</section>
    				<section class="col-lg-6">
    					<label for="departement">Où</label>			
    					<input id="departement" name="departement" class="form-control" type="text" />
    				</section>
    				<section class="col-lg-12">				
    					<input name="submit_preference" type="submit" value="Enregistrer pr&eacute;f&eacute;rence" class="btn btn-primary" />
    				</section>
    			</form>
    		</section>
    	</section>
    	
    	<section class="interf_candidature col-lg-12">
    		
    		<h3 class="menu_profil">Mes candidatures</h3>	
    		<table class="table-hover table_profil">			
    			<tr>				
    				<th>Intitul&eacute; du poste</th>				
    				<th>Domaine d'activit&eacute;</th>				
    				<th>Exp&eacute;rience souahit&eacute;e</th>				
    				<th>Date</th>				
    				<th>Ville</th>				
    				<th>Suivi</th>			
    			</tr>			
    			<?php
    			for($i=0;$i<count($_SESSION['annonce']);$i++){ 
    			$dateEn = explode('T', $_SESSION['annonce'][$i]->Date);
    			$dateFr = explode('-', $dateEn[0]);
    			?>
    			<tr>
    				<td><?=$_SESSION['annonce'][$i]->Title;?></td>
    				<td>Informatique</td>
    				<td><?=$_SESSION['annonce'][$i]->Experience;?></td>
    				<td><?=$_SESSION['annonce'][$i]->Date;?></td>
    				<td><?=$_SESSION['annonce'][$i]->Place;?></td>
    				<td>Suivi</td>
    				<td><td><a href="http://dev-wordp.qualis-tt.fr/detail-annonce?id=<?=$_SESSION['annonce'][$i]->AnnouceId;?>">d&eacute;tails</a></td>
    			</tr>
    			<?php } ?>
    		</table>		
    		<h3>Ou</h3>		
    		<span class="postuler_candidature_lien">Aucune candidature en cours, <strong><a href="http://dev-wordp.qualis-tt.fr/nos-offres/">postuler ?</a></strong>	</span>
    	</section>
    </section>
</div>

<?php get_footer(); ?>