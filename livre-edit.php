<?php
require_once 'Classe/Livre.php';
$livre = new Livre();

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
    $livreData = $livre->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livre->modifier($_POST);
}
?>

<link rel="stylesheet" href="css/style.css">

<h2>Modifier le livre</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $livreData['id'] ?>">

    <div>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?= $livreData['titre'] ?>" required>
    </div>

    <div>
        <label for="auteur_id">Auteur :</label>
        <select name="auteur_id" id="auteur_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeAuteurs as $auteur): ?>
                <option value="<?= $auteur['id'] ?>" <?= $livreData->auteur_id == $auteur['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($auteur->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="annee_publication">Année de publication :</label>
        <input type="number" name="annee_publication" id="annee_publication" min="1900" max="2030" value="<?= $livreData['annee_publication'] ?>" required>
    </div>

    <div>
        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" required value="<?= $livreData['genre'] ?>">
    </div>

    <div>
        <label for="categorie_id">Catégorie :</label>
        <select name="categorie_id" id="categorie_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeCategories as $categorie): ?>
                <option value="<?= $categorie['id'] ?>" <?= $livreData->categorie_id == $categorie['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categorie->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="editeur_id">Éditeur :</label>
        <select name="editeur_id" id="editeur_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($listeEditeurs as $editeur): ?>
                <option value="<?= $editeur['id'] ?>" <?= $livreData->editeur_id == $editeur['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($editeur->nom) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit">Mettre à jour</button>
    <a href="livre-index.php" class="cancel">Annuler</a>
</form>