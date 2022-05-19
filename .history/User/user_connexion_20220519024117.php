<?php

require_once('../db.php');


    if (isset($_POST['connexion'])) {

        $data = array_map('trim', $_POST);
        extract($data);

        $valid = (boolean) true;

        $pseudo = $data['pseudo'];
        $password = $data['password'];
        //echo iconv_strlen($pseudo, 'UTF-8'); exit;

        if(empty($pseudo)){
            $valid = false;
            $err_pseudo = "Ce champ ne peut pas être vide";
        }

        if(empty($password)){
            $valid = false;
            $err_password = "Le champ ne peut pas être vide";
        } 
        

        if($valid){
            $req = $bdd->prepare("SELECT mdp FROM User WHERE pseudo = ?");
            $req->execute(array($pseudo));
            $req =  $req->fetch();

            if(isset($req['mdp'])){
                if(!password_verify($password, $req['mdp'])){
                    $valid = false;
                    $err_pseudo = "La combinaison est incorrecte";

            }else{
                $valid = false;
                $err_pseudo = "La combinaison est incorrecte";
            }
        }

        if($valid){
          $req = $bdd->prepare('SELECT * FROM User WHERE pseudo = ?');
          $req->execute(array($pseudo))

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
    <title>Connexion utilisateur</title>
</head>

<body>
    <h1> Connexion</h1>
    <form action="" method="post">

        <?php if(isset($err_pseudo)) {echo '<div>' . $err_pseudo . '<div>' ; }?>

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value=" <?php if(isset($pseudo)){ echo $pseudo;} ?>">

        <?php if(isset($err_password)) { echo '<div>' . $err_password . '<div>';} ?>
        <label for=""> Mot de passe </label>
        <input type="password" name="password" id="" value= "">

        <button type="submit" name="connexion">Connexion</button>
    </form>
</body>

</html>