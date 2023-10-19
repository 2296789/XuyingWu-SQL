<?php
if(isset($_GET['id']) && $_GET['id']!=null ){
    $id= $_GET['id'];

    require_once('class/CRUD.php');

    $crud = new CRUD;
    $article = $crud->selectId('article', $id);

    extract($article);
    
    $categorie = $crud->selectId('categorie', $categorie_id);
    $categorie_nom = $categorie['categorie'];

    $auteur = $crud->selectId('utilisateur', $auteur_id);
    $auteur_nom = $auteur['nom'];

    // $commentaire = $crud->selectId('commentaire', $id);
    // $contenu = $commentaire['contenu'];
    // 对于最初设置的article没问题，新增的不行
}else{
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?= $titre; ?></h1>
    <p><?= $text; ?></p>
    <p><strong>Auteur : </strong><?= $auteur_nom; ?></p>
    <p><strong>Categorie : </strong><?= $categorie_nom; ?></p>
    <!-- <p><strong>Commentaire : </strong><?= $contenu ?></p> -->

    <button><a href="article-edit.php?id=<?= $id; ?>">Edit</a></button>
    
    <form action="article-delete.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <button type="submit" name="delete">Delete</button>
        <?php
        if ($crud->ilYaComments($id)) {
            echo "Cet article contient des commentaires connexes qui ne peuvent pas être supprimés.";
        }
        ?>
    </form>
    
    <button><a href="index.php">Retour</a></button>

</body>
</html>