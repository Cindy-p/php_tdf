<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>

    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <?php
                if (isset($_POST['anneeTdf']) and isset($_POST['jourRepos'])) { ?>
                    <dl class="dl-horizontal">
                        <dt>Année</dt>
                        <dd><?php echo $_POST['anneeTdf']; ?></dd>
                        <dt>Jours de repos</dt>
                        <dd><?php echo $_POST['jourRepos']; ?></dd>
                    </dl>
                
                    <div class="alert alert-block">
                        <p>Voulez-vous vraiment ajouter cette année ?</p><br/>
                        <input type="hidden" name="anneeTdf" value="<?php echo $_POST['anneeTdf']; ?>">
                        <input type="hidden" name="jourRepos" value="<?php echo $_POST['jourRepos']; ?>">
                        
                        <input type="submit" name="valider" class="btn btn-warning" value="Valider"/>
                        <input type="submit" name="annuler" class="btn" value="Annuler"/>
                    </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>