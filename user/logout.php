<?php
ob_start();
require_once '../library/lib.php';
require_once '../classes/crud.php';
$lib=new Lib;
$crud=new Crud;
$crud->updateLogout($_SESSION['id']);

$lib->logout();
?>

