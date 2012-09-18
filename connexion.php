<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  </head>
  <body>
    <div class="container">
      <form class="form-inline" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
        <legend>Connexion</legend>
          <div class="controls">
              <div class="input-prepend">
                  <span class="add-on"><i class="icon-user"></i></span>
                  <input name="db_username" type="text" class="input-small" placeholder="Pseudo">
              </div>
              <input name="db_password" type="password" class="input-small" placeholder="Mot de passe">
              <label class="checkbox">
                  <input type="checkbox"> Se souvenir de moi
              </label>
              <button type="submit" class="btn">Se connecter</button>
          </div>
        </form>
      </div>
    </body>
</html>