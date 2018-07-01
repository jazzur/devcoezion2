<?php
/*
Template Name: Compte
*/
?>
<script>
	var $ = jQuery;
	$("#mail")[0].value = data.Email;
	if(<?php $_SESSION['mail'] ?> == $("#mdp")[0].value && <?php $_SESSION['mdp'] ?> == $("#mdp")[0].value){
    	$.ajax({
    		url: 'connectBDD.php',
    		data: '',
    		type: 'POST',
    		success: function(){
    			console.log('okok!!');
    		},
    		error: function(e){
    			console.log("Error: ", e);
    		}
    	})
	}
</script>
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
    					<img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/'.$_SESSION['avatar'];?>" alt="avatar profil" class="img-responsive mon_avatar" />
    				<?php 
    				}else{?>
    					<img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/avatar.png';?>" alt="avatar profil" class="img-responsive mon_avatar" />
    				<?php } ?>
    			<!--<section></section>-->
    				<span  class="icon_modif_avatar"><img src="<?=get_stylesheet_directory_uri().'/assets/images/profile/modif-avatar.png';?>" /><br/>Modifier</span>
    			
    			</section>
    			
    			<section class="modifavatar2">
					<input type="file" name="avatar" class="bouton_file2" />
					<input type="submit" name="avatar_sub" id="avatar_sub" class="avatar_sub2" value="Modifier avatar" />
    			</section>
    		</section>
    		
    		<section class="presentation_profil col-xs-12 col-sm-5 col-md-5 col-md-push-1 col-lg-push-1 col-lg-7">						
    			<ul class="coordonnees">							
    				<li><strong>Adresse :</strong><?=$_SESSION['addresse']; ?></li>				
    				<li><strong>Code Postal et ville :</strong> <?=$_SESSION['cp']; ?> | <?=$_SESSION['ville']; ?></li>				
    				<li><strong>Mail :</strong> <?=$_SESSION['mail']; ?></li>
    				<li><strong>Disponibilit&eacute; :</strong> <?php $date = new DateTime($_SESSION['dispo']); echo $date->format('Y-m-d'); ?></srong></li>		
					<li><span class="modifier">Modifier mes coordonn&eacute;es</span></li>
    			</ul>			
    			<section class="dispo">				
    			</section>		
    		</section>			
			<section class="col-lg-6">
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
        				<img src="<?= get_stylesheet_directory_uri().'/assets/images/waiting.gif' ?>" alt="waiting..." class="waiting-gif"/>
					</section>
	    		<!-- </form>-->
			</section>
			<section class="col-lg-6"><h4>Mettez à jour votre cv</h4> 
    			<section class="col-lg-12">
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
    			<input type="submit" value="T&eacute;l&eacute;charger documents" id="download-cv" name="submit_documents" class="btn btn-primary" />
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

<script>
	var $ = jQuery;
	$(document).ready(function(){
		
    	$("input#avatar_sub").click(function(){
    		var modifAvatar = $("input.bouton_file2:file");
console.log("modif", modifAvatar.val());    		
    		if(modifAvatar.val() != ""){
        		var nomImage = modifAvatar.val().split('\\');
				
        		$.ajax({
    			  url: modifAvatar[0].value,
    			  type: "GET",
    			  dataType: "binary",
    			  processData: false,
    			  success: function(result){
    				  console.log("result", result)
    			  }
    			});
        		
        		var dataavatar = {
        			"Id":<?= $_SESSION['id'] ?>,
    				"Civility":$("#civ")[0].value,
        			"FirstName":$("#prenom")[0].value,
        			"LastName":$("#nom")[0].value,
        			"Email":$("#mail")[0].value,
        			"Password":$("#mdp")[0].value,
        			"Address":$("#adresse")[0].value,
        			"City":$("#ville")[0].value,
        			"Mobile":$("#mobile")[0].value,
        			"PostalCode":$("#cp")[0].value,
        			"Disponibility":$("#dispo")[0].value || "2018-06-28",
        			"Competencies":$("#competence")[0].value.split(","),
        			"Announces":<?php print_r(json_encode(array_values($_SESSION["annonce"]))) ?>,
        			"WantedSalary":$("#salaire")[0].value,
        			"ExperienceYears":$("#expe")[0].value,
        			"CVFileName":"<?= $_SESSION["cv"] ?>",
        			"AvatarFileName":nomImage[2],
        			//"AvatarEncodedBase64FileContent":avatar64
        		};
    		} else {
				console.log("Ajoutez un fichier")
    		}
		});

        // Click to update coordonnees
    	$("input#modifier_coord").click(function(){        	
    		var datacoordonnees = {
    			"Id":<?= $_SESSION["id"] ?>,
    			"Civility":$("#civ")[0].value,
    			"FirstName":$("#prenom")[0].value,
    			"LastName":$("#nom")[0].value,
    			"Email":$("#mail")[0].value,
    			"Password":$("#mdp")[0].value,
    			"Address":$("#adresse")[0].value,
    			"City":$("#ville")[0].value,
    			"Mobile":$("#mobile")[0].value,
    			"PostalCode":$("#cp")[0].value,
    			"Disponibility":$("#dispo")[0].value || "2018-06-28",
    			"Competencies":$("#competence")[0].value.split(","),
    			"Announces":<?php print_r(json_encode(array_values($_SESSION["annonce"]))) ?>,
    			"WantedSalary":$("#salaire")[0].value,
    			"ExperienceYears":$("#expe")[0].value,
    			"CVFileName":"<?= $_SESSION["cv"] ?>",
    			"AvatarFileName":"<?= $_SESSION["avatar"] ?>",
    			"AvatarEncodedBase64FileContent":"<?= $_SESSION["avatarcode"] ?>" || null
    		};

    		var modifierCoordButton = $("input#modifier_coord");
    		var waitingGif = $("img.waiting-gif");
			// SaveCandidate
            $.ajax({
                url: "http://api.infolor.fr/api/CRM/SaveCandidate",
                type: "POST",
                data: datacoordonnees,
                dataType: "json",
                success: function(response){
					modifierCoordButton.css("display", "none");
					waitingGif.css("display", "block");
					
					var data_string = {"Email": "<?= $_SESSION['mail'] ?>","Password": "<?= $_SESSION['mdp'] ?>" }
					$.ajax({
						url: "http://api.infolor.fr/api/CRM/GetCandidateByLogin",
		                type: "POST",
		                data: data_string,
		                dataType: "json",
		                success: function(response2){
							//updateFields(response2);
							modifierCoordButton.css("display", "block");
							waitingGif.css("display", "none");
		                },
		                error: function(e){
		                    console.log("Erreur2: ", e);
		                }
					});
                },
                error: function(e){
                    console.log("Erreur: ", e);
                }
            });
    	});

/*    	function updateFields(data){
        	var date = data.Disponibility.split("T");

        	$("#civ")[0].value = data.Civility;
        	$("#prenom")[0].value = data.FirstName;
        	$("#nom")[0].value = data.LastName;
			$("#mail")[0].value = data.Email;
			$("#mdp")[0].value = data.Password;
			$("#adresse")[0].value = data.Address;
			$("#ville")[0].value = data.City;
			$("#mobile")[0].value = data.Mobile;
			$("#cp")[0].value = data.PostalCode;
			$("#dispo")[0].value = date[0];
			$("#competence")[0].value = data.Competencies;
			$("#salaire")[0].value = data.WantedSalary;
			$("#expe")[0].value = data.ExperienceYears;
    	}
*/
    	
		// Update CV
    	var dataCV = "";// a finir
    	$("input#download-cv").click(function(){
			$.ajax({
				url: "http://api.infolor.fr/api/CRM/UploadCV",
				type: POST, 
				data: dataCV,
				dataType: json,
				success: function(){

				},
				error: function(){

				}
			});
    	})
	});
</script>

<?php get_footer(); ?>