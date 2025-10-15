<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (!isset($_GET['id']) || $_GET['id'] == null) {
//     header('location:livre-index.php');
//     exit;
// }

require_once 'Classe/Livre.php';
$livre = new Livre();
$id = $_GET['id'];
$livreAffiche = $livre->getById($id);

require_once 'Classe/Categorie.php';
$categorie = new Categorie();
$listeCategories = $categorie->getById($livreAffiche['categorie_id']);

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();
$listeEditeurs = $editeurObj->getById($livreAffiche['editeur_id']);

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();
$listeAuteurs = $auteurObj->getById($livreAffiche['auteur_id']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des catégories</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Gestion des catégories</h1>
    <a href="livre-index.php" class="btn">Retour aux livres</a>

    <h2><?= $editCategorie ? "Modifier une catégorie" : "Ajouter une nouvelle catégorie" ?></h2>

    <form method="POST">
        <?php if ($editCategorie): ?>
            <input type="hidden" name="id" value="<?= $editCategorie->id ?>">
        <?php endif; ?>

        <label>Nom de la catégorie :</label>
        <input type="text" name="nom" required value="<?= $editCategorie ? htmlspecialchars($editCategorie->nom) : '' ?>">
        <button type="submit"><?= $editCategorie ? "Modifier" : "Ajouter" ?></button>
    </form>

    <h2>Liste des catégories</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listeCategories as $cat): ?>
                <tr>
                    <td><?= $cat->id ?></td>
                    <td><?= htmlspecialchars($cat->nom) ?></td>
                    <td>
                        <a href="?modifier=<?= $cat->id ?>">Modifier</a> |
                        <a href="?supprimer=<?= $cat->id ?>" onclick="return confirm('Supprimer cette catégorie ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>