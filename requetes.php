<?php

// requête d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
// NE PAS SUPPRIMER !! 

/*
$req1 = $conn->query("select max(N_COUREUR)+5 as NUM from tdf_coureur_bidon");
$num = $req1->fetch(); //fetch() -> renvoie un tableau 
echo $num['NUM']."<br />"; //on utilise NUM, l'identifiant de la colonne dans laquelle est stockée le résultat de la requête (s'il n'y en a qu'un).

$req = $conn->prepare("insert into tdf_coureur_bidon (N_COUREUR, NOM, PRENOM, ANNEE_NAISSANCE, CODE_TDF, ANNEE_TDF) values (:num_unique, :n, :p, :an, :ctdf, :atdf)")
        or die(print_r($conn->errorInfo()));
        
if (isset($_POST['nomCoureur']) and isset($_POST['prenomCoureur']) and isset($_POST['anneeNaissance']) and isset($_POST['codeTdf']) and isset($_POST['anneeTdf'])) {
    $req->execute(array(
        'num_unique' => $num['NUM'],
        'n' => $_POST['nomCoureur'],
        'p' => $_POST['prenomCoureur'],
        'an' => $_POST['anneeNaissance'],
        'ctdf' => $_POST['codeTdf'],
        'atdf' => $_POST['anneeTdf'] 
    ));
} 
*/
?>