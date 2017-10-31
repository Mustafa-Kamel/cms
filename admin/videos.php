<?php

require_once '../globals.php';

is_admin();

require_once (CONTROLLERS.'VideoController.php');
require_once (MODELS.'VideoModel.php');

$videoModel= new VideoModel();
$videoController= new VideoController($videoModel);
$videoController->showAll();