<?php
require_once 'Classe/Auteur.php';

$auteurObj = new Auteur();

// Traitement formulaire : ajouter ou modifier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);

    if (!empty($nom)) {
        if (!empty($_POST['id'])) {
            // Modifier un auteur existant
            $auteurObj->update($_POST['id'], $nom);
        } else {
            // Ajouter un nouvel auteur
            $auteurObj->ajouter($nom);
        }
    }
    header("Location: auteur.php");
    exit;
}

// Suppression
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $auteurObj->supprimer($id);
    header("Location: auteur.php");
    exit;
}

// Chargement de l'auteur à modifier
$editAuteur = null;
if (isset($_GET['modifier'])) {
    $editAuteur = $auteurObj->getByIdFull($_GET['modifier']);
}

$listeAuteurs = $auteurObj->getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des auteurs</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>✍️ Gestion des auteurs</h1>

    <a href="index.php" class="btn">⬅ Retour à la liste des livres</a>

    <h2><?= $editAuteur ? "Modifier un auteur" : "Ajouter un auteur" ?></h2>

    <form method="POST">
        <?php if ($editAuteur): ?>
            <input type="hidden" name="id" value="<?= $editAuteur->id ?>">
        <?php endif; ?>

        <label>Nom de l'auteur :</label>
        <input type="text" name="nom" required value="<?= $editAuteur ? htmlspecialchars($editAuteur->nom) : '' ?>">

        <button type="submit"><?= $editAuteur ? "Modifier" : "Ajouter" ?></button>
    </form>

    <h2>Liste des auteurs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listeAuteurs as $auteur): ?>
                <tr>
                    <td><?= $auteur->id ?></td>
                    <td><?= htmlspecialchars($auteur->nom) ?></td>
                    <td>
                        <a href="?modifier=<?= $auteur->id ?>">✏️ Modifier</a> |
                        <a href="?supprimer=<?= $auteur->id ?>" onclick="return confirm('Supprimer cet auteur ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>