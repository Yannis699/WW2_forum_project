<?php

require_once('../db.php');


    if (isset($_POST['inscription'])) {

        $data = array_map('trim', $_POST);
        extract($data);

        $valid = (boolean) true;

        $pseudo = $data['pseudo'];
        $mail = $data['mail'];
        $confmail = $data['confmail'];
        $password = $data['password'];
        $confpassword = $data['confpassword'];
        //echo iconv_strlen($pseudo, 'UTF-8'); exit;

        if(empty($pseudo)){
            $valid = false;
            $err_pseudo = "Ce champ ne peut pas être vide";
        }

        elseif(grapheme_strlen($pseudo) < 5){
            $valid = false;
            $err_pseudo = "Le pseudo doit faire plus de caractères";
        }
        elseif(grapheme_strlen($pseudo)>18){
            $valid = false;
            $err_pseudo = "Le pseudo doit faire moins de 18 caractères ; le vôtre fait (" . grapheme_strlen($pseudo) . "/18;";
        }
        else{
            $req = $bdd->prepare("SELECT id FROM User WHERE pseudo = ?");
            $req->execute(array($pseudo));
            $req =  $req->fetch();

            if(isset($req['id'])){
                $valid = false;
                $err_pseudo = "Ce pseudo est déjà pris";
                echo $err_pseudo;

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
            $req = $bdd->prepare('SELECT id FROM User WHERE mail = ?');
            $req->execute(array($mail));
            $req = $req->fetch();
        }

        if(empty($password)){
            $valid = false;
            $err_password = "Le champ ne peut pas être vide";

        } 
        
        elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $valid = false;
            $err_mail = "Format mail invalide";
        }
        
        elseif($password != $confpassword){
            $valid = false;
            $err_password = "Vous avez deux différents mots de passe";
        } 

        if($valid){
            //$cryptPassword = crypt($password, '$2a$07$fheuihrf77838Y.?/.UIHIUF$' );
            $cryptPassword = password_hash($password, PASSWORD_ARGON2ID);
            $date_creation = date('Y-m-d H:i:s');
            $insertUser = $bdd->prepare("INSERT INTO User(pseudo, mail, mdp, date_creation, date_connexion) VALUES (?,?,?,?,?)");
            $insertUser->execute(array($pseudo, $mail, $cryptPassword, $date_creation, $date_creation));
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

        <?php if(isset($err_mail)) {echo '<div>' . $err_mail . '<div>' ; }?>
        <label for="mail">Courriel</label>
        <input type="email" name="mail" id="mail" value=" <?php if(isset($mail)){ echo $mail;} ?>">

        <label for="">Confirmation du courriel</label>
        <input type="email" name="confmail" id="confmail">

        <?php if(isset($err_password)) { echo '<div>' . $err_password . '<div>';} ?>
        <label for=""> Mot de passe </label>
        <input type="password" name="password" id="" value= "">

        <label for=""> Confirmation mot de passe </label>
        <input type="password" name="confpassword" id="confpassword">

        <button type="submit" name="inscription">Inscription</button>
    </form>
</body>

</html>