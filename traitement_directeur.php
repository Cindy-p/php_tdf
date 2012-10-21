<?php

// traitement des donn�es entr�es -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM DIRECTEUR ---------------

if(isset($_POST['nomDirecteur'])){
	$nomDirecteur = htmlspecialchars($_POST['nomDirecteur']);
  
	if(preg_match("#^.{0,1}$#", $nomDirecteur)){
		$typeErrorNom = "Le nom saisi est trop court";
		$isValidNom = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $nomDirecteur)){
		$typeErrorNom = "Le nom saisi contient des caract�res interdits";
		$isValidNom = false;
	}
	else {
		$nomDirecteur = traitementAccents($nomDirecteur);
        $nomDirecteur = strtoupper($nomDirecteur);
		
		$nomDirecteur = suppr_inutile(" ", $nomDirecteur);
		$nomDirecteur = suppr_inutile("-", $nomDirecteur); 
		$nomDirecteur = suppr_inutile("'", $nomDirecteur);
		
		if(preg_match("#^[a-zA-Z\' -]{2,}$#", $nomDirecteur)){
			$isValidNom = true;
		}
		else{
			$typeErrorNom = "Le nom saisi contient des caract�res interdits";
			$isValidNom = false;
		}
	}
}

//--------------- PRENOM DIRECTEUR ---------------

if(isset($_POST['prenomDirecteur'])){
	$prenomDirecteur = htmlspecialchars($_POST['prenomDirecteur']);
	
	if(preg_match("#^.{0,1}$#", $prenomDirecteur)){
		$typeErrorPrenom = "Le pr�nom saisi est trop court";
		$isValidPrenom = false;
	}
	else if(preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{2,}|[']{2,}|[-| ]$#", $prenomDirecteur)){
        $typeErrorPrenom = "Le pr�nom saisi contient des caract�res interdits";
		$isValidPrenom = false;
	}
	else {
			
		$prenomDirecteur = traitementAccentsP($prenomDirecteur);
		
		if(preg_match("#^[a-zA-Z����������������\' -]{2,}$#", $prenomDirecteur)){
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
	
	else if(preg_match("#('){1,}-('){1,}|('){1,}-|-('){1,}#", $chaine))
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