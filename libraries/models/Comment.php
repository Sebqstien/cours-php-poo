<?php

require_once('libraries/models/Model.php');



class Comment extends Model
{

  protected $table = 'comments';


  /**
   * Retourne tous les commentaires lies a l'article
   *
   * @param integer $article_id
   * @return array
   */
  public function findAllComments(int $article_id): array
  {
    $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
  }


  /**
   * Inserer un commentaire liée à un article
   *
   * @param string $author
   * @param string $content
   * @param int $article_id
   * @return void
   */
  public  function insert(string $author, string $content, int $article_id): void
  {
    $query = $this->pdo->prepare("INSERT INTO {$this->table} SET author = :author, content = :content, article_id = :article_id, created_at = NOW()");
    $query->execute(compact('author', 'content', 'article_id'));
  }
}
