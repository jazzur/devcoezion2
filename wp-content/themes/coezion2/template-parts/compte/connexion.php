<!------------------------- Connexion ------------------------->
<section class="connexion col-lg-5 col-lg-push-1 col-sm-12">
    <h1>Connectez vous et g&eacute;rer vos candidatures </h1>
    <hr/>
    <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_connexion col-lg-10" enctype="multipart/form-data" >
        <section class="col-lg-10  col-md-12 col-sm-12 col-xs-12">
            <label for="mail">Email*</label>
            <input type="email" name="mail" id="mail" class="form-control" value="" />
        </section>
        <section class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <label for="mdp">Mot de passe*</label>
            <input type="password" name="mdp" id="mdp" class="form-control"  value="" />
        </section>
        <section class="col-lg-10 col-md-12 col-sm-12 col-xs-12 submit_form"><br/>
            <input type="submit" name="connexion" class="submit_profil btn btn-primary" value="Connexion" disabled="true" />
        </section>
        <section class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <a href="reinitialiser-mot-de-passe/">Mot de passe oubli&eacute;</a>
        </section>
        <?php
        if(isset($error)){ ?>
            <section class="col-xs-12 col-md-12 col-sm-12 col-xs-12 alert-warning"><?= $error; ?></section>
        <?php } ?>
    </form>
</section>
<!------------------------- Fin Connexion ------------------------->