<?php

//--------------- DEPART ---------------

if(isset($_POST['villeD'])){
	$villeD = htmlspecialchars($_POST['villeD']);
  
	if(preg_match("#^.{0,1}$#", $villeD)){
		$typeErrorNom = "La nom de ville saisi est trop court";
		$isValidNom = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $nomCoureur)){
        $typeErrorNom = "Le nom saisi contient des caractères interdits";
		$isValidNom = false;
	}
	else {
        $nomCoureur = traitementAccents($nomCoureur);
        $nomCoureur = strtoupper($nomCoureur);
		
		$nomCoureur = suppr_inutile(" ", $nomCoureur);
		$nomCoureur = suppr_inutile("-", $nomCoureur); 
		$nomCoureur = suppr_inutile("'", $nomCoureur);
		
		if(preg_match("#^[a-zA-Z\' -]{2,}$#", $nomCoureur)){
			$isValidNom = true;
		}
		else{
			$typeErrorNom = "Le nom saisi contient des caractères interdits";
			$isValidNom = false;
		}
		
	/*if($isValidNom)
      echo $nomCoureur."<br />";*/
  }
}

