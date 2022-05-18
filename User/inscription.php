<?php

require_once('../db.php');

var_dump($_POST);

$valid = true;

    if (isset($_POST['inscription'])) {
        $data = array_map('trim', $_POST);
        extract($data);

        var_dump($data);
    }

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
        <input type="text" name="pseudo" id="pseudo" value=" <?php if(isset($pseudo)){ echo $pseudo;} ?>">

        <label for="mail">Courriel</label>
        <input type="email" name="mail" id="mail" value=" <?php if(isset($mail)){ echo $mail;} ?>">

        <label for="">Confirmation du courriel</label>
        <input type="email" name="confmail" id="confmail">

        <label for=""> Mot de passe </label>
        <input type="password" name="password" id="">

        <label for=""> Confirmation mot de passe </label>
        <input type="Confpassword" name="Confpassword" id="">

        <button type="submit" name="inscription">Inscription</button>
    </form>
</body>

</html>