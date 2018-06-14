<div id="main-wrapper">
    <div id="main" class="container">
        <div id="liste-offres">
            <section id="offres">
            </section>
            <script>
                var $ = jQuery;
                var section = $("section#offres");

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
                            section.html('');
                            var loffre;
                            
                            $.each(response, function(index, offre){
                                if(id == JSON.stringify(offre.AnnouceId)){
                                    loffre = offre;
                                }
                            });
                            section.prepend(JSON.stringify(loffre));
                        },
                        error: function(e){
                            console.log("Erreur: ", e);
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>