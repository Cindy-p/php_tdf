<?php

// traitement des donn�es entr�es -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM COUREUR ---------------

if(isset($_POST['nomCoureur'])){
	$nomCoureur = htmlspecialchars($_POST['nomCoureur']);
  
	if(preg_match("#^.{0,1}$#", $nomCoureur)){
		$typeErrorNom = "Le nom saisi est trop court";
		$isValidNom = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $nomCoureur)){
        $typeErrorNom = "Le nom saisi contient des caract�res interdits";
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
			$typeErrorNom = "Le nom saisi contient des caract�res interdits";
			$isValidNom = false;
		}
	}
}

//--------------- PRENOM COUREUR ---------------

if(isset($_POST['prenomCoureur'])){
	$prenomCoureur = htmlspecialchars($_POST['prenomCoureur']);
	
	if(preg_match("#^.{0,1}$#", $prenomCoureur)){
		$typeErrorPrenom = "Le pr�nom saisi est trop court";
		$isValidPrenom = false;
	}
	else if(preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{2,}|[-| ]$#", $prenomCoureur)){
        $typeErrorPrenom = "Le pr�nom saisi contient des caract�res interdits";
		$isValidPrenom = false;
	}
	else {
			
		$prenomCoureur = traitementAccentsP($prenomCoureur);
		
		if(preg_match("#^[a-zA-Z����������������\' -]{2,}$#", $prenomCoureur)){
			$isValidPrenom = true;
		}
		else{
			$typeErrorPrenom = "Le nom saisi contient des caract�res interdits";
			$isValidPrenom = false;
		}
	}
}

//--------------- FONCTIONS DE TRAITEMENT ---------------

function suppr_inutile($separateur, $chaine){
	
	if(preg_match("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", $chaine))
		$chaine = preg_replace("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", "$separateur", $chaine);
	if(preg_match("#('){2,}|('){1,}( ){1,}('){1,}#", $chaine))
		$chaine = preg_replace("#('){2,}|('){1,}( ){1,}('){1,}#", "'", $chaine);
	if(preg_match("#('){1,}-('){1,}|('){1,}-|-('){1,}#", $chaine))
		$chaine ="";
	
	return $chaine;
}

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

function prenomCompose($separateur, $chaine){
		
		if(preg_match("#$separateur#", $chaine)){
			
			$chaine = suppr_inutile($separateur, $chaine);
			
			$tab_chaine = explode("$separateur", $chaine);
			
			for( $j = 0 ; $j < count($tab_chaine) ; $j++){ 
				$tab_parties = str_split($tab_chaine[$j]);
				$tab_parties[0] = traitementAccents($tab_parties[0]);
				$tab_chaine[$j] = implode("", $tab_parties);
				$tab_chaine[$j] = ucfirst($tab_chaine[$j]);
			}
			
			$chaine = implode("$separateur", $tab_chaine);
		}
	
	return $chaine;
}

function traitementAccentsP($chaine){
	
	$tab_parties = str_split($chaine);
	$tab_parties[0] = traitementAccents($tab_parties[0]);
	$chaine = implode( "", $tab_parties);
	$chaine = ucfirst(strtolower($chaine));

	$chaine = prenomCompose(" ", $chaine); 
	$chaine = prenomCompose("-", $chaine); 
	$chaine = prenomCompose("'", $chaine); 	
	
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

	if(preg_match("#[�����]#", $chaine)){
		$chaine = preg_replace("#[��]#", "u", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
		if(preg_match("#[�]#", $chaine))
			$chaine = preg_replace("#[�]#", "�", $chaine);
	}
	if(preg_match("#[��]#", $chaine))
		$chaine = preg_replace("#[��]#", "n", $chaine);
		
	if(preg_match("#[�]#", $chaine))
		$chaine = preg_replace("#[�]#", "�", $chaine);
		
	if(preg_match("#[����]#", $chaine))
		$chaine = preg_replace("#[����]#", "y", $chaine);
	
	if(preg_match("#[�]#", $chaine))
		$chaine = preg_replace("#[�]#", "ss", $chaine);
		
	return $chaine;
}
?>