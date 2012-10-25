<?php
if (isset($_POST['db_username']) and isset($_POST['db_password']) and isset($_POST['db'])) {    
    $_SESSION['db_username'] = $_POST['db_username'];
    $_SESSION['db_password'] = $_POST['db_password'];
    $_SESSION['db'] = "oci:dbname=".$_POST['db'];
    
    try { // Permet de vérifier si l'id et le mpd entrés sont corrects
        $conn = new PDO($_SESSION['db'], $_SESSION['db_username'], $_SESSION['db_password']);
    }
    catch (Exception $e) {
        die("<div class=\"alert alert-error\">Votre nom d'utilisateur et/ou votre mot de passe sont incorrects.</div>");
    }
    
    echo "<div class=\"alert alert-success\">Vous êtes bien connecté à la base de données.</div>";
}
?>