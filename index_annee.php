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
                    <li><a href="index_directeur.php">Directeurs</a></li>
					<li><a href="index_epreuve.php">Epreuves</a></li>
                    <li class="active"><a href="index_annee.php">Ann�es</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <?php
            
            if (!isset($_SESSION['db_username']) and !isset($_SESSION['db_password'])) {
                echo "<div class=\"alert alert-error\">Vous n'�tes pas connect�.</div>";
            }
            else {
                try { // Permet de v�rifier si l'id et le mdp entr�s sont corrects
                    $conn = new PDO($_SESSION['db'], $_SESSION['db_username'], $_SESSION['db_password']);
                }
                catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                
				include("formulaire_annee.php");
				include("confirmation_annee.php");
				include("requete_annee.php");
                
            }
            ?>
        </div>
    </body>
</html>