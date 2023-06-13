<?php

namespace Controllers;

require_once 'libraries/utils.php';



class Article extends Controller
{
  // protected $modelName = '\Models\Article';
  protected $modelName = \Models\Article::class; // '\Models\Article';


  public function index()
  {
    //montrer la liste des articles


    $articles = $this->model->findAll("created_at DESC");

    $pageTitle = "Accueil";

    render('articles/index', compact('pageTitle', 'articles'));
  }

  public function show()
  {
    //montre UN seul article

    $article_id = null;

    if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
      $article_id = $_GET['id'];
    }


    if (!$article_id) {
      die("Vous devez préciser un paramètre `id` dans l'URL !");
    }


    $modelComment = new \Models\Comment();

    $article = $this->model->find($article_id);



    $commentaires = $modelComment->findAllComments($article_id);


    $pageTitle = $article['title'];


    render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));
  }

  public function delete()
  {
    //Supprime un article


    if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
      die("Ho ?! Tu n'as pas précisé l'id de l'article !");
    }

    $id = $_GET['id'];


    $article = $this->model->find($id);


    if (!$article) {
      die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
    }


    $this->model->delete($id);

    redirect("Location: index.php");
    exit();
  }
}
