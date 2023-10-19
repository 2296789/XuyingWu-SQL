<?php
if(isset($_GET['id']) && $_GET['id']!=null ){
    $id= $_GET['id'];
    require_once('class/CRUD.php');
    $crud = new CRUD;
    $article = $crud->selectId('article', $id);
    extract($article);
    $categorie = $crud->select('categorie', 'categorie');
    $auteur = $crud->select('utilisateur', 'nom');
}else{
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Modifie un article</title>
</head>
<body>

    <h1>Article Modifier </h1>
    <form action="article-update.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">

        <h3>Titre : </h3>
        <textarea type="text" name="titre"><?= $titre; ?></textarea>

        <h3>Text : </h3>
        <textarea type="text" name="text" ><?= $text; ?></textarea>
        
        <h3>Categorie : </h3>
            <select name="categorie_id">
            <?php
                foreach($categorie as $row){
            ?>
                <option value="<?= $row['id'];?>"><?= $row['categorie'];?></option>
            <?php
                }
            ?>
            </select>
        </label>      
 
        <h3>Auteur : </h3>
            <select name="auteur_id">
            <?php
                foreach($auteur as $row){
            ?>
                <option value="<?= $row['id'];?>"><?= $row['nom'];?></option>
            <?php
                }
            ?>
            </select>
        </label>        
        <br><br>
        <button type="submit">Modifier</button>
    </form>
    <button><a href="index.php">Retour</a></button>
</body>
</html>