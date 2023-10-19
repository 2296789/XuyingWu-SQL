<?php
require_once('class/CRUD.php');

$crud = new CRUD;
$insert = $crud->insert('article', $_POST);

header("location:article-show.php?id=$insert");
?>