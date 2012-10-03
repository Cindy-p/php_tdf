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
                <legend>Insertion dans la table coureur</legend>
            
			<!-- NOM ---------------------------------------------------- -->
			
                <?php if($isValidNom){ ?>
                  <div class="control-group">    
                      <label class="control-label" for="nomCoureur">Nom*</label>
                      <div class="controls">
                          <input type="text" name="nomCoureur" id="nomCoureur" maxlength = "30" placeholder="Nom" value="<?php verifRempli('nomCoureur'); ?>" maxlength="30" required> 
                      </div>
                  </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="nomCoureur">Nom*</label>
                      <div class="controls">
                          <input type="text" name="nomCoureur" id="nomCoureur" maxlength = "30" required>
                          <span class="help-inline"> <?php echo $typeErrorNom; ?> </span>
                      </div>
                  </div>
                <?php } ?>
				
			<!-- PRENOM ----------------------------------------------------  -->
                
                <?php if($isValidPrenom){ ?>            
                    <div class="control-group">    
                        <label class="control-label" for="prenomCoureur">Prénom*</label>
                        <div class="controls">
                            <input type="text" name="prenomCoureur" id="prenomCoureur" placeholder="Prénom" value="<?php verifRempli('prenomCoureur'); ?>" maxlength="30" required>
                        </div>
                    </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="prenomCourreur">Prénom*</label>
                      <div class="controls">
                          <input type="text" name="prenomCoureur" id="prenomCoureur" maxlength = "30" required>
                          <span class="help-inline"> <?php echo $typeErrorPrenom; ?> </span>
                      </div>
                  </div>
                <?php } ?>
				
			<!-- ANNEE DE NAISSANCE ----------------------------------------------------  -->
            
                <div class="control-group">    
                    <label class="control-label" for="anneeNaissance"> Année de naissance </label>
                    <div class="controls">
                        <select name ="anneeNaissance" id ="anneeNaissance" size ="1">
							<option><?php echo ''; ?></option>
                            <?php for ($i=1900 ; $i<=(date('Y')-17) ; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php verifSelect('anneeNaissance', $i); ?>> <?php echo $i; ?> </option>
							<?php endfor; ?>
                        </select>
                    </div>
                </div>
				
			<!-- PAYS ----------------------------------------------------  -->
            
                <div class="control-group">
                    <label class="control-label" for="nomPays"> Pays* </label>
                    <div class="controls">
                        <select name="nomPays" id = "nomPays" size="1" required>
                            <option><?php echo ''; ?></option>
							<?php
                                $req = $conn->query("select NOM from TDF_PAYS order by NOM");
                                while ($donnees = $req->fetch()) { ?>
                                    <option value="<?php echo $donnees['NOM']; ?>" <?php verifSelect('nomPays', $donnees['NOM']); ?> > <?php echo $donnees['NOM']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
				
			<!-- ANNEE TDF ----------------------------------------------------  -->
                
                <div class="control-group">    
                    <label class="control-label" for="anneeTdf">Année de participation</label>
                    <div class="controls">
                        <select name="anneeTdf" id = "anneeTdf" size="1">
                            <option><?php echo ''; ?></option>
							<?php
                                $req = $conn->query("select ANNEE from TDF_ANNEE order by ANNEE");
                                while ($donnees = $req->fetch()) { ?>
                                    <option value="<?php echo $donnees['ANNEE']; ?>" <?php verifSelect('anneeTdf', $donnees['ANNEE']); ?> > <?php echo $donnees['ANNEE']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            
			<!-- COMPTE ORACLE ET DATE INSERT ----------------------------------------------------  -->
			
				<input type = "hidden" name = "date_insert" value = "<?php echo date("d/m/y"); ?>" >
				<input type = "hidden" name = "compte_oracle" value = "cindy.perat" >
				
			<!-- BOUTON VALIDER ----------------------------------------------------  -->	
				
                <div class="controls">
                    <button type="submit" class="btn"/>Valider</button>
                </div>
				
				<p> * : champs obligatoire </p>
            </form>
        </div>
    </body>
</html>