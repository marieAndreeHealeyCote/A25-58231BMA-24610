<?php
require_once 'Classe/Editeur.php';
$editeurObj = new Editeur();

// POST (ajout ou modification)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    if (!empty($_POST['id'])) {
        $editeurObj->update($_POST['id'], $nom);
    } else {
        $editeurObj->ajouter($nom);
    }
    header("Location: editeur.php");
    exit;
}

// GET (suppression ou édition)
if (isset($_GET['supprimer'])) {
    $editeurObj->supprimer($_GET['supprimer']);
    header("Location: editeur.php");
    exit;
}

$editEditeur = null;
if (isset($_GET['modifier'])) {
    $editEditeur = $editeurObj->getByIdFull($_GET['modifier']);
}

$listeEditeurs = $editeurObj->getAll();
