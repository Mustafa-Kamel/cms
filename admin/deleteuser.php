<?php

require_once '../globals.php';
is_admin();

require_once (CONTROLLERS.'UsersController.php');
require_once (MODELS.'UsersModel.php');


$usersModel= new UsersModel();
$usersController= new UsersController($usersModel);
$usersController-> deleteUser();