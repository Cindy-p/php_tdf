<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    
    <body>
		<?php
            function verifRempli($n) {
                if (isset($_POST[$n])) {
                    $var = $_POST[$n];
                    if ($var <> '')
                        echo $var;
                }
            }
            
            function verifSelect($name, $value){
                if (isset($_POST[$name])) {
                    if ($_POST[$name] == $value)
                        echo "selected";
                }
            }
        ?>
        
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <legend>Insertion dans la table épreuve</legend>
            
			
			<!-- ANNEE TDF ----------------------------------------------------  -->
				
				<div class="control-group">    
                    <label class="control-label" for="anneeTdf">Année Tour de France*</label>
                    <div class="controls">
                        <select name="anneeTdf" id = "anneeTdf" size="1" required>
                            <option><?php echo ''; ?></option>
							<?php
                                $req = $conn->query("select ANNEE from TDF_ANNEE_BIDON order by ANNEE");
                                while ($donnees = $req->fetch()) { ?>
                                    <option value="<?php echo $donnees['ANNEE']; ?>" <?php verifSelect('anneeTdf', $donnees['ANNEE']); ?> > <?php echo $donnees['ANNEE']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
				
			<!-- N_EPREUVE -------------------------------------------------- -->
			
			<div class="control-group">    
                    <label class="control-label" for="n_epreuve"> N° épreuve*</label>
                    <div class="controls">
                        <select name ="n_epreuve" id ="n_epreuve" size ="1" required>
							<option><?php echo ''; ?></option>
								<?php for ($i = 0 ; $i <= 30 ; $i++){ ?>
									<option value="<?php echo $i; ?>" <?php verifSelect('n_epreuve', $i); ?>> <?php echo $i; ?> </option>
								<?php } ?>
                        </select>
                    </div>
                </div>
								
			<!-- DEPART ----------------------------------------------------  -->
                
                <div class="control-group">
                    <label class="control-label" for="paysD"> Départ* </label>
                    <div class="controls">
                        <select name="paysD" id = "paysD" size="1" required>
                            <option><?php echo ''; ?></option>
							<?php
                                $req = $conn->query("select NOM from TDF_PAYS order by NOM");
                                while ($donnees = $req->fetch()) { ?>
                                    <option value="<?php echo $donnees['NOM']; ?>" <?php verifSelect('paysD', $donnees['NOM']); ?> > <?php echo $donnees['NOM']; ?> </option>
                            <?php } ?>
                        </select>
						<?php if($isValidNomD) { ?>
							<input type="text" name="villeD" id="villeD" placeholder="Ville de départ" value="<?php verifRempli('villeD'); ?>" maxlength="40" required> 
						<?php } else { ?>
						<span class="control-group error">
							<input type="text" name="villeD" id="villeD" maxlength="40" required> 
							<span class="help-inline"> <?php echo $typeErrorNomD; ?> </span>
						</span>
						<?php } ?>
					</div>
                </div>
				
			<!-- ARRIVEE ---------------------------------------------------  -->
                
                <div class="control-group">
                    <label class="control-label" for="paysA"> Arrivée* </label>
                    <div class="controls">
                        <select name="paysA" id = "paysA" size="1" required>
                            <option><?php echo ''; ?></option>
							<?php
                                $req = $conn->query("select NOM from TDF_PAYS order by NOM");
                                while ($donnees = $req->fetch()) { ?>
                                    <option value="<?php echo $donnees['NOM']; ?>" <?php verifSelect('paysA', $donnees['NOM']); ?> > <?php echo $donnees['NOM']; ?> </option>
                            <?php } ?>
                        </select>
						<?php if($isValidNomA) { ?>
							<input type="text" name="villeA" id="villeA" placeholder="Ville d'arrivée" value="<?php verifRempli('villeA'); ?>" maxlength="40" required> 
						<?php } else { ?>
						<span class="control-group error">
							<input type="text" name="villeA" id="villeA" maxlength="40" required> 
							<span class="help-inline"> <?php echo $typeErrorNomA; ?> </span>
						</span>
						<?php } ?>
                    </div>
                </div>
		
			<!-- JOUR EPREUVE ----------------------------------------------- -->
			
			<div class="control-group">   
				<label class="control-label" for="jourEpreuve">Date épreuve*</label>
				<div class="controls">
					
					<select name ="moisTDF" id ="moisTDF" size ="1" required>
						<option><?php echo ''; ?></option>	
						<option value="1" <?php verifSelect('moisTDF', "1"); ?>> janvier </option>
						<option value="2" <?php verifSelect('moisTDF', "2"); ?>> février </option>
						<option value="3" <?php verifSelect('moisTDF', "3"); ?>> mars </option>
						<option value="4" <?php verifSelect('moisTDF', "4"); ?>> avril </option>
						<option value="5" <?php verifSelect('moisTDF', "5"); ?>> mai </option>
						<option value="6" <?php verifSelect('moisTDF', "6"); ?>> juin </option>
						<option value="7" <?php verifSelect('moisTDF', "7"); ?>> juillet </option>
						<option value="8" <?php verifSelect('moisTDF', "8"); ?>> août </option>
						<option value="9" <?php verifSelect('moisTDF', "9"); ?>> septembre </option>
						<option value="10" <?php verifSelect('moisTDF', "10"); ?>> octobre </option>
						<option value="11" <?php verifSelect('moisTDF', "11"); ?>> novembre </option>
						<option value="12" <?php verifSelect('moisTDF', "12"); ?>> décembre </option>
							
					</select>
					
					<?php if($isValidJourTDF) { ?>
						<input type="text" name="jourTDF" id="jourTDF" value="<?php verifRempli('jourTDF'); ?>" maxlength="2" required>
					<?php } else { ?>
					<span class="control-group error">
						<input type="text" name="jourTDF" id="jourTDF"  maxlength="2" required>
						<span class="help-inline"> <?php echo $typeErrorJourTDF; ?> </span>
					</span>
					<?php } ?>
					
				</div>
            </div>
			
			<!-- CODE CATEGORIE --------------------------------------------  -->
			
			<div class="control-group">    
				<label class="control-label" for="catE">Type épreuve*</label>
				<div class="controls">
					<?php if($isValidTypeE) { ?>
						<select name="catE" id = "catE" size="1" required>
							<option><?php echo ''; ?></option>
							<?php
								$req = $conn->query("select distinct CAT_CODE, LIBELLE from TDF_CATEGORIE_EPREUVE order by CAT_CODE");
								while ($donnees = $req->fetch()) { ?>
									<option value="<?php echo $donnees['LIBELLE']; ?>" <?php verifSelect('catE', $donnees['LIBELLE']); ?> > <?php echo $donnees['LIBELLE']; ?> </option>
							<?php } ?>
						</select>		
					<?php } else { ?>
					<span class="control-group error">
						<select name="catE" id = "catE" size="1" required>
							<option><?php echo ''; ?></option>
							<?php
								$req = $conn->query("select distinct CAT_CODE, LIBELLE from TDF_CATEGORIE_EPREUVE order by CAT_CODE");
								while ($donnees = $req->fetch()) { ?>
									<option value="<?php echo $donnees['LIBELLE']; ?>" > <?php echo $donnees['LIBELLE']; ?> </option>
							<?php } ?>
						</select>
						<span class="help-inline"> <?php echo $typeErrorTypeE; ?> </span>
					</span>
					<?php } ?>
				</div>
            </div>
			
			<!-- DISTANCE --------------------------------------------------  -->
			
			<div class="control-group">    
				<label class="control-label" for="distance">Distance à parcourir*</label>
				<div class="controls">
					<?php if($isValidDistance) { ?>
						<input type="text" name="distance" id="distance" placeholder="distance en km" value="<?php verifRempli('distance'); ?>" maxlength="5" required> 
					<?php } else { ?>
					<span class="control-group error">
						<input type="text" name="distance" id="distance" maxlength="5" required> 
						<span class="help-inline"> <?php echo $typeErrorDistance; ?> </span>
					</span>
					<?php } ?>						
				</div>
            </div>
			
			<!-- VITESSE MOYENNE -------------------------------------------  -->
			
			<div class="control-group">    
				<label class="control-label" for="moyenne">Vitesse moyenne</label>
				<div class="controls">
					<?php if($isValidMoyenne) { ?>
						<input type="text" name="moyenne" id="moyenne" placeholder="vitesse moyenne en km/h" value="<?php verifRempli('moyenne'); ?>" maxlength="6"> 
					<?php } else { ?>
					<span class="control-group error">
						<input type="text" name="moyenne" id="moyenne" maxlength="6"> 
						<span class="help-inline"> <?php echo $typeErrorMoyenne; ?> </span>
					</span>
				<?php } ?>	
				</div>
            </div>
			
			<!-- BOUTON VALIDER --------------------------------------------  -->	
				
                <div class="controls">
                    <input type="submit" name="validerForm" class="btn" value="Valider">
                </div>
				
				<p> * : champs obligatoire </p>
            </form>
        </div>
    </body>
</html>