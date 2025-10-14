<?php
require_once 'Classe/Livre.php';
$livre = new Livre();

require_once 'Classe/Categorie.php';
$categorieObj = new Categorie();

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();

// Suppression
if (isset($_GET['supprimer'])) {
    $livre->supprimer($_GET['supprimer']);
    header('Location: index.php');
    exit;
}

$listeLivres = $livre->getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Librairie</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>📚 Gestion de la Librairie</h1>
    <a href="livre_form.php" class="btn">➕ Ajouter un livre</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Genre</th>
                <th>Actions</th>
                <th>Catégorie</th>
                <th>Éditeur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listeLivres as $l): ?>
                <tr>
                    <td><?= $l->id ?></td>
                    <td><?= $l->titre ?></td>
                    <td><?= $auteurObj->getById($l->auteur_id) ?></td>
                    <td><?= $l->annee_publication ?></td>
                    <td><?= $l->genre ?></td>
                    <td>
                        <a href="livre_form.php?id=<?= $l->id ?>">✏️ Modifier</a> |
                        <a href="?supprimer=<?= $l->id ?>" onclick="return confirm('Supprimer ce livre ?')">🗑️ Supprimer</a>
                    </td>
                    <td><?= $categorieObj->getById($l->categorie_id) ?></td>
                    <td><?= $editeurObj->getById($l->editeur_id) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>