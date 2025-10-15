<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (!isset($_GET['id']) || $_GET['id'] == null) {
//     header('location:livre-index.php');
//     exit;
// }
$id = $_GET['id'];

require_once 'Classe/Livre.php';
$livreObj = new Livre();
$livre = $livreObj->getById($id);

require_once 'Classe/Categorie.php';
$categorieObj = new Categorie();
$categorie = $categorieObj->getById($livre['categorie_id']);

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();
$editeur = $editeurObj->getById($livre['editeur_id']);

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();
$auteur = $auteurObj->getById($livre['auteur_id']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Livre créé</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Livre créé</h1>
    <a href="livre-index.php" class="btn bleu">Retour aux livres</a>

    <body>
        <form action="livre-delete.php" method="post">
            <p><strong>Titre: </strong><?= $livre['titre']; ?></p>
            <p><strong>Auteur: </strong><?= $auteur['nom']; ?></p>
            <p><strong>Année de publication: </strong><?= $livre['annee_publication']; ?></p>
            <p><strong>Genre: </strong><?= $livre['genre']; ?></p>
            <p><strong>Catégorie: </strong><?= $categorie['nom']; ?></p>
            <p><strong>Éditeur: </strong><?= $editeur['nom']; ?></p>
            <a href="livre-edit.php?id=<?= $id; ?>" class="btn bleu">Modifier</a>

            <input type="hidden" name="id" value="<?= $id; ?>">
            <button type="submit" class="btn rouge">Supprimer</button>
        </form>
    </body>
</body>

</html>