<?php
include("connexion.php");
include("formulaire.php");
/*if (!empty($_POST)){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}*/

$db_username = "steven";
$db_password = "Nokia5530";
$db = "oci:dbname=xe";
$conn = new PDO($db, $db_username, $db_password);

// traitement des donn�es entr�es -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM COUREUR ---------------

if(isset($_POST['nomCoureur'])){
	$_POST['nomCoureur'] = htmlspecialchars($_POST['nomCoureur']);
	echo $_POST['nomCoureur']."<br />";
	
	if(preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $_POST['nomCoureur'])){
		echo "nom non valide"."<br />";
		echo "veuillez retaper un nom valide"."<br />";
		exit;
	}
	
	$_POST['nomCoureur'] = traitementAccents($_POST['nomCoureur']);
	$_POST['nomCoureur'] = strtoupper($_POST['nomCoureur']);
	
	echo$_POST['nomCoureur']."<br />";
}

//--------------- PRENOM COUREUR ---------------

if(isset($_POST['prenomCoureur'])){
	$_POST['prenomCoureur'] = htmlspecialchars($_POST['prenomCoureur']);
	echo $_POST['prenomCoureur']."<br />";
	
	if(preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $_POST['prenomCoureur'])){
		echo "prenom non valide"."<br />";
		echo "veuillez retaper un prenom valide"."<br />";
		exit;
	}
	
	$_POST['prenomCoureur'] = traitementAccentsP($_POST['prenomCoureur']);
	$_POST['prenomCoureur'] = ucfirst(strtolower($_POST['prenomCoureur']));
	
	echo$_POST['prenomCoureur']."<br />";
}

//--------------- FONCTIONS DE TRAITEMENT ---------------

function traitementAccents($chaine){
	
	if(preg_match("#[������������]#", $chaine))
		$chaine = preg_replace("#[������������]#", "a", $chaine);
		
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "ae", $chaine);
		
	if(preg_match("#[��������]#", $chaine))
		$chaine = preg_replace("#[��������]#", "e", $chaine);
	
	if(preg_match("#[��������]#", $chaine))
		$chaine = preg_replace("#[��������]#", "i", $chaine);
		
	if(preg_match("#[������������]#", $chaine))
		$chaine = preg_replace("#[������������]#", "o", $chaine);

	if(preg_match("#[��������]#", $chaine))
		$chaine = preg_replace("#[��������]#", "u", $chaine);
	
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "n", $chaine);
		
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "c", $chaine);
		
	if(preg_match("#[����]#", $chaine))
		$chaine = preg_replace("#[����]#", "y", $chaine);
	
	if(preg_match("#[�]#", $chaine))
		$chaine = preg_replace("#[�]#", "ss", $chaine);
		
	return $chaine;
}

function traitementAccentsP($chaine){
	
	if(preg_match("#[���������]#", $chaine)){
		if(preg_match("#[������]#", $chaine))
			$chaine = preg_replace("#[������]#", "a", $chaine);
		if(preg_match("#�#", $chaine))
			$chaine = preg_replace("#�#", "�", $chaine);
		if(preg_match("#�#", $chaine))
			$chaine = preg_replace("#�#", "�", $chaine);
		if(preg_match("#�#", $chaine))
			$chaine = preg_replace("#�#", "�", $chaine);
	}
	
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "ae", $chaine);
		
	if(preg_match("#[����]#", $chaine)){
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
	}

	if(preg_match("#[������]#", $chaine)){
		$chaine = preg_replace("#[����]#", "i", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
	}
	
	if(preg_match("#[����������]#", $chaine)){
		$chaine = preg_replace("#[��������]#", "o", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
	}

	if(preg_match("#[��������]#", $chaine)) // � finir
		$chaine = preg_replace("#[��������]#", "u", $chaine);
	
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "n", $chaine);
		
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "c", $chaine);
		
	if(preg_match("#[����]#", $chaine))
		$chaine = preg_replace("#[����]#", "y", $chaine);
	
	if(preg_match("#[�]#", $chaine))
		$chaine = preg_replace("#[�]#", "ss", $chaine);
		
	return $chaine;
}

// requ�te d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
// NE PAS SUPPRIMER !! 

/*
$req1 = $conn->query("select max(N_COUREUR)+5 as NUM from tdf_coureur_bidon");
$num = $req1->fetch(); //fetch() -> renvoie un tableau 
echo $num['NUM']."<br />"; //on utilise NUM, l'identifiant de la colonne dans laquelle est stock�e le r�sultat de la requ�te (s'il n'y en a qu'un).

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