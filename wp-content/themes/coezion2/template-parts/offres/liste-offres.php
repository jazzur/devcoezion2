<div id="main-wrapper">
    <div id="main" class="container">
        <div id="liste-offres">
            <section id="offres">

            </section>
            <script>
                var $ = jQuery;
                var offres = [];
                var section = $("section#offres");

                var data_offres = {
                    "CompanyId": 27,
                    "CategoryId": "",
                    "JobTitle": "", 
                    "PostalCode": ""
                };

                var bloc_offre_begin = '<div id="bloc" class="6u 12u(mobile)">' +
                        '<div class="iframe-responsive-wrapper" style="height-max: 120px;">' +
                                '<p style="height: 60px; overflow: hidden; -o-text-overflow: ellipsis; text-overflow: ellipsis; ">' +
                                    '<h3><center>';
                var bloc_offre_end = '</center></h3></p></div>';

                $(document).ready(function(){
                    $.ajax({
                        url: "http://api.infolor.fr/api/CRM/GetWebAnnouncesByCriteria",
                        type: "POST",
                        data: data_offres,
                        dataType: "json",
                        success: function(response){
                            section.html('');

                            $.each(response, function(index, offre){
                                var title = JSON.stringify(offre.Title).replace(/"/g, "") + '<br/>';
                                var date = JSON.stringify(offre.Date).replace(/"/g, "") + '<br/>';
                                var link = '<center><a href="details-annonces.php?id=' + JSON.stringify(offre.AnnouceId) + '" class="button"> Voir les d&eacute;tails de l\'offre</a></center>';
                                
                                section.prepend(bloc_offre_begin + title + date + link + bloc_offre_end);
                            });
                        },
                        error: function(e){
                            console.log("Erreur: " + e)
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>