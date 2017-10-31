<?php

require_once 'globals.php';
require_once (CONTROLLERS.'ArticlesController.php');


$articlesModel= new ArticlesModel();
$articlesCats= new ArticlesCatsModel();
$controller= new ArticlesController($articlesModel, $articlesCats);
$controller->showCat();