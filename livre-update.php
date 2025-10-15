<?php
require_once 'Classe/Livre.php';
$livre = new Livre();
$livre->modifier($_POST);
