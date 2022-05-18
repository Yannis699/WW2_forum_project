<?php

require_once('../db.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1> Inscription</h1>
        <form action="" method="post">
            <label for="pseudo">pseudo</label>
            <input type="text" name="pseudo" id="pseudo">

            <label for="mail">Courriel</label>
            <input type="email" name="mail" id="mail">

            <label for="">Confirmation du courriel</label>
            <input type="email" name="confmail" id="confmail">

            <label for=""> Mot de passe </label>
            <input type="password" name="password" id="">
        </form>
</body>
</html>