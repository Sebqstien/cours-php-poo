<?php

require_once 'libraries/utils.php';
require_once 'libraries/models/Article.php';
require_once 'libraries/models/Comment.php';


$article_id = null;

if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
  $article_id = $_GET['id'];
}


if (!$article_id) {
  die("Vous devez préciser un paramètre `id` dans l'URL !");
}

$modelArticle = new Article;

$modelComment = new Comment;

$article = $modelArticle->find($article_id);



$commentaires = $modelComment->findAllComments($article_id);


$pageTitle = $article['title'];


render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));
