<?php
if (isset($_POST['validerConf'])) {
	
	// Permet de générer un numéro de directeur -----------------------------------------------
	$req1 = $conn->query("select max(N_DIRECTEUR)+1 as NUM from tdf_directeur_bidon")
			or die(print_r($conn->errorInfo()));
	$num = $req1->fetch();
	$req1->closeCursor();
	
	// Permet de récupérer l'identifiant de connexion -------------------------------------------
	$req2 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
			or die(print_r($conn->errorInfo()));
	$user = $req2->fetch();
	$req2->closeCursor();
	
	// On vérifie si le directeur existe dans la base
	$verif = $conn->prepare("select * from tdf_directeur_bidon where nom = :n and prenom = :p")
				or die(print_r($conn->errorInfo()));
	
	if ((isset($nomDirecteur) and $isValidNom) and (isset($prenomDirecteur) and $isValidPrenom)) {
		$verif->execute(array(
			'n' => $nomDirecteur,
			'p' => $prenomDirecteur
		));
	}
		
	if ($verif->fetchColumn() > 0) {
		echo "<div class=\"alert alert-error\">Le directeur est déjà
		enregistré.</div>";
	} else {
		// Permet d'insérer un nouveau directeur dans la base ----------------------------------------------------------
		$req3 = $conn->prepare("insert into tdf_directeur_bidon (N_DIRECTEUR, NOM, PRENOM, DATE_INSERT, COMPTE_ORACLE)
						   values (:num_unique, :n, :p, to_char(sysdate, 'DD-MM-YY'), :compte)")
				or die(print_r($conn->errorInfo()));
			
		if ((isset($prenomDirecteur) and $isValidNom) and (isset($prenomDirecteur) and $isValidPrenom)) {
			if ($req3->execute(array(
				'num_unique' => $num['NUM'],
				'n' => $nomDirecteur,
				'p' => $prenomDirecteur,
				'compte' => $user['user']
			)) == true)
				echo "<div class=\"alert alert-success\">Le directeur a bien été inséré.</div>";
			else
				echo "<div class=\"alert alert-error\">L'enregistrement n'a pas été effectué.</div>";
		} $req3->closeCursor();
	}
	$verif->closeCursor();	
} else if (isset($_POST['annuler'])){
	header("location:index_directeur.php");
}

// Affichage du dernier directeur entré -----------------------------------------------------------------------------------------------
$affichage = $conn->query("select * from tdf_directeur_bidon where N_DIRECTEUR = (select max(N_DIRECTEUR) from tdf_directeur_bidon)");
$donnees = $affichage->fetch();
echo "<table class=\"table table-striped\">";
echo "<thead>";
echo "<tr>";
echo "<th>N°</th>";
echo "<th>Nom</th>";
echo "<th>Prénom</th>";
echo "<th>Date d'insertion</th>";
echo "<th>Compte Oracle</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
echo "<tr>";
echo "<td>".$donnees['N_DIRECTEUR']."</td>";
echo "<td>".$donnees['NOM']."</td>";
echo "<td>".$donnees['PRENOM']."</td>";
echo "<td>".$donnees['DATE_INSERT']."</td>";
echo "<td>".$donnees['COMPTE_ORACLE']."</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
$affichage->closeCursor();
?>