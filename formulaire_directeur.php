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
                <legend>Insertion dans la table directeur</legend>
            
			<!-- NOM ---------------------------------------------------- -->
			
                <?php if($isValidNom){ ?>
                  <div class="control-group">    
                      <label class="control-label" for="nomDirecteur">Nom*</label>
                      <div class="controls">
                          <input type="text" name="nomDirecteur" id="nomDirecteur" placeholder="Nom" value="<?php verifRempli('nomDirecteur'); ?>" maxlength="20" required> 
                      </div>
                  </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="nomDirecteur">Nom*</label>
                      <div class="controls">
                          <input type="text" name="nomDirecteur" id="nomDirecteur" maxlength = "20" required>
                          <span class="help-inline"> <?php echo $typeErrorNom; ?> </span>
                      </div>
                  </div>
                <?php } ?>
				
			<!-- PRENOM ----------------------------------------------------  -->
                
                <?php if($isValidPrenom){ ?>            
                    <div class="control-group">    
                        <label class="control-label" for="prenomDirecteur">Prénom*</label>
                        <div class="controls">
                            <input type="text" name="prenomDirecteur" id="prenomDirecteur" placeholder="Prénom" value="<?php verifRempli('prenomDirecteur'); ?>" maxlength="20" required>
                        </div>
                    </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="prenomCourreur">Prénom*</label>
                      <div class="controls">
                          <input type="text" name="prenomDirecteur" id="prenomDirecteur" maxlength = "20" required>
                          <span class="help-inline"> <?php echo $typeErrorPrenom; ?> </span>
                      </div>
                  </div>
                <?php } ?>
			
			<!-- BOUTON VALIDER ----------------------------------------------------  -->	
				
                <div class="controls">
                    <input type="submit" name="validerForm" class="btn" value="Valider">
                </div>
				
				<p> * : champs obligatoire </p>
				
			</form>
        </div>
    </body>
</html>