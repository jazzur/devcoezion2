<div id="main-wrapper">
    <div id="main" class="container">
        <section id="offre">
        </section>
            <script>
                var $ = jQuery;
                var section = $("section#offre");

                var data_offres = {
                    "CompanyId": 27,
                    "CategoryId": "",
                    "JobTitle": "", 
                    "PostalCode": ""
                };
                
                $(document).ready(function(){
                    var params = window.location.search.split("=");
                    var id = params[1];
                    
                    $.ajax({
                        url: "http://api.infolor.fr/api/CRM/GetWebAnnouncesByCriteria",
                        type: "POST",
                        data: data_offres,
                        dataType: "json",
                        success: function(response){
                            var loffre;
                            
                            $.each(response, function(index, offre){
                                if(id == JSON.stringify(offre.AnnouceId)){
                                    loffre = offre;
                                }
                            });
                            
                            var details_offre = '<div id="details-offre"><center><h1>' + JSON.stringify(loffre.Title).replace(/\"/g, "") + '</h1></center><br/>' +
                                    '</br></br>' +
                                    '<strong> Descriptif : </strong>' +
                                    JSON.stringify(loffre.HTMLDescription).replace(/\"/g, "")
                                    '</br></br>' +
                                    '<br/></br>' +
                                    '<div class="row">' +
                                        '<div class="6u 12u (mobile)" >' +
                                            '<center><a href="poster-ingenieur.php" class="button"> Coopter un candidat</a></center>' +
                                        '</div>' +
                                    '<div class="6u 12u (mobile)" >' +
                                    '<center><a href="espace-recrutement.php" class="button"> Postuler</a></center>' +
                                '</div>';

                            section.prepend((JSON.stringify(details_offre).replace(/\\/g, "")).replace(/"/g, ""));
                        },
                        error: function(e){
                            console.log("Erreur: ", e);
                        }
                    });
                });
        </script>
    </div>
</div>