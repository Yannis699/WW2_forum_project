<?php

require_once('../db.php');

var_dump($_POST);

$valid = (boolean) true;

    if (isset($_POST['inscription'])) {

        $data = array_map('trim', $_POST);
        extract($data);

        $pseudo = $data['pseudo'];
        $mail = $data['mail'];
        $confmail = $data['confmail'];
        $password = $data['password'];
        $confpassword = $data['confpassword'];

        var_dump($data);
        if(empty($pseudo)){
            $valid = false;
            $err_pseudo = "Ce champ ne peut pas être vide";
        }else{
            $req = $bdd->prepare("SELECT id FROM User WHERE pseudo = ?");
            $req->execute(array($pseudo));
            $req =  $req->fetch();

            if(isset($req['id'])){
                $valid = false;
                $err_pseudo = "Ce pseudo est déjà pris";

            }
        }

        if(empty($mail)){
            $valid = false;
            $err_mail = "Ce champ ne peut pas être vide";
        }

        elseif($mail != $confmail){
            $valid = false;
            $err_mail = "Le mail est différent de la confirmation";

        } else {
            $req = $bdd->prepare['SELECT id FROM User WHERE mail = ?'];
            $req->execute(array($mail));
            $req = $rq->fetch();
        }

        if(empty($password)){
            $valid = false;
            $err_password = "Le champ ne peut pas être vide";

        } elseif($password != $confpassword){
            $valid = false;
            $err_password = "Vous avez deux différents mots de passe";
        }

        if($valid){
            echo 'ok';
        }else{
            echo "Vous avez fait une ou plusieurs erreurs";
        }
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

        <?php if(isset($err_pseudo)) {echo '<div>' . $err_pseudo . '<div>' ; }?>

        <label for="pseudo">pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value=" <?php if(isset($pseudo)){ echo $pseudo;} ?>">

        <label for="mail">Courriel</label>
        <input type="email" name="mail" id="mail" value=" <?php if(isset($mail)){ echo $mail;} ?>">

        <label for="">Confirmation du courriel</label>
        <input type="email" name="confmail" id="confmail">

        <?php if(isset($err_password)) { echo '<div>' . $err_password . '<div>';} ?>
        <label for=""> Mot de passe </label>
        <input type="password" name="password" id="" value= "">

        <label for=""> Confirmation mot de passe </label>
        <input type="password" name="confpassword" id="">

        <button type="submit" name="inscription">Inscription</button>
    </form>
</body>

</html>