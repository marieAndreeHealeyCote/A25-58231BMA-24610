<?php
require_once 'Classe/Categorie.php';

$categorieObj = new Categorie();

// Ajouter ou modifier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    if (!empty($_POST['id'])) {
        // Modifier
        $categorieObj->update($_POST['id'], $nom);
    } else {
        // Ajouter
        $categorieObj->ajouter($nom);
    }
    header("Location: categorie.php");
    exit;
}

// Supprimer
if (isset($_GET['supprimer'])) {
    $categorieObj->supprimer($_GET['supprimer']);
    header("Location: categorie.php");
    exit;
}

// Récupération pour modification
$editCategorie = null;
if (isset($_GET['modifier'])) {
    $editCategorie = $categorieObj->getByIdFull($_GET['modifier']);
}

$listeCategories = $categorieObj->getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des catégories</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>📂 Gestion des catégories</h1>
    <a href="index.php" class="btn">⬅ Retour aux livres</a>

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
                        <a href="?modifier=<?= $cat->id ?>">✏️ Modifier</a> |
                        <a href="?supprimer=<?= $cat->id ?>" onclick="return confirm('Supprimer cette catégorie ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>