<?php
require_once 'libraries/models/Article.php';
require_once 'libraries/models/Comment.php';
require_once 'libraries/utils.php';



$model = new Article();

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
  die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];


$article = $model->find($id);


if (!$article) {
  die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}


$model->delete($id);

redirect("Location: index.php");
exit();
