<?php

require_once '../globals.php';
is_admin();

require_once (CONTROLLERS.'ArticlesController.php');
require_once (MODELS.'ArticlesModel.php');
require_once (MODELS.'ArticlesCatsModel.php');

$articlesModel= new ArticlesModel();
$catsModel= new ArticlesCatsModel();
$controller= new ArticlesController($articlesModel, $catsModel);
$controller->delete();