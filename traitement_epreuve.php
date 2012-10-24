<?php


//--------------- DEPART ---------------

if(isset($_POST['villeD'])){
	$villeD = htmlspecialchars($_POST['villeD']);
  
	if(preg_match("#^.{0,1}$#", $villeD)){
		$typeErrorNomD = "La nom de ville saisi est trop court";
		$isValidNomD = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|]|[-]{3,}|[-| ]$#", $villeD)){
        $typeErrorNomD = "Le nom de ville saisi contient des caractères interdits";
		$isValidNomD = false;
	}
	else {
        $villeD = traitementAccents($villeD);
        $villeD = strtoupper($villeD);
		
		$villeD = suppr_inutile(" ", $villeD);
		$villeD = suppr_inutile("-", $villeD); 
		$villeD = suppr_inutile("'", $villeD);
		
		if(preg_match("#^[a-zA-Z\' -]{0,}[0-9]{0,1}[a-zA-Z\' -]{0,}$#", $villeD)){
			$isValidNomD = true;
		}
		else{
			$typeErrorNomD = "Le nom de ville saisie contient des caractères interdits";
			$isValidNomD = false;
		}
		
	if($isValidNomD)
      echo $villeD."<br />";
	}
}  
//--------------- ARRIVEE ---------------

if(isset($_POST['villeA'])){
	$villeA = htmlspecialchars($_POST['villeA']);
  
	if(preg_match("#^.{0,1}$#", $villeA)){
		$typeErrorNomA = "La nom de ville saisi est trop court";
		$isValidNomA = false;
	}
	else if (preg_match("#^[ |-]|[\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\"%&,/:;@~_\|]|[-]{3,}|[-| ]$#", $villeA)){
        $typeErrorNomA = "La ville saisie contient des caractères interdits";
		$isValidNomA = false;
	}
	else {
        $villeA = traitementAccents($villeA);
        $villeA = strtoupper($villeA);
		
		$villeA = suppr_inutile(" ", $villeA);
		$villeA = suppr_inutile("-", $villeA); 
		$villeA = suppr_inutile("'", $villeA);
		
		if(preg_match("#^[a-zA-Z\' -]{0,}[0-9]{0,1}[a-zA-Z\' -]{0,}$#", $villeA)){
			$isValidNomA = true;
		}
		else{
			$typeErrorNomA = "La ville saisie contient des caractères interdits";
			$isValidNomA = false;
		}
		
	if($isValidNomA)
      echo $villeA."<br />";
	}  
}	

//--------------- JOUR EPREUVE ---------------

if(isset($_POST['jourTDF'])){
	$jourTDF = htmlspecialchars($_POST['jourTDF']);
	
	if(preg_match("#[^0-9]#", $jourTDF)){
		$isValidJourTDF = false;
		$typeErrorJourTDF = "le jour doit être un nombre";
	}
	else{
		if(preg_match("#[13578]|1[02]#", $_POST['moisTDF'])){
			if($jourTDF > 0 and $jourTDF <= 31)
				$isValidJourTDF = true;
			else {
				$isValidJourTDF = false;
				$typeErrorJourTDF = "le mois séléctionné ne comporte que 31 jours";
			}
		}
		else if(preg_match("#[2469]|11#", $_POST['moisTDF'])){
			if($_POST['moisTDF'] == 2){
				if($_POST['anneeTdf']%400 == 0 or ($_POST['anneeTdf']%4 == 0 and $_POST['anneeTdf']%100 != 0)){
					if($jourTDF > 0 and $jourTDF <= 29)
						$isValidJourTDF = true;
					else {
						$isValidJourTDF = false;
						$typeErrorJourTDF = "le mois séléctionné ne comporte que 29 jours";
					}
				}
				else {
					if($jourTDF > 0 and $jourTDF <= 28)
						$isValidJourTDF = true;
					else {
						$isValidJourTDF = false;
						$typeErrorJourTDF = "le mois séléctionné ne comporte que 28 jours";
					}	
				}
				
			}
			else {
				if($jourTDF > 0 and $jourTDF <= 30)
					$isValidJourTDF = true;
				else {
					$isValidJourTDF = false;
					$typeErrorJourTDF = "le mois séléctionné ne comporte que 30 jours";
				}
			}
		}
	}
}

//--------------- DISTANCE ---------------
	
if(isset($_POST['distance'])){
	$distance = htmlspecialchars($_POST['distance']);
	
	if(preg_match("#[^(0-9,\.)]#", $distance)){
		$isValidDistance = false;
		$typeErrorDistance = "la distance doit être un nombre";
	}
	else {
		if(preg_match("#^[1-9][0-9]{1,2}([,\.][0-9])?$#", $distance)){
			$isValidDistance = true;
			if(preg_match("#\.#", $distance))
				$distance = preg_replace("#\.#", ",", $distance);
			if(preg_match("#,0#", $distance))
				$distance = preg_replace("#,0#", "", $distance); 
		}
		else{
			$isValidDistance = false;
			$typeErrorDistance = "La distance saisie est incorecte";
		}
	}
	
	if($isValidDistance)
		echo $distance."<br>";
}

//--------------- MOYENNE  ---------------
	
if(isset($_POST['moyenne'])){
	$moyenne = htmlspecialchars($_POST['moyenne']);
	
	if(preg_match("#[^(0-9,\.)]#", $moyenne)){
		$isValidMoyenne = false;
		$typeErrorMoyenne = "la vitesse moyenne doit être un nombre";
	}
	else {
		if(preg_match("#^[1-9][0-9]([,\.][0-9]{1,3})?$#", $moyenne)){
			$isValidMoyenne = true;
			if(preg_match("#\.#", $moyenne))
				$moyenne = preg_replace("#\.#", ",", $moyenne);
			if(preg_match("#,0#", $moyenne))
				$moyenne = preg_replace("#,0#", "", $moyenne);
		}
		else{
			$isValidMoyenne = false;
			$typeErrorMoyenne = "La vitesse saisie est incorecte";
		}
	}
	
	if($isValidMoyenne)
		echo $moyenne."<br>";
}

//--------------- TYPE EPREUVE (CODE CAT) ---------------

if(isset($_POST['catE']) and isset($_POST['n_epreuve'])){
	if($_POST['n_epreuve'] == 0 and $_POST['catE'] != "Prologue"){
		echo "c'est faux !";
		$isValidTypeE = false;
		$typeErrorTypeE = "n_epreuve = 0 : l'étape doit être le prologue";
	
	}
	if($_POST['n_epreuve'] != 0 and $_POST['catE'] == "Prologue"){
		echo "c'est faux !";
		$isValidTypeE = false;
		$typeErrorTypeE = "Seule l'épreuve n° 0 peut être prologue";
	
	}
}




//--------------- FONCTIONS DE TRAITEMENT ---------------

function suppr_inutile($separateur, $chaine){
	
	if(preg_match("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", $chaine))
		$chaine = preg_replace("#( ){1,}$separateur( ){1,}|( ){1,}$separateur|$separateur( ){1,}#", "$separateur", $chaine);
	if(preg_match("#('){2,}#", $chaine))
		$chaine = preg_replace("#('){2,}#", "'", $chaine);
	if(preg_match("#('){1,}-('){1,}|('){1,}-|-('){1,}|('){2,}|('){1,}( ){1,}('){1,}|('){1,}( ){1,}('){1,}#", $chaine))
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
		
	if(preg_match("#[ıİÿŸ]#", $chaine))
		$chaine = preg_replace("#[ıİÿŸ]#", "y", $chaine);
	
	if(preg_match("#[ß]#", $chaine))
		$chaine = preg_replace("#[ß]#", "ss", $chaine);
		
	return $chaine;
}

function motCompose($separateur, $chaine){
		
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

?>