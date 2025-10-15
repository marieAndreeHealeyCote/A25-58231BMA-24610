<?php
require_once('classes/CRUD.php');
$crud = new CRUD;
$update = $crud->update('livre', $_POST, 'livre-index');
