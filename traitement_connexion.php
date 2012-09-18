<?php
include("connexion.php");

$db = "oci:dbname=xe";
if (isset($_POST['db_username']) and isset($_POST['db_password'])) {
    $db_username = $_POST['db_username'];
    $db_password = $_POST['db_password'];
    
    try {
        $conn = new PDO($db, $db_username, $db_password);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}




    