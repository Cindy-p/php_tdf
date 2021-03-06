<?php

if (isset($_POST['validerConf'])) {
	// requ�te d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
	// Permet de g�n�rer un num�ro de coureur -----------------------------------------------------
	$req1 = $conn->query("select max(N_COUREUR)+5 as NUM from tdf_coureur_bidon")
			or die(print_r($conn->errorInfo()));
	$num = $req1->fetch(); 
	$req1->closeCursor();
	
	// Permet de passer, par exemple, de FRANCE � FRA ---------------------------
	if (isset($_POST['nomPays'])) {
		$req2 = $conn->prepare("select CODE_TDF from TDF_PAYS where NOM = ?")
				or die(print_r($conn->errorInfo()));
		$req2->execute(array($_POST['nomPays']));
		$code_tdf = $req2->fetch();
		$req2->closeCursor();
	}
	
	// Permet de r�cup�rer l'identifiant de connexion ------------------------------------------------------------------------
	$req3 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
			or die(print_r($conn->errorInfo()));
	$user = $req3->fetch();
	$req3->closeCursor();
	
	// On v�rifie si le coureur n'existe pas dans la base
	$verif = $conn->prepare("select * from tdf_coureur_bidon where nom = :n and prenom = :p and code_tdf = :ctdf")
			or die(print_r($conn->errorInfo()));
			
	if ((isset($nomCoureur) and $isValidNom) and (isset($prenomCoureur) and $isValidPrenom) and isset($_POST['nomPays'])) {
		$verif->execute(array(
			'n' => $nomCoureur,
			'p' => $prenomCoureur,
			'ctdf' => $code_tdf['CODE_TDF']
		));
	}
	
	if ($verif->fetchColumn() > 0) {
		echo "<div class=\"alert alert-error\">Le coureur est d�j� enregistr� dans la base.</div>";
	}
	else {
		// Insertion d'un coureur -------------------------------------------------------------------------------------------------
		$ajout = $conn->prepare("insert into tdf_coureur_bidon (N_COUREUR, NOM, PRENOM, ANNEE_NAISSANCE, CODE_TDF, ANNEE_TDF, DATE_INSERT, COMPTE_ORACLE)
							   values (:num_unique, :n, :p, :an, :ctdf, :atdf, to_char(sysdate, 'DD-MM-YY'), :compte)")
				or die(print_r($conn->errorInfo()));
				
		if ((isset($nomCoureur) and $isValidNom) and (isset($prenomCoureur) and $isValidPrenom) and isset($_POST['nomPays'])) {
			if ($ajout->execute(array(
				'num_unique' => $num['NUM'],
				'n' => $nomCoureur,
				'p' => $prenomCoureur,
				'an' => $_POST['anneeNaissance'],
				'ctdf' => $code_tdf['CODE_TDF'],
				'atdf' => $_POST['anneeTdf'],
				'compte' => $user['user']
			)) == true)
				echo "<div class=\"alert alert-success\">Le coureur a bien �t� ins�r�.</div>";
			else
				echo "<div class=\"alert alert-error\">L'enregistrement n'a pas �t� effectu�.</div>";
		}
		$ajout->closeCursor();
	}
	$verif->closeCursor();
} else if (isset($_POST['annuler'])){
	header("location:index_coureur.php");
}

// Affichage du dernier coureur entr� ---------------------------------------------------------------------------------------
$affichage = $conn->query("select * from tdf_coureur_bidon where N_COUREUR = (select max(N_COUREUR) from tdf_coureur_bidon)");
$donnees = $affichage->fetch();
echo "<table class=\"table table-striped\">";
echo "<thead>";
echo "<tr>";
echo "<th>N�</th>";
echo "<th>Nom</th>";
echo "<th>Pr�nom</th>";
echo "<th>Ann�e de naissance</th>";
echo "<th>Pays</th>";
echo "<th>Ann�e de participation</th>";
echo "<th>Date d'insertion</th>";
echo "<th>Compte Oracle</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
echo "<tr>";
echo "<td>".$donnees['N_COUREUR']."</td>";
echo "<td>".$donnees['NOM']."</td>";
echo "<td>".$donnees['PRENOM']."</td>";
echo "<td>".$donnees['ANNEE_NAISSANCE']."</td>";
echo "<td>".$donnees['CODE_TDF']."</td>";
echo "<td>".$donnees['ANNEE_TDF']."</td>";
echo "<td>".$donnees['DATE_INSERT']."</td>";
echo "<td>".$donnees['COMPTE_ORACLE']."</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
$affichage->closeCursor();

?>