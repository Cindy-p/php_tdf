<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    </head>
    
    <body>
        <div class="container">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
                <legend>Insertion dans la table coureur</legend>
                                
                <?php if($isValidNom){ ?>
                  <div class="control-group">    
                      <label class="control-label" for="nomCoureur">Nom</label>
                      <div class="controls">
                          <input type="text" name="nomCoureur" id="nomCoureur" placeholder="Nom">
                      </div>
                  </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="nomCoureur">Nom</label>
                      <div class="controls">
                          <input type="text" name="nomCoureur" id="nomCoureur">
                          <span class="help-inline">Veuillez entrer un nom valide</span>
                      </div>
                  </div>
                <?php } ?>
                
                <?php if($isValidPrenom){ ?>            
                    <div class="control-group">    
                        <label class="control-label" for="prenomCoureur">Prénom</label>
                        <div class="controls">
                            <input type="text" name="prenomCoureur" id="prenomCoureur" placeholder="Prénom">
                        </div>
                    </div>
                <?php }else{ ?>
                  <div class="control-group error">
                      <label class="control-label" for="prenomCourreur">Prénom</label>
                      <div class="controls">
                          <input type="text" name="prenomCoureur" id="prenomCoureur">
                          <span class="help-inline">Veuillez entrer un prénom valide</span>
                      </div>
                  </div>
                <?php } ?>
            
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
                        <select name="nomPays" size="1">
                            <?php
                                $req = $conn->query("select NOM from TDF_PAYS order by NOM");
                                while ($donnees = $req->fetch()) {
                                    echo '<option value="'.$donnees['NOM'].'">' .$donnees['NOM']. '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">    
                    <label class="control-label" for="anneeTdf">Année de participation</label>
                    <div class="controls">
                        <select name="anneeTdf" size="1">
                            <?php
                                $req = $conn->query("select ANNEE from TDF_ANNEE order by ANNEE");
                                while ($donnees = $req->fetch()) {
                                    echo '<option value="'.$donnees['ANNEE'].'">' .$donnees['ANNEE']. '</option>';
                                }
                            ?>
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