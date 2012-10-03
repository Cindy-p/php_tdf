<?php

// requête d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
// NE PAS SUPPRIMER !! 

$req1 = $conn->query("select max(N_COUREUR)+5 as NUM from tdf_coureur_bidon")
        or die(print_r($conn->errorInfo()));
$num = $req1->fetch(); //fetch() -> renvoie un tableau 
echo $num['NUM']."<br />"; //on utilise NUM, l'identifiant de la colonne dans laquelle est stockée le résultat de la requête (s'il n'y en a qu'un).
$req1->closeCursor();

if (isset($_POST['nomPays'])) {
    $req2 = $conn->prepare("select CODE_TDF from TDF_PAYS where NOM = ?")
            or die(print_r($conn->errorInfo()));
    $req2->execute(array($_POST['nomPays']));
    $code_tdf = $req2->fetch();
    echo $code_tdf['CODE_TDF']."<br />";
    $req2->closeCursor();
}

        
$req3 = $conn->prepare("insert into tdf_coureur_bidon (N_COUREUR, NOM, PRENOM, ANNEE_NAISSANCE, CODE_TDF, ANNEE_TDF, DATE_INSERT, COMPTE_ORACLE) values (:num_unique, :n, :p, :an, :ctdf, :atdf, :date, :compte)")
        or die(print_r($conn->errorInfo()));
        
if (isset($nomCoureur) and isset($prenomCoureur) and isset($_POST['nomPays']) and isset($_POST['date_insert']) and isset($_POST['compte_oracle'])) {
    $req3->execute(array(
        'num_unique' => $num['NUM'],
        'n' => $nomCoureur,
        'p' => $prenomCoureur,
        'an' => $_POST['anneeNaissance'],
        'ctdf' => $code_tdf['CODE_TDF'],
        'atdf' => $_POST['anneeTdf'],
        'date' => $_POST['date_insert'], // pb ici, enpêche l'exécution du INSERT INTO
        'compte' => $_POST['compte_oracle']
    ));
}
//$req3->closeCursor();

$affichage = $conn->query("select * from tdf_coureur_bidon where N_COUREUR = 4750");
$donnees = $affichage->fetch();
echo $donnees['N_COUREUR'] . " " . $donnees['NOM'] . " " . $donnees['PRENOM'] . " " . $donnees['ANNEE_NAISSANCE'] . " " . $donnees['CODE_TDF'] . " " . $donnees['ANNEE_TDF'] . " " . $donnees['DATE_INSERT'] . " " . $donnees['COMPTE_ORACLE'];
$affichage->closeCursor();


?>