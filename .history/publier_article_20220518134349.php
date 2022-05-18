<?php
session_start();
require_once('db.php');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

if(isset[$_POST['envoi']]){ 
    if(!empty($_POST['titre']) && !empty($_POST['contenu']))
    {

    } else {
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier article</title>
</head>
<body>

<form action="" method="post">
    <input_type="text" name="titre">
    <br>
    <textarea name="description"></textarea>
    <br>
    <input type="submit" name="envoi">
</form>

</body>
</html>