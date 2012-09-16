<?php
include("formulaire.php");
/*if (!empty($_POST)){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}*/

$db_username = "cindy.perat";
$db_password = "Peratlccsl61";
$db = "oci:dbname=xe";
$conn = new PDO($db, $db_username, $db_password);

// affichage de la tab------------------------------------------
echo "<PRE>";
$sql = 'select * from tdf_coureur_bidon where N_COUREUR >= 4680';
foreach ($conn->query($sql) as $tab) {
    print $tab['N_COUREUR']."\t";
    print $tab['NOM']."\t";
    print $tab['PRENOM']."\t";
    print $tab['ANNEE_NAISSANCE']."\t";
    print $tab['CODE_TDF']."\t";
    print $tab['ANNEE_TDF']."\n";
}
echo "</PRE>";

$req1 = $conn->query("select max(N_COUREUR)+5 as num from tdf_coureur_bidon");
$num = $req1->fetch();
echo $num['NUM']."<br />";

// requête d'insertion des coureurs-----------------------------
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

