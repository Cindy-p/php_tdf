<?php
include("connexion.php");
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

// traitement des données entrées -------------------------------

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

if(isset($_POST['prenomCoureur'])){
	$_POST['prenomCoureur'] = htmlspecialchars($_POST['prenomCoureur']);
	echo $_POST['prenomCoureur']."<br />";
	
	if(preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $_POST['prenomCoureur'])){
		echo "prenom non valide"."<br />";
		echo "veuillez retaper un prenom valide"."<br />";
		exit;
	}
	
	$_POST['prenomCoureur'] = traitementAccents($_POST['prenomCoureur']);
	$_POST['prenomCoureur'] = ucfirst($_POST['prenomCoureur']);
	
	echo$_POST['prenomCoureur']."<br />";
}

function traitementAccents($chaine){
	if($chaine == $_POST['nomCoureur']){
		if(preg_match("#[àÀáÁâÂãÃäÄåÅ]#", $chaine))
			$chaine = preg_replace("#[àÀáÁâÂãÃäÄåÅ]#", "a", $chaine);
	}	
	else {
		if(preg_match("#[ÀáÁÂãÃäÄåÅ]#", $chaine))
			$chaine = preg_replace("#[ÀáÁÂãÃäÄåÅ]#", "a", $chaine);
	}
		
	if(preg_match("#[æÆ]#", $chaine))
		$chaine = preg_replace("#[æÆ]#", "ae", $chaine);
		
	if(preg_match("#[èÈéÉêÊëË]#", $chaine))
		$chaine = preg_replace("#[èÈéÉêÊëË]#", "e", $chaine);
	
	if($chaine == $_POST['nomCoureur']){
		if(preg_match("#[ìÌíÍîÎïÏ]#", $chaine))
			$chaine = preg_replace("#[ìÌíÍîÎïÏ]#", "i", $chaine);
	}
	else {
		if(preg_match("#[ìÌíÍÎÏ]#", $chaine))
			$chaine = preg_replace("#[ìÌíÍÎÏ]#", "i", $chaine);
	}
	
	if($chaine == $_POST['nomCoureur']){	
		if(preg_match("#[òÒóÓôÔõÕöÖøØ]#", $chaine))
			$chaine = preg_replace("#[òÒóÓôÔõÕöÖøØ]#", "o", $chaine);
	}
	else{	
		if(preg_match("#[òÒóÓÔõÕöÖøØ]#", $chaine))
			$chaine = preg_replace("#[òÒóÓÔõÕöÖøØ]#", "o", $chaine);
	}
	
	if($chaine == $_POST['nomCoureur']){	
		if(preg_match("#[ùÙúÚûÛüÜ]#", $chaine))
			$chaine = preg_replace("#[ùÙúÚûÛüÜ]#", "u", $chaine);
	}
	else {	
		if(preg_match("#[ÙúÚÛÜ]#", $chaine))
			$chaine = preg_replace("#[ÙúÚÛÜ]#", "u", $chaine);
	}
	
	if(preg_match("#[ñÑ]#", $chaine))
			$chaine = preg_replace("#[ñÑ]#", "n", $chaine);
		
		if(preg_match("#[çÇ]#", $chaine))
			$chaine = preg_replace("#[çÇ]#", "c", $chaine);
	
	if($chaine == $_POST['nomCoureur']){	
		if(preg_match("#[ýÝÿŸ]#", $chaine))
			$chaine = preg_replace("#[ýÝÿŸ]#", "y", $chaine);
	}
	else{	
		if(preg_match("#[ýÝŸ]#", $chaine))
			$chaine = preg_replace("#[ýÝŸ]#", "y", $chaine);
	}
	
	if(preg_match("#[ß]#", $chaine))
		$chaine = preg_replace("#[ß]#", "ss", $chaine);
		
	return $chaine;
}
// requête d'insertion des coureurs -----------------------------

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