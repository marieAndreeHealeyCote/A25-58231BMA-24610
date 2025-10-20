<?php
require_once 'Classe/Livre.php';
$livre = new Livre();
$listeLivres = $livre->getAll();

require_once 'Classe/Categorie.php';
$categorieObj = new Categorie();

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();

// Suppression
if (isset($_GET['supprimer'])) {
    $livre->supprimer($_GET['supprimer']);
    exit;
}
?>

<?php include('layouts/header.php'); ?>

<body>
    <h1>Librairie - Gestion de livres</h1>
    <a href="livre-create.php" class="btn bleu"> Ajouter un livre</a>

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
            <?php foreach ($listeLivres as $livre): ?>
                <tr>
                    <td><?= $livre['id'] ?></td>
                    <td><?= $livre['titre'] ?></td>
                    <td><?= $auteurObj->getById($livre['auteur_id'])['nom'] ?></td>
                    <td><?= $livre['annee_publication'] ?></td>
                    <td><?= $livre['genre'] ?></td>
                    <td>
                        <a class="btn vert" href="livre-edit.php?id=<?= $livre['id'] ?>">Modifier</a>
                        <a class="btn rouge" href="?supprimer=<?= $livre['id'] ?>" onclick="return confirm('Supprimer ce livre ?')">Supprimer</a>
                    </td>
                    <td><?= $categorieObj->getById($livre['categorie_id'])['nom'] ?></td>
                    <td><?= $editeurObj->getById($livre['editeur_id'])['nom'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include('layouts/footer.php'); ?>