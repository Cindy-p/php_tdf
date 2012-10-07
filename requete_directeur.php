<?php

// requ�te d'insertion des directeurs ---------------------------------------------------------------------------------------------------------------------------

// Permet de g�n�rer un num�ro de directeur -----------------------------------------------
$req1 = $conn->query("select max(N_DIRECTEUR)+1 as NUM from tdf_directeur_bidon")
        or die(print_r($conn->errorInfo()));
$num = $req1->fetch(); //fetch() -> renvoie un tableau 
//echo "N� g�n�r� pour la prochaine entr�e : ".$num['NUM']."<br />"; //on utilise NUM, l'identifiant de la colonne dans laquelle est stock�e le r�sultat de la requ�te (s'il n'y en a qu'un).
$req1->closeCursor();

// Permet de r�cup�rer l'identifiant de connexion -------------------------------------------
$req2 = $conn->query("select sys_context('USERENV','SESSION_USER') as \"user\" from dual")
        or die(print_r($conn->errorInfo()));
$user = $req2->fetch();
//echo $user['user']."<br />";
$req2->closeCursor();

// Permet d'ins�rer un nouveau directeur dans la base ----------------------------------------------------------
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
        echo "<div class=\"alert alert-success\">Le directeur a bien �t� ins�r�.</div>";
    else
        echo "<div class=\"alert alert-error\">L'enregistrement n'a pas �t� effectu�.</div>";
}
$req3->closeCursor();

// Affichage du dernier directeur entr� -----------------------------------------------------------------------------------------------
$affichage = $conn->query("select * from tdf_directeur_bidon where N_DIRECTEUR = (select max(N_DIRECTEUR) from tdf_directeur_bidon)");
$donnees = $affichage->fetch();
echo "<table class=\"table table-striped\">";
echo "<thead>";
echo "<tr>";
echo "<th>N�</th>";
echo "<th>Nom</th>";
echo "<th>Pr�nom</th>";
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