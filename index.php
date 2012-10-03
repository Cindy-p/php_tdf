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
        include("traitement.php");
    //    include("requetes.php");
        include("formulaire.php");
    ?>
    </body>
</html>
