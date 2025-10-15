<?php
require_once 'Classe/Categorie.php';
$categorie = new Categorie();
$listeCategories = $categorie->getAll();

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();
$listeEditeurs = $editeurObj->getAll();

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();
$listeAuteurs = $auteurObj->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livre->titre = $_POST['titre'];
    $livre->auteur = $_POST['auteur'];
    $livre->annee_publication = $_POST['annee'];
    $livre->genre = $_POST['genre'];
    $livre->categorie_id = $_POST['categorie_id'];
    $livre->editeur_id = $_POST['editeur_id'];
    $livre->auteur_id = $_POST['auteur_id'];

    $livre->ajouter();

    header('Location: livre-index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Ajouter un nouveau livre</h2>
    <form method="POST">
        <label>Titre :</label>
        <input type="text" name="titre" value="" required>

        <label>Auteur :</label>
        <select name="auteur_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeAuteurs as $auteur): ?>
                <option value="<?= $auteur->id ?>">
                    <?= htmlspecialchars($auteur->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Année de publication :</label>
        <input type="number" name="annee" required value="">

        <label>Genre :</label>
        <input type="text" name="genre" required value="">

        <label>Catégorie :</label>
        <select name="categorie_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeCategories as $categorie): ?>
                <option value="<?= $categorie->id ?>">
                    <?= htmlspecialchars($categorie->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Éditeur :</label>
        <select name="editeur_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeEditeurs as $editeur): ?>
                <option value="<?= $editeur->id ?>">
                    <?= htmlspecialchars($editeur->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type=" submit">Ajouter</button>
        <a href="livre-index.php" class="cancel">Annuler</a>
    </form>
</body>

</html>

<body>
    <div class="container">
        <form action="client-store.php" method="post">
            <h2>New Client</h2>
            <label>Name
                <input type="text" name="name">
            </label>
            <label>Address
                <input type="text" name="address">
            </label>
            <label>Phone
                <input type="text" name="phone">
            </label>
            <label>Zip Code
                <input type="text" name="zip_code">
            </label>
            <label>Email
                <input type="email" name="email">
            </label>
            <input type="submit" class="btn" value="save">
        </form>
    </div>
</body>

</html>