<?php

require_once '../globals.php';
if (isset($_SESSION['username'])&&$_SESSION['admin']==1) {
    System::RedirectTo('index.php');
}

require_once (CONTROLLERS.'UsersController.php');
require_once (MODELS.'UsersModel.php');

$usersModel= new UsersModel();
$usersController= new UsersController($usersModel);
$usersController->login();
