function menuBurger() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
$(document).ready(function(){
	
	
	/*if($("#reussi")) {
		if($("#reussi").length == 1){
			$("#formulaire_projet").css("display","none");
			setTimeout(function () {
				window.location.href = "http://djidji.biz/profil/"; //will redirect to your blog page (an ex: blog.html)
			}, 2000); //will call the function after 2 secs.

		}
	}
	$(".bouton_menu").click(function(){
		$("nav ul").toggleClass("show_menu");
	});
	$(".projet_entrepreneurs").click(function(){
		window.location.replace("http://djidji.biz/soumettez-votre-projet/");
		// alert("ok");
	});
	$(".contact_entrepreneur").click(function(){
		window.location.replace("https://www.djidji.biz/contact/");
	});
	
	$("#categorie").change(function(){
		jQuery.post(
			ajaxurl,{
				'action': 'affiche_categorie_prof',
				'param': $("#categorie").val()
			},
			function(response){
				// console.log(response);
				$('.somewhere').empty();
				$('.somewhere').append(response);
			}
		);
	});
	
	$(".tab_projet").click(function(){
		// jQuery.post(
			// ajaxurl,{
				// 'action': 'utilisateur',
				// 'resultat': $(".envoi_user_profil").val()
			// },
			// function(response){
				console.log("test");
				// $('.somewhereelse').empty();
				// $('.somewhereelse').append(response);
			// }
		// );
	});


	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-106062748-1', 'auto');
	  ga('send', 'pageview');
	  
	  
	$('a.poplight[href^=#]').click(function() {
		console.log("ouvre");
	var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
	var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

	//Récupérer les variables depuis le lien
	var query= popURL.split('?');
	var dim= query[1].split('&amp;');
	var popWidth = dim[0].split('=')[1]; //La première valeur du lien

	//Faire apparaitre la pop-up et ajouter le bouton de fermeture
	$('#' + popID).fadeIn().css({
		'width': Number(popWidth)
	})
	.prepend('Fermer <img src="https://www.djidji.biz/wp-content/uploads/2017/09/fermer.png" alt="fermer fenêtre" class="fermer_deco" />');

	//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
	var popMargTop = ($('#' + popID).height() + 80) / 2;
	var popMargLeft = ($('#' + popID).width() + 80) / 2;

	//On affecte le margin
	$('#' + popID).css({
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});

	//Effet fade-in du fond opaque
	$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
	//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

	return false;
});

//Close Popups and Fade Layer
	$('body').on('click', '.fermer_deco, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block, .fermer_deco').fadeOut(function() {
			window.location.replace("https://www.djidji.biz/deconnexion/");  
	}); //...ils disparaissent ensemble
		
		return false;
	});*/
	
});
	
