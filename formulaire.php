<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    
    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <legend>Insertion dans la table coureur</legend>
                                
                <?php if ($isValid == 1): ?>
                  <div class="control-group">    
                      <label class="control-label" for="nomCoureur"> Nom </label>
                      <div class="controls">
                          <input type="text" name="nomCoureur" id="nomCoureur" placeholder="Nom">
                      </div>
                  </div>
                <?php else: ?>
                  <div class="control-group error">
                      <label class="control-label" for="inputError">Nom</label>
                      <div class="controls">
                          <input type="text" id="inputError">
                          <span class="help-inline">Veuillez entrer un nom valide</span>
                      </div>
                  </div>
                <?php endif; ?>
                
                            
                <div class="control-group">    
                    <label class="control-label" for="prenomCoureur">Prénom</label>
                    <div class="controls">
                        <input type="text" name="prenomCoureur" id="prenomCoureur" placeholder="Prénom">
                    </div>
                </div>
            
                <div class="control-group">    
                    <label class="control-label" for="anneeNaissance"> Année de naissance </label>
                    <div class="controls">
                        <select>
                            <?php for ($i=1900 ; $i<=(date('Y')-17) ; $i++): ?>
                                <option><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            
                <div class="control-group">
                    <label class="control-label" for="codeTdf"> Pays </label>
                    <div class="controls">
                        <input type="text" name="codeTdf" id="codeTdf" placeholder="Pays">
                    </div>
                </div>
                
                <div class="control-group">    
                    <label class="control-label" for="anneeTdf">Année de participation</label>
                    <div class="controls">
                        <select>
                            <?php for ($i=1900 ; $i<=date('Y') ; $i++): ?>
                                <option><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            
                <div class="controls">
                    <button type="submit" class="btn"/>Valider</button>
                </div>
            </form>
        </div>
    </body>
</html>