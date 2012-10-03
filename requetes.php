<?php

// requ�te d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
// NE PAS SUPPRIMER !! 

$req1 = $conn->query("select max(N_COUREUR)+5 as NUM from tdf_coureur_bidon")
        or die(print_r($conn->errorInfo()));
$num = $req1->fetch(); //fetch() -> renvoie un tableau 
echo "N� g�n�r� pour la prochaine entr�e : ".$num['NUM']."<br />"; //on utilise NUM, l'identifiant de la colonne dans laquelle est stock�e le r�sultat de la requ�te (s'il n'y en a qu'un).
$req1->closeCursor();

if (isset($_POST['nomPays'])) {
    $req2 = $conn->prepare("select CODE_TDF from TDF_PAYS where NOM = ?")
            or die(print_r($conn->errorInfo()));
    $req2->execute(array($_POST['nomPays']));
    $code_tdf = $req2->fetch();
    //echo $code_tdf['CODE_TDF']."<br />";
    $req2->closeCursor();
}

/*$req3 = $conn->query("select to_char(sysdate, 'DD-MM-YY') as date_insert from dual")
        or die(print_r($conn->errorInfo()));
$date = $req3->fetch();
echo $date['DATE_INSERT']. "<br />";
$req3->closeCursor();*/

$req4 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
        or die(print_r($conn->errorInfo()));
$user = $req4->fetch();
//echo $user['user']."<br />";
$req4->closeCursor();
        
$req5 = $conn->prepare("insert into tdf_coureur_bidon (N_COUREUR, NOM, PRENOM, ANNEE_NAISSANCE, CODE_TDF, ANNEE_TDF, DATE_INSERT, COMPTE_ORACLE)
                       values (:num_unique, :n, :p, :an, :ctdf, :atdf, to_char(sysdate, 'DD-MM-YY'), :compte)")
        or die(print_r($conn->errorInfo()));
        
if (isset($nomCoureur) and isset($prenomCoureur)) {
    $req5->execute(array(
        'num_unique' => $num['NUM'],
        'n' => $nomCoureur,
        'p' => $prenomCoureur,
        'an' => $_POST['anneeNaissance'],
        'ctdf' => $code_tdf['CODE_TDF'],
        'atdf' => $_POST['anneeTdf'],
        'compte' => $user['user']
    ));
}
$req5->closeCursor();

$affichage = $conn->query("select * from tdf_coureur_bidon where N_COUREUR = (select max(N_COUREUR) from tdf_coureur_bidon)");
$donnees = $affichage->fetch();
echo $donnees['N_COUREUR'] . " " . $donnees['NOM'] . " " . $donnees['PRENOM'] . " " . $donnees['ANNEE_NAISSANCE'] . " " . $donnees['CODE_TDF'] . " " . $donnees['ANNEE_TDF'] . " " . $donnees['DATE_INSERT'] . " " . $donnees['COMPTE_ORACLE'];
$affichage->closeCursor();


?>