<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>
			<?php bloginfo('name') ?>
			<?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?>
			<?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?>
			<?php else : ?>
			<?php wp_title() ?>
			<?php endif ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
		<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats  
		<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" /> 
		<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" /> 
		<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" /> 
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" >
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			window.addEventListener("load", function(){window.cookieconsent.initialise({  
			"palette": {    
				"popup": {      "background": "#000"    },    
				"button": {      "background": "#f1d600"    }  
			},  
			"content": {    
				"message": "Ce site Web utilise des cookies pour assurer que vous obtenez la meilleure expérience sur notre site Web",    
				"dismiss": "Ok",    "link": "En savoir plus",	"href":""  
			}
			})});
		</script>
		<?php wp_head(); ?>   
		<?php wp_get_archives('type=monthly&format=link'); ?>   
	</head> 
	<body>
	
	<section class="entete">
		<div class="imagetop">
			<a href="index.php"><img src="<?php bloginfo('template_url'); ?>/images/logo_coezion.jpg" alt="logo de Coezion" class="logo img-responsive"/></a>
		</div>
		
		<div class="topnav" id="myTopnav">
			<a href="index.php" class="">Accueil</a>
			<a href="#news">Nos prestations</a>
			<div class="dropdown">
				<button class="dropbtn">Nos valeurs 
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="nos-valeurs.php">Nos valeurs</a>
					<a href ="societe-responsable.php">Une société responsable</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Espace recrutement</span> 
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="espace-recrutement.php">Postuler</a>
					<a href="co-optation.php">Répondre aux offres</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Cooptation
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="espace-recrutement.php"><a href="poster-ingenieur.php">Coopter un candidat</a></a>
					<a href="poster-coop.php">Déposer une offre</a>
				</div>
			</div>
			<a href="#contact">Contact</a>
			
			<section>
				<?php
				$user = wp_get_current_user();
				if($user->ID == 0){
					?>
					<a href="https://www.djidji.biz/se-connecter/">Connexion</a>
					<a href="https://www.djidji.biz/inscription">Inscription</a>
				<?php }else{?>
					<a href="https://www.djidji.biz/profil">Votre profil</a>
					<a href="#?w=800" rel="popup_name" class="poplight">Se déconnecter</a>
					<?php 
				}?>
			</section>
			<a href="javascript:void(0);" style="font-size:15px;" class="icon_burger" onclick="menuBurger()">&#9776;</a>
		</div>
		
	</section>
	
	
	<!--	<nav class="menu">
			<section class="bouton_menu">
				<img src="https://www.djidji.biz/wp-content/uploads/2017/09/menu-burg.png" alt="bouton menu" width="50px" />MENU
			</section>
		
		</nav>-->
		<div id="popup_name" class="popup_block" style="display:none">
			<section class="message_deco">
				<section class="premier mess"><center><h1>Vous êtes déconnecté</h1></center></section>
				<section class="deuxieme mess"><center><h2>À bientôt sur Qualis</h2></center></section>
				<section class="troisième mess"><h3></h3></section>
			</section>
		</div>
		
	<main id="page" class="col-xs-12 col-sm-12  col-md-12 col-lg-12">
			