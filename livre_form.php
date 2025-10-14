<?php
require_once 'Classe/Livre.php';
$livre = new Livre();
$modifier = false;

require_once 'Classe/Categorie.php';
$categorie = new Categorie();
$listeCategories = $categorie->getAll();

require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();
$listeEditeurs = $editeurObj->getAll();

require_once 'Classe/Auteur.php';
$auteurObj = new Auteur();
$listeAuteurs = $auteurObj->getAll();

if (isset($_GET['id'])) {
    $modifier = true;
    $livreData = $livre->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livre->titre = $_POST['titre'];
    $livre->auteur = $_POST['auteur'];
    $livre->annee_publication = $_POST['annee'];
    $livre->genre = $_POST['genre'];
    $livre->categorie_id = $_POST['categorie_id'];
    $livre->editeur_id = $_POST['editeur_id'];
    $livre->auteur_id = $_POST['auteur_id'];

    if (isset($_POST['id'])) {
        $livre->id = $_POST['id'];
        $livre->modifier();
    } else {
        $livre->ajouter();
    }
    header('Location: index.php');
    exit;
}
?>

<link rel="stylesheet" href="css/style.css">

<h2><?= $modifier ? "Modifier le livre" : "Ajouter un nouveau livre" ?></h2>
<form method="POST">
    <?php if ($modifier): ?>
        <input type="hidden" name="id" value="<?= $livreData->id ?>">
    <?php endif; ?>

    <label>Titre :</label>
    <input type="text" name="titre" required value="<?= $modifier ? $livreData->titre : '' ?>">

    <label>Auteur :</label>
    <select name="auteur_id" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($listeAuteurs as $a): ?>
            <option value="<?= $a->id ?>" <?= ($modifier && $livreData->auteur_id == $a->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($a->nom) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Année de publication :</label>
    <input type="number" name="annee" required value="<?= $modifier ? $livreData->annee_publication : '' ?>">

    <label>Genre :</label>
    <input type="text" name="genre" required value="<?= $modifier ? $livreData->genre : '' ?>">

    <label>Catégorie :</label>
    <select name="categorie_id" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($listeCategories as $cat): ?>
            <option value="<?= $cat->id ?>" <?= ($modifier && $livreData->categorie_id == $cat->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat->nom) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Éditeur :</label>
    <select name="editeur_id" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($listeEditeurs as $ed): ?>
            <option value="<?= $ed->id ?>" <?= ($modifier && $livreData->editeur_id == $ed->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($ed->nom) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit"><?= $modifier ? "Mettre à jour" : "Ajouter" ?></button>
    <a href="index.php" class="cancel">Annuler</a>
</form>