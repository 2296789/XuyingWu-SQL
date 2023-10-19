<?php
require_once('class/CRUD.php');

$crud = new CRUD;
$update = $crud->update('article', $_POST);
?>