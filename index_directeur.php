<?php session_start(); ?>
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
                    <li><a href="index_connexion.php">Connexion</a></li>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index_coureur.php">Coureurs</a></li>
                    <li class="active"><a href="index_directeur.php">Directeurs</a></li>
					<li><a href="index_epreuve.php">Epreuves</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <?php
            $isValidNom = true;
            $isValidPrenom = true;
            $typeErrorNom = "";
            $typeErrorPrenom = "";    
<<<<<<< HEAD
            $conn = new PDO("oci:dbname = xe", "steven", "Nokia5530");
=======
>>>>>>> 4949523725c3b12157f2529ec2155a78d8976a12
            
            if (!isset($_SESSION['db_username']) and !isset($_SESSION['db_password'])) {
                echo "<div class=\"alert alert-error\">Vous n'êtes pas connecté.</div>";
            }
            else {
                try { // Permet de vérifier si l'id et le mpd entrés sont corrects
                    $conn = new PDO($_SESSION['db'], $_SESSION['db_username'], $_SESSION['db_password']);
                }
                catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
            
                include("traitement_directeur.php");
                include("requete_directeur.php");
                include("formulaire_directeur.php");
            }
            ?>
        </div>
    </body>
</html>