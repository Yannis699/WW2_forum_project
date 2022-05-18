<?php

require_once('db.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];

    $recupArticle = $bdd->prepare('SELECT * FROM Article WHERE id = ?');
    $recupArticle->execute(array($getid));
    if ($recupArticle->rowCount() > 0) {
        $articleInfos = $recupArticle->fetch();
        $titre = $articleInfos['Titre'];
        $description =  str_replace('<br/>', '', $articleInfos['Contenu']);


        if (isset($_POST['valider'])) {
            $titre_saisi = htmlspecialchars($_POST['Titre']);
            $description_saisie = nl2br(htmlspecialchars($_POST['Contenu']));

            $updateArticle = $bdd->prepare('UPDATE Article SET Titre = ?, Contenu = ? WHERE id = ?');
            $updateArticle->execute(array($titre_saisi, $description_saisie, $getid));

            header('Location:articles.php');
        }
    } else {
        echo "Aucun article trouvé";
    }
} else {
    echo "Aucun identifiant trouvé";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="Titre" id="Titre" value="<?= $titre; ?>">
        <br>
        <textarea name="Contenu"> <?= $description; ?> </textarea>
        <input type="submit" name="valider" value="valider">
    </form>
</body>

</html>