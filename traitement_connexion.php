<?php
if (isset($_POST['db_username']) and isset($_POST['db_password']) and isset($_POST['db'])) {    
    $_SESSION['db_username'] = $_POST['db_username'];
    $_SESSION['db_password'] = $_POST['db_password'];
    $_SESSION['db'] = "oci:dbname=".$_POST['db'];
    
    try { // Permet de v�rifier si l'id et le mpd entr�s sont corrects
        $conn = new PDO($_SESSION['db'], $_SESSION['db_username'], $_SESSION['db_password']);
    }
    catch (Exception $e) {
        die("<div class=\"alert alert-error\">Votre nom d'utilisateur et/ou votre mot de passe sont incorrects.</div>");
    }
    
    echo "<div class=\"alert alert-success\">Vous �tes bien connect� � la base de donn�es.</div>";
}
?>