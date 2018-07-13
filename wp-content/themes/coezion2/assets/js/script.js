var $ = jQuery;
$(document).ready(function(){
    // ------------------------------- Click to update coordonnees
    $("input#modifier_coord").click(function(){
        var message = "";
        var messageBlock = $(".save-message.coordonnees");
        var modifierCoordButton = $("input#modifier_coord");
        var waitingGif = $("img.waiting-gif.coordonnees");

        var datacoordonnees = {
            "Civility":$("#civ")[0].value,
            "FirstName":$("#prenom")[0].value,
            "LastName":$("#nom")[0].value,
            "Email":$("#mail")[0].value,
            "Password":$("#mdp")[0].value,
            "Address":$("#adresse")[0].value,
            "City":$("#ville")[0].value,
            "Mobile":$("#mobile")[0].value,
            "PostalCode":$("#cp")[0].value,
            "Disponibility":$("#dispo")[0].value,
            "Competencies":$("#competence")[0].value.split(","),
            "WantedSalary":$("#salaire")[0].value,
            "ExperienceYears":$("#expe")[0].value,
            "action": "set_user"
        };

        modifierCoordButton.css("display", "none");
        messageBlock.css("display", "none");
        waitingGif.css("display", "block");
        // SaveCandidate
        $.post(ajax_object.ajax_url, datacoordonnees, function(response) {
            modifierCoordButton.css("display", "block");
            messageBlock.css("display", "block");
            waitingGif.css("display", "none");

            message = JSON.parse(response);
            message = message.ErrorMessage;
        }).fail(function(e){
            message = "error";
            console.log('Error', e);
        }).always(function(){
            messageBlock.html(message);
            var test = message.toLowerCase().replace(/[éèêë]/g,"e");
            messageBlock.addClass(test);
        });
    });
});