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
    <title>Afficher les membres</title>
</head>
<body>
    <!-- Afficher les membres -->
    <?php
     $recupUsers = $bdd->query('SELECT * FROM membres');
    while($user = $recupUsers->fetch()){
        ?>
        <p><?= $user['pseudo']; ?><a href="bannir.php?id=<?= $user['id']; ?>"> Bannir le membre </a></p>
        <?php
    }

    ?>
    <a href="membres.php">Afficher tous les membres</a>
    <a href="publier-article.php">Publier un nouvel article</a>
    <!-- Fin afficher tous les membres -->

</body>
</html>