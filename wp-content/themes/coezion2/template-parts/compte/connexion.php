<!------------------------- Connexion ------------------------->
<section class="connexion col-lg-5 col-lg-push-1">
    <h1>Connectez vous et g&eacute;rer vos candidatures </h1>
    <hr/>
    <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" class="form_connexion col-lg-10" enctype="multipart/form-data" >
        <section class="col-lg-9">
            <label for="mail">Email </label>
            <input type="email" name="mail" id="mail" class="form-control" value="azur.mathieu@gmail.com" />
        </section>
        <section class="col-lg-9">
            <label for="mdp">Mot de passe </label>
            <input type="text" name="mdp" id="mdp" class="form-control"  value="ok" />
        </section>
        <section class="col-lg-9 submit_form"><br/>
            <input type="submit" name="connexion" class="submit_profil btn btn-primary" value="Connexion" />
        </section>
    </form>
    <?php
    if(isset($error)){ ?>
        <section class="col-xs-12 col-sm-6  col-md-5 col-lg-9 alert-warning"><?=$error; ?></section>
    <?php } ?>
</section>
<!------------------------- Fin Connexion ------------------------->