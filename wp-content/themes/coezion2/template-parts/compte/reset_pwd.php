<!------------------------ Reset mdp ---------------------->
<section class="reset_pass col-lg-6 col-lg-push-1">
    <h1>R&eacute;initialisez votre mot de passe</h1>
    <hr/>
    <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_reset_pass col-lg-10" enctype="multipart/form-data" >
        <section class="col-lg-12 col-sm-12 col-xs-12">
            <label for="mail">Email*</label>
            <input type="email" name="mail" id="mail" class="form-control" value="" />
        </section>
        <section class="col-lg-9 submit_form"><br/>
            <input type="submit" name="reset_pass" id="reset_pass" class="submit_reset_pass btn btn-primary" value="Envoyer" disabled="true" />
        </section>
    </form>
</section>
<!------------------------ Fin Reset mdp ---------------------->