/* Liste des Offres */
<script>
    $ = jQuery;
    $(document).ready(function(){
        $.ajax({
            url: "http://api.infolor.fr/api/CRM/GetWebAnnouncesByCriteria",
            type: "POST",
            dataType: "Content-type: application/json",
            success: function(){
                console.log("OKOKOOK!!!")
            },
            error: function(){
                console.log("NOOOOOO!!!")
            }
        });
    });
</script>
/* Fin Liste des Offres */