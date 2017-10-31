<?php

require_once 'globals.php';
require_once (CONTROLLERS.'ArticlesController.php');


$articlesModel= new ArticlesModel();
$catsModel= new ArticlesCatsModel();
$controller= new ArticlesController($articlesModel, $catsModel);
$controller->show();