$(document).ready(function(){
	console.log("ok2");
	$("#categorie").change(function(){
		jQuery.post(
			ajaxurl,{
				'action': 'mon_action',
				'param': 'coucou'
			},
			function(response){
				console.log(response);
			}
		);
	});
});