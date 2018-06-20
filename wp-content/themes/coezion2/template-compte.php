<?php
/*
Template Name: Compte
*/

if(isset($_SESSION['id']) == 0){
//	header('Location: http://dev-wordp.qualis-tt.fr/');
}
get_header();
if(isset($_POST['avatar_sub'])){
	if(!empty($_FILES['avatar'])){
			
		$image = $_FILES['avatar'];
		$extension = strtolower(substr($image['name'],-3));
		$nomImage = $_SESSION['id'].$image['name'];
		
		$allow_extension = array("jpg", "png");
		$adresse_avatar = get_stylesheet_directory().'/image/'.$nomImage;
		$adresse_avatar_min = get_stylesheet_directory().'/image/miniature';
		
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
			
			// var_dump($resAvatar);
			echo '<section class="alert alert-success">Votre photo a bien été modifiée ! </section>';
			$_SESSION['avatar'] = $nomImage;
			// $session->set('avatar', $nomImage);
			// header('Refresh:3; URL=http://dev-wordp.qualis-tt.fr/mon-compte');

		}else{
			echo  '<section class="alert alert-warning">Votre fichier n\'est pas une image </section>';
		}
	}
}
$experiences = fonctionCRM::getExperiences();		
	// var_dump($experiences);

if(isset($_POST['modifier_coord'])){
	$datacoordonnees = [
		'Id' => $_SESSION['id'],
		'Civility' => $_POST['civilite'],
		'FirstName'=> $_POST['prenom'],
		'LastName' => $_POST['nom'],
		'Email' =>	$_POST['mail'],
		'Password' => $_POST['mdp'],
		'Address' =>  $_POST['adresse'],
		'City' => $_POST['ville'],
		'Mobile' => $_POST['mobile'],
		'PostalCode' => $_POST['cp'],
		'Disponibility' => $_POST['dispo'],
		'Competencies' => $_POST['competence'],
		'Announces' => $_SESSION['annonce'],
		'WantedSalary' => $_POST['salaire'],
		'ExperienceYears' => $_POST['expe'],
		'CVFileName' => $_SESSION['cv'],
		'AvatarFileName' => $_SESSION['avatar'],
		"AvatarEncodedBase64FileContent" => $_SESSION['avatarcode']
	];
	// var_dump($datacoordonnees);
	$resAvatar = fonctionCRM::saveAvatar($datacoordonnees);

}

// var_dump($_SESSION);
?>

<section class="menu_gauche col-lg-3">	
	<ul>	
		<li><a href="#coordonnees" class="lien_coord">Mes coordonnées</a></li>		
		<!--<li><a href="#documents" class="lien_docu">Mes documents</a></li>	-->	
		<li><a href="#offres" class="lien_offre">Mes offres</a></li>		
		<li><a href="#candidatures" class="lien_candidature">Mes candidatures</a></li>	
	</ul>
</section>
<section class="contenu_profil col-xs-12 col-sm-12 col-md-12 col-lg-7 col-lg-push-1">	
	<h2>Bonjour <?=$_SESSION['civil']." ".ucfirst(strtolower($_SESSION['nom']));?></h2>	
	<section class="interf_coord">		
		<section class="col-lg-12">			
			<h3 class="menu_profil">Mes coordonnées</h3>		
		</section>		<br/>	
		
		<section class="avatar col-xs-3 col-xs-push-1 col-sm-5 col-md-push-1 col-md-5 col-lg-3">
			<section class="avatar_profil">
				<?php
				if($_SESSION['avatar']){ ?>
					<img src="<?=get_stylesheet_directory_uri().'/image/miniature/'.$_SESSION['avatar'];?>" alt="avatar profil" class="img-responsive mon_avatar" />
				<?php 
				}else{?>
					<img src="<?=get_stylesheet_directory_uri().'/image/miniature/avatar.png';?>" alt="avatar profil" class="img-responsive mon_avatar" />
				<?php } ?>
			<!--<section></section>-->
				<span  class="icon_modif_avatar"><img src="<?=get_stylesheet_directory_uri().'/image/modif-avatar.png';?>" /><br/>Modifier</span>
			
			</section>
			
			<section class="modifavatar">
				<form action="#" method="post" class="form_avatar" enctype="multipart/form-data">
					<input type="file" name="avatar" class="bouton_file"  />
					<input type="submit" name="avatar_sub" class="avatar_sub" value="Modifier avatar" />
				</form>
			</section>
			<section style="clear:both;margin-bottom:2%;"></section>
		</section>
		
		<section class="presentation_profil col-xs-12 col-sm-5 col-md-5 col-md-push-1 col-lg-push-1 col-lg-7">						
			<ul class="coordonnees">							
				<li><strong>Adresse :</strong><?=$_SESSION['addresse']; ?></li>				
				<li><strong>Code Postal et ville :</strong> <?=$_SESSION['cp']; ?> | <?=$_SESSION['ville']; ?></li>				
				<li><strong>Mail :</strong> <?=$_SESSION['mail']; ?></li>			
			</ul>			
			<section class="dispo">				
				<strong>Disponibilité :</strong> <?=$_SESSION['dispo']; ?>		
				<br/><span class="modifier">Modifier mes coordonnées</span>
			</section>		
		</section>			
		
		<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" class="form_modifcoord col-xs-12 col-sm-5 col-md-5 col-lg-10">
			<section class="col-lg-12">
				<label for="civ">Civilité</label>
				<select id="civ" class="form-control" name="civilite">
					<option value="M" selected>Homme</option>
					<option value="Mme">Femme</option>	
				</select>			
			</section>	
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
				<label for="prenom">Prénom </label>
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
				<label for="competence">Compétences </label>
				<input type="text" name="competence" id="competence" class="form-control"  />
			</section>	
			<section class="col-lg-5 col-lg-push-1">	
				<label for="ville">Ville </label>			
				<input type="text" name="ville" id="ville" class="form-control" value="<?=$_SESSION['ville']; ?>"  />
			</section>
					
			<section class="col-lg-5">								
				<label for="salaire">Salaire souhaité (K)</label>							
				<input type="text" name="salaire" id="salaire" class="form-control" value="<?=$_SESSION['salaire']; ?>"/>			
			</section>
			<section class="col-lg-5">	
				<label for="mobile">Téléphone </label>			
				<input type="text" name="mobile" id="mobile" class="form-control"  value="<?=$_SESSION['mobile']; ?>" />
			</section>
			<section class="col-lg-5 col-lg-push-1">	
				<label for="mail">E-mail </label>			
				<input type="mail" name="mail" id="mail" class="form-control"  value="<?=$_SESSION['mail']; ?>" />
			</section>
			<section class="col-lg-11">				
				<label for="dispo">Disponibilité </label>			
				<input type="date" name="dispo" id="dispo" class="form-control"  value="<?=$_SESSION['dispo']; ?>" />
			</section>
			<section class="col-lg-5 col-lg-push-1">								
				<label for="expe">Expérience</label>							
				<select id="expe" name="expe"  class="form-control" >
					<option value="<?=$_SESSION['expe'];?>"><?=$_SESSION['expe'];?></option>
					<?php
					for($i=0;$i<count($experiences);$i++){ ?>
						<option value="<?=$experiences[$i]->Name;?>"><?=$experiences[$i]->Name;?></option>
						<?php 
					} ?>
				</select>
			</section>
			<section class="col-lg-12 submit_form">				
				<input type="submit" name="modifier_coord" class="submit_profil btn btn-primary" value="Modifier" />
			</section>
		</form>
		<form>
			<section class="col-lg-12"><h4>Mettez à jour votre cv</h4> 
				<table class="table-hover table_profil">			
					<tr>				
						<td>Votre CV</td>				
						<td><?=$_SESSION['cv'];?></td>				
						<td><a href="">Supprimer</a> | <a href="http://dev-joomla.qualis-tt.fr/modules/mod_inscription_qualis_crm/CRMcv/<?=$_SESSION['cv']; ?>" target="_blank" >Voir</a></td>	
						<!--<td><a href="">Supprimer</a> | <a href="<?php//echo $_SERVER['REQUEST_URI'];?>?fichier=cv" >Voir</a></td>			-->		
					</tr>	
				</table>
			</section>	
			<section class="col-lg-12">
			<label for="cv">Selectionnez votre cv: </label>			
			<input type="file" name="cv" id="cv"><br/>
				</section>
			<input type="submit" value="Télécharger documents" name="submit_documents" class="submit_profil btn btn-primary" />							
		</form>	
	</section>	
	

	<section class="interf_offres">		
		<h3 class="menu_profil">Liste de vos candidatures</h3>		
		<table class="table-hover table_profil">			
			
			<tr>				
				<th>Intitulé du poste</th>				
				<th>Expérience souahitée</th>				
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
				<td><td><a href="http://dev-wordp.qualis-tt.fr/detail-annonce?id=<?=$_SESSION['annonce'][$i]->AnnouceId;?>">détails</a></td>
			</tr>
			<?php } ?>
		</table>		
		<h3>Ou si aucune préférences</h3>		
		<section class="col-lg-12">
			<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_preference">			
				<section class="col-lg-6">
					<label for="poste">Nom de poste</label>			
					<input id="poste" name="poste" class="form-control" type="text" />
				</section>
				<section class="col-lg-6">
					<label for="salaire">Salaire souhaité</label>			
					<input id="salaire" class="form-control" name="salaire" type="text" />
				</section>
				<section class="col-lg-6">				
					<label for="niveau">Niveau recherché</label>			
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
					<input name="submit_preference" type="submit" value="Enregistrer préférence" class="submit_profil btn btn-primary" />
				</section>
			</form>
		</section>
	</section>
	
	<section class="interf_candidature">	
		<h3 class="menu_profil">Mes candidatures</h3>	
		<table class="table-hover table_profil">			
			<tr>				
				<th>Intitulé du poste</th>				
				<th>Domaine d'activité</th>				
				<th>Expérience souahitée</th>				
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
				<td><td><a href="http://dev-wordp.qualis-tt.fr/detail-annonce?id=<?=$_SESSION['annonce'][$i]->AnnouceId;?>">détails</a></td>
			</tr>
			<?php } ?>
		</table>		
		<h3>Ou</h3>		
		<span class="postuler_candidature_lien">Aucune candidature en cours, <strong><a href="http://dev-wordp.qualis-tt.fr/nos-offres/">postuler ?</a></strong>	</span>
	</section>
</section>
<?php get_footer(); ?>