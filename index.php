<?php

require_once 'libraries/utils.php';
require_once 'libraries/models/Article.php';
require_once 'libraries/models/Comment.php';



$model = new Article;


$articles = $model->findAll("created_at DESC");

$pageTitle = "Accueil";

render('articles/index', compact('pageTitle', 'articles'));
