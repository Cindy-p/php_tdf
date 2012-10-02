<?php

// traitement des donn�es entr�es -----------------------------------------------------------------------------------------------------------------------------

//--------------- NOM COUREUR ---------------

if(isset($_POST['nomCoureur'])){
	$nomCoureur = htmlspecialchars($_POST['nomCoureur']);
  
	if (preg_match("#^['| |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{3,}|[-| ]$#", $nomCoureur)){
        $isValidNom = false;
	}
	else {
        $nomCoureur = traitementAccents($nomCoureur);
        $nomCoureur = strtoupper($nomCoureur);
		
		$nomCoureur = suppr_inutile(" ", $nomCoureur); //modifi�
		$nomCoureur = suppr_inutile("-", $nomCoureur); //modifi�
		$nomCoureur = suppr_inutile("'", $nomCoureur); //modifi�
		
		if(preg_match("#^[a-zA-Z\' -]{2,}$#", $nomCoureur)){
			$isValidNom = true;
		}
		else{
			$isValidNom = false;
		}
    //  echo $nomCoureur."<br />";
  }
}

//--------------- PRENOM COUREUR ---------------

if(isset($_POST['prenomCoureur'])){
	$prenomCoureur = htmlspecialchars($_POST['prenomCoureur']);
	
	if(preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|0-9]|[-]{2,}|[']{2,}|[-| ]$#", $prenomCoureur)){
        $isValidPrenom = false;
	}
	else {
		$prenomCoureur = traitementAccentsP($prenomCoureur);
		
		if(preg_match("#^[a-zA-Z����������������\' -]{2,}$#", $prenomCoureur)){
			$isValidPrenom = true;
		}
		else{
			$isValidPrenom = false;
		}
	
	//	echo $prenomCoureur."<br />";
  }
}

//--------------- FONCTIONS DE TRAITEMENT ---------------

//modif envoy�e ---------------------------------------------------------------------------------
function suppr_inutile($separateur, $chaine){
	
	if(preg_match("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", $chaine))
		$chaine = preg_replace("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", "$separateur", $chaine);
	
	else if(preg_match("#('){1,}$separateur('){1,}|('){1,}$separateur|$separateur('){1,}#", $chaine))
		$chaine += "�";
	
	return $chaine;
}

//modif envoy�e ---------------------------------------------------------------------------------

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
// modif � envoyer --------------------------------------------------------------------------------

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

//modif � envoyer ---------------------------------------------------------------------------------
	
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

//--------------- CONFIRMATION -----------------

 if ((isset($nomCoureur) and $isValidNom) and (isset($prenomCoureur) and $isValidPrenom) and
    isset($_POST['nomPays']) and isset($_POST['date_insert']) and isset($_POST['compte_oracle'])) {
    echo "Nom : $nomCoureur <br />";
    echo "Pr�nom : $prenomCoureur <br />";
    if (empty($_POST['anneeNaissance']))
        echo "Ann�e de naissance : NI <br />";
    else
        echo "Ann�e de naissance : ".$_POST['anneeNaissance'];
    
}    

?>