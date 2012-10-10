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
							<?php for ($i = 1996 ; $i <= date('Y') ; $i++){ ?>
                                <option value="<?php echo $i; ?>" <?php verifSelect('n_epreuve', $i); ?>> <?php echo $i; ?> </option>
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
						<input type="text" name="villeD" id="villeD" placeholder="Ville de départ" value="<?php verifRempli('villeD'); ?>" maxlength="30" required> 
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
						<input type="text" name="villeA" id="villeA" placeholder="Ville d'arrivée" value="<?php verifRempli('villeA'); ?>" maxlength="30" required> 
                    </div>
                </div>
		
			<!-- JOUR EPREUVE ----------------------------------------------- -->
			
			<div class="control-group">    
                    <label class="control-label" for="anneeTdf">Jour épreuve*</label>
                    <div class="controls">
                        <input type="date" name="dateEpreuve">  <!-- à voir si je conserve -->
                    </div>
                </div>
			
			<!-- CODE CATEGORIE --------------------------------------------  -->

			
			
			<!-- BOUTON VALIDER --------------------------------------------  -->	
				
                <div class="controls">
                    <button type="submit" class="btn"/>Valider</button>
                </div>
				
				<p> * : champs obligatoire </p>
            </form>
        </div>
    </body>
</html>