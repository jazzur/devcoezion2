var $ = jQuery;
$(document).ready(function(){
    //  Click to update coordonnees
    $("input#modifier_coord").click(function(){
        var message = "";
        var messageBlock = $(".save-message.coordonnees");
        var modifierCoordButton = $("input#modifier_coord");
        var waitingGif = $("img.waiting-gif.coordonnees");

        var datacoordonnees = {
            "Civility":$("#civ-coord")[0].value,
            "FirstName":$("#prenom-coord")[0].value,
            "LastName":$("#nom-coord")[0].value,
            "Email":$("#mail-coord")[0].value,
            "Password":$("#mdp-coord")[0].value,
            "Address":$("#adresse-coord")[0].value,
            "City":$("#ville-coord")[0].value,
            "Mobile":$("#mobile-coord")[0].value,
            "PostalCode":$("#cp-coord")[0].value,
            "Disponibility":$("#dispo-coord")[0].value,
            "Competencies":$("#competence-coord")[0].value.split(","),
            "WantedSalary":$("#salaire-coord")[0].value,
            "ExperienceYears":$("#expe-coord")[0].value,
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