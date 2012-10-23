<?php

if (isset($_POST['valider'])) {
    
    // Permet de r�cup�rer l'identifiant de connexion -------------------------------------------
	$req2 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
			or die(print_r($conn->errorInfo()));
	$user = $req2->fetch();
	$req2->closeCursor();
    
    // Permet d'ins�rer une nouvelle ann�e dans la base ----------------------------------------------------------
	$req3 = $conn->prepare("insert into tdf_annee_bidon (ANNEE, JOUR_REPOS, DATE_INSERT, COMPTE_ORACLE)
						   values (:an, :jour_repos, to_char(sysdate, 'DD-MM-YY'), :compte)")
			or die(print_r($conn->errorInfo()));
    
    // On v�rifie si l'ann�e existe dans la base
	$verif = $conn->prepare("select * from tdf_annee_bidon where ANNEE = :an")
				or die(print_r($conn->errorInfo()));
    
    if (isset($_POST['anneeTdf']) and isset($_POST['jourRepos'])) {
		$verif->execute(array(
			'an' => $_POST['anneeTdf']
		));
	}
    
    if ($verif->fetchColumn() > 0) {
		echo "<div class=\"alert alert-error\">L'ann�e est d�j� enregistr�e.</div>";
	}
	else {	
		if (isset($_POST['anneeTdf']) and isset($_POST['jourRepos'])) {
			if ($req3->execute(array(
				'an' => $_POST['anneeTdf'],
                'jour_repos' => $_POST['jourRepos'],
				'compte' => $user['user']
			)) == true)
				echo "<div class=\"alert alert-success\">L'ann�e a bien �t� ins�r�e.</div>";
			else
				echo "<div class=\"alert alert-error\">L'enregistrement n'a pas �t� effectu�.</div>";
		}
		$req3->closeCursor();
	}
	$verif->closeCursor();
}

// Affichage de la derni�re ann�e entr� -----------------------------------------------------------------------------------------------
$affichage = $conn->query("select * from tdf_annee_bidon where ANNEE = (select max(ANNEE) from tdf_annee_bidon)");
$donnees = $affichage->fetch();
echo "<table class=\"table table-striped\">";
echo "<thead>";
echo "<tr>";
echo "<th>Ann�e</th>";
echo "<th>Jours de repos</th>";
echo "<th>Date d'insertion</th>";
echo "<th>Compte Oracle</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
echo "<tr>";
echo "<td>".$donnees['ANNEE']."</td>";
echo "<td>".$donnees['JOUR_REPOS']."</td>";
echo "<td>".$donnees['DATE_INSERT']."</td>";
echo "<td>".$donnees['COMPTE_ORACLE']."</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
$affichage->closeCursor();
?>