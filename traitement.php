<?php
//include("connexion.php");
//include("traitement_connexion.php");

// traitement des données entrées -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM COUREUR ---------------

if(isset($_POST['nomCoureur'])){
	$_POST['nomCoureur'] = htmlspecialchars($_POST['nomCoureur']);
	//echo $_POST['nomCoureur']."<br />";
  
	if (preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $_POST['nomCoureur'])){
		//echo "nom non valide"."<br />";
		//echo "veuillez retaper un nom valide"."<br />";
        $isValidNom = false;
		//exit;
	}
	else {
        $_POST['nomCoureur'] = traitementAccents($_POST['nomCoureur']);
        $_POST['nomCoureur'] = strtoupper($_POST['nomCoureur']);
        //echo $_POST['nomCoureur']."<br />";
  }
}

//--------------- PRENOM COUREUR ---------------

if(isset($_POST['prenomCoureur'])){
	$_POST['prenomCoureur'] = htmlspecialchars($_POST['prenomCoureur']);
	//echo $_POST['prenomCoureur']."<br />";
	
	if(preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $_POST['prenomCoureur'])){
		//echo "prenom non valide"."<br />";
		//echo "veuillez retaper un prenom valide"."<br />";
        $isValidPrenom = false;
		//exit;
	}
	else {
    $_POST['prenomCoureur'] = traitementAccentsP($_POST['prenomCoureur']);
    $_POST['prenomCoureur'] = ucfirst(strtolower($_POST['prenomCoureur']));
    //echo $_POST['prenomCoureur']."<br />";
  }
}

//--------------- FONCTIONS DE TRAITEMENT ---------------

function traitementAccents($chaine){
	
	if(preg_match("#[àÀáÁâÂãÃäÄåÅ]#", $chaine))
		$chaine = preg_replace("#[àÀáÁâÂãÃäÄåÅ]#", "a", $chaine);
		
	if(preg_match("#[æÆ]#", $chaine))
		$chaine = preg_replace("#[æÆ]#", "ae", $chaine);
		
	if(preg_match("#[èÈéÉêÊëË]#", $chaine))
		$chaine = preg_replace("#[èÈéÉêÊëË]#", "e", $chaine);
	
	if(preg_match("#[ìÌíÍîÎïÏ]#", $chaine))
		$chaine = preg_replace("#[ìÌíÍîÎïÏ]#", "i", $chaine);
		
	if(preg_match("#[òÒóÓôÔõÕöÖøØ]#", $chaine))
		$chaine = preg_replace("#[òÒóÓôÔõÕöÖøØ]#", "o", $chaine);

	if(preg_match("#[ùÙúÚûÛüÜ]#", $chaine))
		$chaine = preg_replace("#[ùÙúÚûÛüÜ]#", "u", $chaine);
	
	if(preg_match("#[ñÑ]#", $chaine))
		$chaine = preg_replace("#[ñÑ]#", "n", $chaine);
		
	if(preg_match("#[çÇ]#", $chaine))
		$chaine = preg_replace("#[çÇ]#", "c", $chaine);
		
	if(preg_match("#[ýÝÿŸ]#", $chaine))
		$chaine = preg_replace("#[ýÝÿŸ]#", "y", $chaine);
	
	if(preg_match("#[ß]#", $chaine))
		$chaine = preg_replace("#[ß]#", "ss", $chaine);
		
	return $chaine;
}

function traitementAccentsP($chaine){
	
	if(preg_match("#[ÀáÁÂãÃÄåÅ]#", $chaine)){
		if(preg_match("#[áÁåÅãÃ]#", $chaine))
			$chaine = preg_replace("#[áÁåÅãÃ]#", "a", $chaine);
		if(preg_match("#À#", $chaine))
			$chaine = preg_replace("#À#", "à", $chaine);
		if(preg_match("#Â#", $chaine))
			$chaine = preg_replace("#Â#", "â", $chaine);
		if(preg_match("#Ä#", $chaine))
			$chaine = preg_replace("#Ä#", "ä", $chaine);
	}
	
	if(preg_match("#[æÆ]#", $chaine))
		$chaine = preg_replace("#[æÆ]#", "ae", $chaine);
		
	if(preg_match("#[ÈÉÊË]#", $chaine)){
		if(preg_match("#[È]#", $chaine))
			$chaine = preg_replace("#[È]#", "è", $chaine);
		if(preg_match("#[É]#", $chaine))
			$chaine = preg_replace("#[É]#", "é", $chaine);
		if(preg_match("#[Ê]#", $chaine))
			$chaine = preg_replace("#[Ê]#", "ê", $chaine);
		if(preg_match("#[Ë]#", $chaine))
			$chaine = preg_replace("#[Ë]#", "ë", $chaine);
	}

	if(preg_match("#[ìÌíÍÎÏ]#", $chaine)){
		$chaine = preg_replace("#[ìÌíÍ]#", "i", $chaine);
		if(preg_match("#[Î]#", $chaine))
			$chaine = preg_replace("#[Î]#", "î", $chaine);
		if(preg_match("#[Ï]#", $chaine))
			$chaine = preg_replace("#[Ï]#", "ï", $chaine);
	}
	
	if(preg_match("#[òÒóÓÔõÕÖøØ]#", $chaine)){
		$chaine = preg_replace("#[òÒóÓõÕøØ]#", "o", $chaine);
		if(preg_match("#[Ö]#", $chaine))
			$chaine = preg_replace("#[Ö]#", "ö", $chaine);
		if(preg_match("#[Ô]#", $chaine))
			$chaine = preg_replace("#[Ô]#", "ô", $chaine);
	}

	if(preg_match("#[ÙúÚÛÜ]#", $chaine)){
		$chaine = preg_replace("#[úÚ]#", "u", $chaine);
		if(preg_match("#[Ù]#", $chaine))
			$chaine = preg_replace("#[Ù]#", "ù", $chaine);
		if(preg_match("#[Û]#", $chaine))
			$chaine = preg_replace("#[Û]#", "û", $chaine);
		if(preg_match("#[Ü]#", $chaine))
			$chaine = preg_replace("#[Ü]#", "ü", $chaine);
	}
	if(preg_match("#[ñÑ]#", $chaine))
		$chaine = preg_replace("#[ñÑ]#", "n", $chaine);
		
	if(preg_match("#[Ç]#", $chaine))
		$chaine = preg_replace("#[Ç]#", "ç", $chaine);
		
	if(preg_match("#[ýÝÿŸ]#", $chaine))
		$chaine = preg_replace("#[ýÝÿŸ]#", "y", $chaine);
	
	if(preg_match("#[ß]#", $chaine))
		$chaine = preg_replace("#[ß]#", "ss", $chaine);
		
	return $chaine;
}

// requête permettant de récupérer la liste des pays-----------------------------------------------
/*$req = $conn->query("select * from TDF_PAYS order by NOM");
while ($donnees = $req->fetch()) {
    
}*/



// requête d'insertion des coureurs ---------------------------------------------------------------------------------------------------------------------------
// NE PAS SUPPRIMER !! 

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