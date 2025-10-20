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
    require_once 'Classe/Livre.php';
    $livre = new Livre();
    $livre->ajouter($_POST);
    header('Location: livre-index.php');
    exit;
}
?>

<?php include('layouts/header.php'); ?>

<body>
    <h2>Ajouter un nouveau livre</h2>
    <form method="POST" action="livre-store.php">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" value="" required>
        </div>

        <div>
            <label for="auteur_id">Auteur :</label>
            <select name="auteur_id" id="auteur_id" required>
                <option value="" disabled selected>-- Sélectionner --</option>
                <?php foreach ($listeAuteurs as $auteur): ?>
                    <option value="<?= $auteur['id'] ?>">
                        <?= htmlspecialchars($auteur['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="annee_publication">Année de publication :</label>
            <input type="number" name="annee_publication" id="annee_publication" min="1900" max="2030" value="" required>
        </div>

        <div>
            <label for="genre">Genre :</label>
            <input type="text" name="genre" id="genre" required value="">
        </div>

        <div>
            <label for="categorie_id">Catégorie :</label>
            <select name="categorie_id" id="categorie_id" required>
                <option value="" disabled selected>-- Sélectionner --</option>
                <?php foreach ($listeCategories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>">
                        <?= htmlspecialchars($categorie['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="editeur_id">Éditeur :</label>
            <select name="editeur_id" id="editeur_id" required>
                <option value="" disabled selected>-- Sélectionner --</option>
                <?php foreach ($listeEditeurs as $editeur): ?>
                    <option value="<?= $editeur['id'] ?>">
                        <?= htmlspecialchars($editeur['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn vert">Ajouter</button>
        <a href="livre-index.php" class="btn bleu">Annuler</a>
    </form>
</body>

<?php include('layouts/footer.php'); ?>