<?php

session_start();
if (isset($_POST['connexion'])) {

    $data = array_map('trim', $_POST);
    extract($data);

    $pseudo = $data['pseudo'];
    $password = $data['mdp'];


    if (!empty($data['pseudo']) && !empty($data['mdp'])) {
        $pseudo_par_defaut = "admin";
        require_once('db.php');

        $pseudo_saisi = htmlspecialchars($data['pseudo']);
        $mdp_saisi = htmlspecialchars($data['mdp']);

        if ($pseudo_saisi == $pseudo_par_defaut && $mdp_saisi == $mdp_par_defaut) {
            $_SESSION['mdp'] = $mdp_saisi;
            header('Location: index.php');
        } else {
            echo "La combinaison est incorrect";
            die();
        }
    } else {
        echo 'Veuillez compléter tous les champs...';
        die();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de connexion</title>
</head>

<body>
    <h1> Se connecter</h1>
    <form action="" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" autocomplete="off">
        <br>
        <label for="password">Mot de passe</label>
        <input type="password" name="mdp">
        <br><br>
        <button type="submit" name="connexion"> Se connecter </button>
    </form>
</body>

</html>