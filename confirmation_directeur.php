<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>

    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <?php
                if ((isset($nomDirecteur) and $isValidNom) and (isset($prenomDirecteur) and $isValidPrenom)) { ?>
                    <dl class="dl-horizontal">
                        <dt>Nom</dt>
                        <dd><?php echo $nomDirecteur; ?></dd>
                        <dt>Prénom</dt>
                        <dd><?php echo $prenomDirecteur; ?></dd>
                    </dl>
                
                    <div class="alert alert-block">
                        <p>Voulez-vous vraiment ajouter ce directeur ?</p><br/>
                        <input type="hidden" name="nomDirecteur" value="<?php echo $nomDirecteur; ?>">
                        <input type="hidden" name="prenomDirecteur" value="<?php echo $prenomDirecteur; ?>">
                        
                        <input type="submit" name="validerConf" class="btn btn-warning" value="Valider"/>
                        <input type="submit" name="annuler" class="btn" value="Annuler"/>
                    </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>