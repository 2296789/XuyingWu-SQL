<?php
require_once('class/CRUD.php');
$crud = new CRUD;
$article = $crud->select('article', 'titre');
extract($article);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Liste d'article</title>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Categorie</th>
        </tr>
</head>
<body>
    <?php
    foreach($article as $row){
        $categorie = $crud->selectId('categorie', $row['categorie_id']);
        $categorie_nom = $categorie['categorie'];
        $auteur = $crud->selectId('utilisateur', $row['auteur_id']);
        $auteur_nom = $auteur['nom'];
    ?>
        <tr>
            <td><a href="article-show.php?id=<?= $row['id']?>"><?= $row['titre']?></a></td>
            <td><?php print_r($auteur_nom) ?></td>
            <td><?php print_r($categorie_nom) ?></td>
        </tr>
    <?php
    }
    ?>
    </table><br><br>
    <button><a href="article-create.php">Ajouter</a></button>
</body>
</html>