<?php
if (isset($_POST['validerConf'])) {
    // Permet de récupérer l'identifiant de connexion -------------------------------------------
	$req1 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
			or die(print_r($conn->errorInfo()));
	$user = $req1->fetch();
	$req1->closeCursor();
    
    // Permet de passer, par exemple, de PROLOGUE à PRO ---------------------------
	if (isset($_POST['catE'])) {
		$req2 = $conn->prepare("select distinct CAT_CODE from TDF_CATEGORIE_EPREUVE where LIBELLE = ?")
				or die(print_r($conn->errorInfo()));
		$req2->execute(array($_POST['catE']));
		$cat_code = $req2->fetch();
		$req2->closeCursor();
	}
    
    // Permet de passer, par exemple, de FRANCE à FRA pour paysD ---------------------------
	if (isset($_POST['paysD'])) {
		$req3 = $conn->prepare("select CODE_TDF from TDF_PAYS where NOM = ?")
				or die(print_r($conn->errorInfo()));
		$req3->execute(array($_POST['paysD']));
		$code_tdfd = $req3->fetch();
		$req3->closeCursor();
	}
    
    // Permet de passer, par exemple, de FRANCE à FRA pour paysA ---------------------------
	if (isset($_POST['paysA'])) {
		$req4 = $conn->prepare("select CODE_TDF from TDF_PAYS where NOM = ?")
				or die(print_r($conn->errorInfo()));
		$req4->execute(array($_POST['paysA']));
		$code_tdfa = $req4->fetch();
		$req4->closeCursor();
	}
    
    // On vérifie si l'épreuve n'existe pas dans la base
	$verif = $conn->prepare("select * from tdf_epreuve_bidon where ANNEE = :an and N_EPREUVE = :num_epreuve")
			or die(print_r($conn->errorInfo()));
            
    if (isset($_POST['anneeTdf']) and isset($_POST['n_epreuve']) and isset($_POST['paysD']) and isset($_POST['paysA']) and (isset($villeD) and $isValidNomD)
        and (isset($villeA) and $isValidNomA) and isset($_POST['moisTDF']) and (isset($jourTDF) and $isValidJourTDF) and (isset($_POST['catE']) and $isValidTypeE)
        and (isset($distance) and $isValidDistance)) {
		$verif->execute(array(
			'an' => $_POST['anneeTdf'],
			'num_epreuve' => $_POST['n_epreuve']
		));
	}
    
    if ($verif->fetchColumn() > 0) {
		echo "<div class=\"alert alert-error\">L'épreuve est déjà enregistrée dans la base.</div>";
	}
	else {
		// Insertion d'un coureur -------------------------------------------------------------------------------------------------
		$ajout = $conn->prepare("insert into tdf_epreuve_bidon (ANNEE, N_EPREUVE, VILLE_D, VILLE_A, DISTANCE, MOYENNE, CODE_TDF_A, CODE_TDF_D,
                                JOUR, CAT_CODE, DATE_INSERT, COMPTE_ORACLE)
							   values (:an, :n, :vd, :va, :distance, :moy, :ctdfa, :ctdfd, :jour, :cat_code, to_char(sysdate, 'DD-MM-YY'), :compte)")
				or die(print_r($conn->errorInfo()));
				
		if (isset($_POST['anneeTdf']) and isset($_POST['n_epreuve']) and isset($_POST['paysD']) and isset($_POST['paysA']) and (isset($villeD) and $isValidNomD)
        and (isset($villeA) and $isValidNomA) and isset($_POST['moisTDF']) and (isset($jourTDF) and $isValidJourTDF) and (isset($_POST['catE']) and $isValidTypeE)
        and (isset($distance) and $isValidDistance)) {
			if ($ajout->execute(array(
				'an' => $_POST['anneeTdf'],
                'n' => $_POST['n_epreuve'],
                'vd' => $villeD,
                'va' => $villeA,
                'distance' => $distance,
                'moy' => $moyenne,
                'ctdfa' => $code_tdfa['CODE_TDF'],
                'ctdfd' => $code_tdfd['CODE_TDF'],
                'jour' => $jourTDF.'/'.$_POST['moisTDF'].'/'.$_POST['anneeTdf'],
                'cat_code' => $cat_code['CAT_CODE'],
				'compte' => $user['user']
			)) == true)
				echo "<div class=\"alert alert-success\">Le coureur a bien été inséré.</div>";
			else
				echo "<div class=\"alert alert-error\">L'enregistrement n'a pas été effectué.</div>";
		}
		$ajout->closeCursor();
	}
	$verif->closeCursor();
} else if (isset($_POST['annuler'])){
	header("location:index_epreuve.php");
}
    
// Affichage de la dernière épreuve entrée ---------------------------------------------------------------------------------------
$affichage = $conn->query("select * from tdf_epreuve_bidon where DATE_INSERT = (select max(DATE_INSERT) from tdf_epreuve_bidon)");
$donnees = $affichage->fetch();
echo "<table class=\"table table-striped\">";
echo "<thead>";
echo "<tr>";
echo "<th>Année</th>";
echo "<th>N°</th>";
echo "<th>Ville de départ</th>";
echo "<th>Ville d'arrivée</th>";
echo "<th>Distance</th>";
echo "<th>Moyenne</th>";
echo "<th>Pays de départ</th>";
echo "<th>Pays d'arrivée</th>";
echo "<th>Jour</th>";
echo "<th>Catégorie</th>";
echo "<th>Date d'insertion</th>";
echo "<th>Compte</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
echo "<tr>";
echo "<td>".$donnees['ANNEE']."</td>";
echo "<td>".$donnees['N_EPREUVE']."</td>";
echo "<td>".$donnees['VILLE_D']."</td>";
echo "<td>".$donnees['VILLE_A']."</td>";
echo "<td>".$donnees['DISTANCE']."</td>";
echo "<td>".$donnees['MOYENNE']."</td>";
echo "<td>".$donnees['CODE_TDF_D']."</td>";
echo "<td>".$donnees['CODE_TDF_A']."</td>";
echo "<td>".$donnees['JOUR']."</td>";
echo "<td>".$donnees['CAT_CODE']."</td>";
echo "<td>".$donnees['DATE_INSERT']."</td>";
echo "<td>".$donnees['COMPTE_ORACLE']."</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
$affichage->closeCursor();

?>