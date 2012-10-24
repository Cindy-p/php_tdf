<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    
    <body>
		<?php
            function verifSelect($name, $value){
                if (isset($_POST[$name])) {
                    if ($_POST[$name] == $value)
                        echo "selected";
                }
            }
        ?>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <legend>Insertion dans la table année</legend>
            
			<!-- ANNEE ------------------------------------------------------------- -->
			
                <div class="control-group">    
                    <label class="control-label" for="anneeTdf"> Année* </label>
                    <div class="controls">
                        <select name ="anneeTdf" id ="anneeTdf" size ="1" required>
							<option><?php echo ''; ?></option>
                            <?php for ($i=1903 ; $i<=date('Y')+1 ; $i++) { ?>
                                <?php if (($i < 1915 or $i > 1918) and ($i < 1940 or $i > 1946)) { ?>
                                    <option value="<?php echo $i; ?>" <?php verifSelect('anneeTdf', $i); ?>> <?php echo $i; ?> </option>
                                <?php } ?>
							<?php } ?>
                        </select>
                    </div>
                </div>
				
			<!-- JOUR DE REPOS ----------------------------------------------------  -->
                
                <div class="control-group">    
                    <label class="control-label" for="jourRepos"> Jours de repos* </label>
                    <div class="controls">
                        <select name ="jourRepos" id ="jourRepos" size ="1" required>
							<option><?php echo ''; ?></option>
                            <?php for ($i=1 ; $i<=4 ; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php verifSelect('jourRepos', $i); ?>> <?php echo $i; ?> </option>
							<?php } ?>
                        </select>
                    </div>
                </div>
			
			<!-- BOUTON VALIDER ----------------------------------------------------  -->	
				
                <div class="controls">
                    <button type="submit" class="btn"/>Valider</button>
                </div>
				
				<p> * : champs obligatoire </p>
				
			</form>
        </div>
    </body>
</html>