<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>

    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <?php if ((isset($nomCoureur) and $isValidNom) and (isset($prenomCoureur) and $isValidPrenom) and isset($_POST['nomPays'])) { ?>
                
                <dl class="dl-horizontal">
                    <dt>Nom</dt>
                    <dd><?php echo $nomCoureur; ?></dd>
                    <dt>Prénom</dt>
                    <dd><?php echo $prenomCoureur; ?></dd>
                    <dt>Année de naissance</dt>
                    <dd>
                    <?php
                        if (empty($_POST['anneeNaissance']))
                            echo "NC";
                        else
                            echo $_POST['anneeNaissance'];
                    ?>
                    </dd>
                    <dt>Pays</dt>
                    <dd><?php echo $_POST['nomPays']; ?></dd>
                    <dt>Année de participation</dt>
                    <dd>
                    <?php
                        if (empty($_POST['anneeTdf']))
                            echo "NC";
                        else
                            echo $_POST['anneeTdf'];
                    ?>
                    </dd>
                </dl>
                
                <div class="alert alert-block">
                    <p>Voulez-vous vraiment ajouter ce coureur ?</p><br/>
                    <input type="hidden" name="nomCoureur" value="<?php echo $nomCoureur; ?>">
                    <input type="hidden" name="prenomCoureur" value="<?php echo $prenomCoureur; ?>">
                    <input type="hidden" name="anneeNaissance" value="<?php echo $_POST['anneeNaissance']; ?>">
                    <input type="hidden" name="nomPays" value="<?php echo $_POST['nomPays']; ?>">
                    <input type="hidden" name="anneeTdf" value="<?php echo $_POST['anneeTdf']; ?>">
                    
                    <input type="submit" name="valider" class="btn btn-warning" value="Valider"/>
                    <input type="submit" name="annuler" class="btn" value="Annuler"/>
                </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>