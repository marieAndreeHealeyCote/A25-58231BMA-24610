<?php
require_once 'Classe/Livre.php';
$livre = new Livre();
$insert = $livre->ajouter($_POST);
header("location:livre-show.php?id=$insert");
