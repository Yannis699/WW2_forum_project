<?php

session_start();
require_once('db.php');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher l'ensemble des articles</title>
</head>
<body>
    <?php 
        $recupArticles = $bdd->query('SELECT * FROM Article');
        while($article = $recupArticles->fetch()){
            ?>
            <div class="article">
                <h1><?= $article['Titre'] ?></h1>
            </div>
            <div>
                <p><?= $article['Contenu']?></p>
            </div>
            <a href="supprimer_article.php?id=<?= $article['id']; ?>">
                <button> Supprimer l'article </button>
            </a>
            <a href="modifier_article.php?id=<?= $article['id']; ?>">
                <button> Modifier l'article </button>
            </a>
            <?php
        }
    ?>
</body>
</html>