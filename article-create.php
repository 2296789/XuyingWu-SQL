<?php
require_once('class/CRUD.php');
$crud = new CRUD;
$categorie = $crud->select('categorie', 'categorie');
$auteur = $crud->select('utilisateur', 'nom')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un article</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form action="article-store.php" method="post">

        <h3>Titre</h3>
        <textarea type="text" name="titre"></textarea>

        <h3>Text</h3>
        <textarea type="text" name="text"></textarea>

        <h3>Auteur</h3>
            <select name="auteur_id">
            <?php
                foreach($auteur as $row){
            ?>
                <option value="<?= $row['id'];?>"><?= $row['nom'];?></option>
            <?php
                }
            ?>
            </select>

        <h3>Categorie</h3>
            <select name="categorie_id">
            <?php
                foreach($categorie as $row){
            ?>
                <option value="<?= $row['id'];?>"><?= $row['categorie'];?></option>
            <?php
                }
            ?>
            </select>
        <br><br>
        <button type="submit">Publier</button>
        <br>
        <button><a href="index.php">Retour</a></button>
    </form>
</body>
</html>