<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    <body>
    <?php
        $isValidNom = true;
        $isValidPrenom = true;
		$typeErrorNom = "";
		$typeErrorPrenom = "";
		
		$conn = new PDO("oci:dbname = xe", "steven", "Nokia5530");
		
    //    include("traitement_connexion.php");
    //    include("traitement.php");
		include("traitement_directeur.php");
		
    //    include("requetes.php");
	
    //    include("formulaire.php");
		include("formulaire_directeur.php");
    ?>
    </body>
</html>
