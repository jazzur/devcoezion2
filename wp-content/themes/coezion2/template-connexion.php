<?php
/*
Template Name: Connexion
*/
if(isset($_GET['annonce'])){
	$connexion_annonce = $_GET['annonce'];
}
if(isset($_SESSION['id']) != ""){
	echo "session vide";
	//header("Location: http://dev-wordp.qualis-tt.fr/mon-compte/");
}

$error = false;
if(isset($_POST['connexion'])){
	
	$mail = htmlentities($_POST['mail']);	
	$mdp = htmlentities($_POST['mdp']);
	
	$data = ["Email"=>$mail,"Password"=>$mdp];
	$data_string = json_encode($data);
	 // Appel et paramétrage de l'API
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
			header("Location: http://dev-wordp.qualis-tt.fr/mon-compte/");
		}
		if($_SESSION['id'] != "" && $connexion_annonce != ""){
			header("Location: http://dev-wordp.qualis-tt.fr/detail-annonce/?id=".$connexion_annonce);
		}
	}
} 
get_header();
?><div class="wrap fond-bois">

<section class="page col-lg-12">
	<section class="connexion_normal col-lg-8 col-lg-push-2">
		<h1>Connectez vous et gérer vos candidatures </h1>
		<hr/>
		<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_connexion col-lg-10" enctype="multipart/form-data" >	
			<section class="col-lg-7">		
				<label for="mail">Email </label>		
				<input type="email" name="mail" id="mail" class="form-control" value="azur.mathieu@gmail.com" />	
			</section>
			<section class="col-lg-6">
				<label for="mdp">Mot de passe </label>
				<input type="text" name="mdp" id="mdp" class="form-control"  value="ok" />
			</section>
			<section class="col-lg-12 submit_form">	<br/>							
				<input type="submit" name="connexion" class="submit_profil btn btn-primary" value="Connexion" />			
			</section>		
			<section class="col-lg-12">
				<a href="http://dev-wordp.qualis-tt.fr/inscription">Vous n'êtes pas encore inscrit ?</a>
			</section>
		</form>
		<?php
		if(isset($error)){ ?>
			<section class="col-xs-12 col-sm-6  col-md-5 col-lg-4 alert-warning">
				<?=$error; ?>
			</section>
		<?php } ?>
	</section>
	<section class="col-xs-12 col-sm-6  col-md-5 col-lg-4">
			<p>Connectez vous avec vos comptes sociaux</p>
	
		 <?php do_action( 'wordpress_social_login' ); ?> 
		 <p>Aucune information ne sera partagée sans votre consentement</p>
	</section>
</section>
<section class="espace">
</section>



<?php 
get_footer(); 
?>