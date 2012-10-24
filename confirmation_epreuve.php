<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>

    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <?php if (isset($_POST['anneeTdf']) and isset($_POST['n_epreuve']) and isset($_POST['paysD']) and isset($_POST['paysA']) and (isset($villeD) and $isValidNomD)
                     and (isset($villeA) and $isValidNomA) and isset($_POST['moisTDF']) and (isset($jourTDF) and $isValidJourTDF) and (isset($_POST['catE']) and $isValidTypeE)
                     and (isset($distance) and $isValidDistance)) { ?>
                
                <dl class="dl-horizontal">
                    <dt>Année</dt>
                    <dd><?php echo $_POST['anneeTdf']; ?></dd>
                    <dt>N°</dt>
                    <dd><?php echo $_POST['n_epreuve']; ?></dd>
                    <dt>Pays de départ</dt>
                    <dd><?php echo $_POST['paysD']; ?></dd>
                    <dt>Ville de départ</dt>
                    <dd><?php echo $villeD; ?></dd>
                    <dt>Pays d'arrivée</dt>
                    <dd><?php echo $_POST['paysA']; ?></dd>
                    <dt>Ville d'arrivée</dt>
                    <dd><?php echo $villeA; ?></dd>
                    <dt>Date de l'épreuve</dt>
                    <dd><?php echo $jourTDF.'/'.$_POST['moisTDF'].'/'.$_POST['anneeTdf']; ?></dd>
                    <dt>Type de l'épreuve</dt>
                    <dd><?php echo $_POST['catE']; ?></dd>
                    <dt>Distance</dt>
                    <dd><?php echo $distance; ?></dd>
                    <dt>Moyenne</dt>
                    <dd>
                    <?php
                        if (empty($moyenne))
                            echo "NC";
                        else
                            echo $moyenne;
                    ?>
                    </dd>
                </dl>
                
                <div class="alert alert-block">
                    <p>Voulez-vous vraiment ajouter cette épreuve ?</p><br/>
                    <input type="hidden" name="anneeTdf" value="<?php echo $_POST['anneeTdf']; ?>">
                    <input type="hidden" name="n_epreuve" value="<?php echo $_POST['n_epreuve']; ?>">
                    <input type="hidden" name="paysD" value="<?php echo $_POST['paysD']; ?>">
                    <input type="hidden" name="villeD" value="<?php echo $villeD; ?>">
                    <input type="hidden" name="paysA" value="<?php echo $_POST['paysA']; ?>">
                    <input type="hidden" name="villeA" value="<?php echo $villeA; ?>">
                    <input type="hidden" name="jourTDF" value="<?php echo $jourTDF; ?>">
                    <input type="hidden" name="moisTDF" value="<?php echo $_POST['moisTDF']; ?>">
                    <input type="hidden" name="catE" value="<?php echo $_POST['catE']; ?>">
                    <input type="hidden" name="distance" value="<?php echo $_POST['distance']; ?>">
                    <input type="hidden" name="moyenne" value="<?php echo $moyenne; ?>">
                    
                    <input type="submit" name="validerConf" class="btn btn-warning" value="Valider"/>
                    <input type="submit" name="annuler" class="btn" value="Annuler"/>
                </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>