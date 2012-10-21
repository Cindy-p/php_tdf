<?php

// traitement des données entrées -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM DIRECTEUR ---------------

if(isset($_POST['nomDirecteur'])){
	$nomDirecteur = htmlspecialchars($_POST['nomDirecteur']);
  
	if(preg_match("#^.{0,1}$#", $nomDirecteur)){
		$typeErrorNom = "Le nom saisi est trop court";
		$isValidNom = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $nomDirecteur)){
		$typeErrorNom = "Le nom saisi contient des caractères interdits";
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
			$typeErrorNom = "Le nom saisi contient des caractères interdits";
			$isValidNom = false;
		}
	}
}

//--------------- PRENOM DIRECTEUR ---------------

if(isset($_POST['prenomDirecteur'])){
	$prenomDirecteur = htmlspecialchars($_POST['prenomDirecteur']);
	
	if(preg_match("#^.{0,1}$#", $prenomDirecteur)){
		$typeErrorPrenom = "Le prénom saisi est trop court";
		$isValidPrenom = false;
	}
	else if(preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{2,}|[']{2,}|[-| ]$#", $prenomDirecteur)){
        $typeErrorPrenom = "Le prénom saisi contient des caractères interdits";
		$isValidPrenom = false;
	}
	else {
			
		$prenomDirecteur = traitementAccentsP($prenomDirecteur);
		
		if(preg_match("#^[a-zA-Zàâäéèêëîïôöùûüÿç\' -]{2,}$#", $prenomDirecteur)){
			$isValidPrenom = true;
		}
		else{
			$typeErrorPrenom = "Le nom saisi contient des caractères interdits";
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