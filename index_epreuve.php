<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    <body>        
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <a class="brand" href="index.php">Tour de France</a>
                <ul class="nav">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index_coureur.php">Coureurs</a></li>
                    <li><a href="index_directeur.php">Directeurs</a></li>
					<li class="active"><a href="index_epreuve.php">Epreuves</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-top:30px;">
            <?php
            $isValidNom = true;
            $isValidPrenom = true;
            $typeErrorNom = "";
            $typeErrorPrenom = "";    
            $conn = new PDO("oci:dbname = xe", "steven", "Nokia5530");
            
            include("traitement_epreuve.php");    
        //    include("requetes_epreuve.php");
            include("formulaire_epreuve.php");
            ?>
        </div>
    </body>
</html>