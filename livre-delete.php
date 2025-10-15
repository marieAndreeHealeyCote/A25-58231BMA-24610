<?php
$id = $_POST['id'];
require_once 'Classe/Livre.php';
$livre = new Livre();
$livre->supprimer($id);
