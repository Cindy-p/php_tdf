<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="application/x-www-form-urlencoded">
    <p><b>Insertion dans la table coureur : </b></p>
    <label for="nomCoureur">Nom : </label><input type="text" name="nomCoureur" id="nomCoureur"/><br />
    <label for="prenomCoureur">Prénom : </label><input type="text" name="prenomCoureur" id="prenomCoureur"/><br />
    <label for="anneeNaissance">Année de naissance : </label><input type="text" name="anneeNaissance" id="anneeNaissance"/><br />
    <label for="codeTdf">Pays : </label><input type="text" name="codeTdf" id="codeTdf"/><br />
    <label for="anneeTdf">Année du Tour de France : </label><input type="text" name="anneeTdf" id="anneeTdf"/><br />
    <input type="submit" name="valider" />
</form>
</html>