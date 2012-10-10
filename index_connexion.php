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
                    <li class="active"><a href="index_connexion.php">Connexion</a></li>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index_coureur.php">Coureurs</a></li>
                    <li><a href="index_directeur.php">Directeurs</a></li>
                    <li><a href="index_epreuve.php">Epreuves</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <?php
            if (isset($_SESSION['db_username']) and isset($_SESSION['db_password'])) {
                echo "<div class=\"alert alert-info\">Vous êtes déjà connecté.</div>";
            }
            else {
                include("formulaire_connexion.php");
                include("traitement_connexion.php");
            }
            ?>
        </div>
    </body>
</html>