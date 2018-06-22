	<!-- Footer -->
		<div id="footer-wrapper">
			<div id="footer" class="container">
                <?php if(isset($_GET['sent'])){
                    if($_GET['sent']=="null"){
                        echo '<p style="color: red">Votre message n&rsquo;a pas pu être envoyé correctement </p>';
                    }else{
                        echo '<p style="color: green">Votre message a bien été transmis. </p>';
                    }
                }?>
				<header>
					<h2>Des questions ou des commentaires ? <strong>Gardons contact :</strong></h2>
				</header>
				<div class="row">
					<div class="6u 12u(mobile)">
						<section>
							<form method="post" action="formulaire-contact.php">
								<div class="row 50%">
									<div class="6u 12u(mobile)">
										<input class="spam" name="remarque" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$" placeholder="contact@coezion.com">
										<style>
										.spam{
											display:none;
										}
										</style>
										<input name="name" placeholder="Nom, Prénom" type="text" <?php if(isset($_GET['name'])){if($_GET['name']=="n"){echo 'style="border:solid 1px red;"';}}?>/>
									</div>
									<div class="6u 12u(mobile)">
										<input name="email" placeholder="Email" type="text" <?php if(isset($_GET['email'])){if($_GET['email']=="n"){echo 'style="border:solid 1px red;"';}}?>/>
									</div>
								</div>
								<div class="row 50%">
									<div class="12u">
										<textarea name="message" placeholder="Message" style="resize:none;" <?php if(isset($_GET['message'])){if($_GET['message']=="n"){echo 'style="border:solid 1px red;"';}}?>></textarea>
									</div>
								</div>
								<div class="row 50%">
									<div class="12u">
										<input type='submit' name='submitContact' value='Envoyer' class="form-button-submit button icon fa-envelope">
									</div>
								</div>
							</form>
						</section>
					</div>
					<div class="6u 12u(mobile)">
						<section>
							<p>Contactez-nous</p>
							<div class="row">
								<div class="6u 12u(mobile)">
									<ul class="icons">
										<li class="icon fa-home">
                                            Siège social : <br/>
											4 rue Charles Floquet <br />
											92120 Montrouge<br />
											France
										</li>
										<li class="icon fa-phone">
											<!--01.49.85.19.94-->
											01.30.65.71.54
										</li>
										<li class="icon fa-envelope">
											<a href="#">contact@coezion.com</a>
										</li>
									</ul>
								</div>
								<div class="6u 12u(mobile)">
									<ul class="icons">
                                        <li class="icon fa-home">
                                            Établissement secondaire : <br/>
                                            20-22 Pl Charles de Gaulle<br />
                                            78100 St Germain En Laye<br />
                                            France
                                        </li>
										<!--<li class="icon fa-twitter">
											<a href="https://twitter.com/Coezion?lang=fr" target="_blank">Twitter</a>
										</li>-->
										<li class="icon fa-linkedin">
											<a href="https://www.linkedin.com/company/coezion/" target="_blank" >LinkedIn</a>
										</li>
										<li class="icon fa-facebook">
											<a href="https://www.facebook.com/coezionrassemblonsnostalents1/" target="_blank">Facebook</a>
										</li>
									</ul>
								</div>
							</div>
						</section>
					</div>
				
			</div>
			<div class="row">
                <div class="6u 12u(mobile)" style="height: 295px;">
                    <div class="iframe-responsive-wrapper">
                        <p>Agence Montrouge :</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2627.2570249331934!2d2.3183660149912972!3d48.815157211704864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671004287f229%3A0x5d0b72a77ed472f2!2s98+Avenue+Henri+Ginoux%2C+92120+Montrouge!5e0!3m2!1sfr!2sfr!4v1455802734414" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
				<div class="6u 12u(mobile)" style="height: 295px;">
					<div class="iframe-responsive-wrapper">
						<p>Agence Saint Germain En Laye :</p>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2622.948781091427!2d2.0929585156757633!3d48.89731327929128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6882c0a440d59%3A0xc36d14d10b9a3d14!2s22+Place+Charles+de+Gaulle%2C+78100+Saint-Germain-en-Laye!5e0!3m2!1sfr!2sfr!4v1513933641944" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					
				</div>

			</div>
			<div id="copyright" class="container">
				<ul class="links">
					<li>&copy; Coezion. All rights reserved.</li><li><a href="mentions.php">Mentions légales </a></li></ul>
			</div>
		</div>
</div>
