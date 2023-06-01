<?php
require_once 'libraries/models/Article.php';
require_once 'libraries/models/Comment.php';
require_once 'libraries/utils.php';

$modelComment = new Comment;

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
  die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];


$commentaire = $modelComment->find($id);

if ($query->rowCount() === 0) {
  die("Aucun commentaire n'a l'identifiant $id !");
}



$article_id = $commentaire['article_id'];
$modelComment->delete($id);


redirect("Location: article.php?id=" . $article_id);
exit();
