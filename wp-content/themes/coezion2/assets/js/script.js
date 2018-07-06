var $ = jQuery;
$(document).ready(function(){
    // --------------------------- Update Avatar
    /**$("input#avatar_sub").click(function(){
        var modifAvatar = $("input.bouton_file2:file");

        //if(modifAvatar.val() != ""){
            var nomImage = modifAvatar.val().split('\\');
            var message = "";
            var messageBlock = $(".save-message.avatar");
            var modifierAvatarButton = $("input#avatar_sub");
            var waitingGif = $("img.waiting-gif.avatar");
            //var formData = new FormData($("#avatar_file").get(0));

var file_data = $("#avatar_file");
//var form_data = new FormData(file_data);
//form_data.append("file_data", file_data[0].files[0]);

            /*var dataAvatar = {
                "AvatarFileName":nomImage[2],
                //"AvatarEncodedBase64FileContent":avatar64,
                "avatar": file_data[0].files[0],
                "action": "set_user_avatar"
            };*/
            /*var dataa = {
                "action":"set_user_avatar",
                "test":152
            };
            
            modifierAvatarButton.css("display", "none");
            messageBlock.css("display", "none");
            waitingGif.css("display", "block");
            
            /*$.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                method: 'POST',
                //data: JSON.stringify(dataa),
                processData: false,
                //cache: false,
                contentType: "application/json; charset=utf-8",
                success: function(){
                    console.log("OKOKOK")
                },
                error: function(e){
                    console.log("Error: ", e)
                }
            })*/
            // Save avatar        
            /*$.post(ajax_object.ajax_url, dataa, function(response) {
                modifierAvatarButton.css("display", "block");
                messageBlock.css("display", "block");
                waitingGif.css("display", "none");
console.log("response: ", response)
                message = JSON.parse(response);
                message = message.ErrorMessage;
            }).fail(function(e){
                message = "error";
                console.log('Error', e);
            }).always(function(){
                messageBlock.html(message);
                var test = message.toLowerCase().replace(/[éèêë]/g,"e");
                messageBlock.addClass(test);
            });*/
            
        /*} else {
            console.log("Ajoutez un fichier")
        }
    });*/

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

    //-----------------Update CV
    /*var dataCV = "";// a finir
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
    })*/
});