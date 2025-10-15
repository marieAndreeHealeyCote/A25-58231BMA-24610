<?php
require_once('classes/CRUD.php');
$crud = new CRUD;
$insert = $crud->insert('livre', $_POST);
header("location:livre-show.php?id=$insert");
