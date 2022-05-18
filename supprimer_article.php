<?php
require_once('db.php');
if(isset($_GET['id']) && !empty($_GET['id'])) {

    $getid = $_GET['id'];
    $recupArticle = $bdd->prepare('SELECT *FROM Article WHERE id = ?');
    $recupArticle->execute(array($getid));
    if($recupArticle->rowCount() > 0) {
        $supprimerArticle = $bdd->prepare('DELETE FROM Article WHERE id = ?');
        $supprimerArticle->execute(array($getid));
        header('Location: articles.php');
    } else {
        echo "Aucun article trouvé";
    }

}else{
    echo "Aucun identifiant trouvé";
}
?>