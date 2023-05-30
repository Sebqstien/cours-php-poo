<?php


/**
 * Retourne une connexion a la BDD
 *
 * @return PDO
 */
function getPdo(): PDO
{
  $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);

  return $pdo;
}

/**
 * Retourne la liste des articles par date de creation
 *
 * @return array
 */
function findAllArticles(): array
{
  $pdo = getPdo();
  $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
  // On fouille le résultat pour en extraire les données réelles
  $articles = $resultats->fetchAll();

  return $articles;
}


/**
 * Retourne un article selon son id
 *
 * @param integer $id
 * @return void
 */
function findArticle(int $id)
{
  $pdo = getPdo();
  $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

  // On exécute la requête en précisant le paramètre :article_id 
  $query->execute(['article_id' => $id]);

  // On fouille le résultat pour en extraire les données réelles de l'article
  $article = $query->fetch();

  return $article;
}

/**
 * Retourne tous les commentaires lies a l'article
 *
 * @param integer $article_id
 * @return array
 */
function findAllComments(int $article_id): array
{
  $pdo = getPdo();
  $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
  $query->execute(['article_id' => $article_id]);
  $commentaires = $query->fetchAll();

  return $commentaires;
}

/**
 * Supprime un article selon son ID 
 *
 * @param integer $id
 * @return void
 */
function deleteArticle(int $id): void
{
  $pdo = getPdo();
  $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
  $query->execute(['id' => $id]);
}


/**
 * Retourne un commentaire 
 *
 * @param integer $id
 * @return void
 */
function findComment(int $id)
{
  $pdo = getPdo();
  $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
  $query->execute(['id' => $id]);
  $commentaire = $query->fetch();

  return $commentaire;
}

/**
 * Supprimer un commentaire liée à un article
 *
 * @param integer $id
 * @return void
 */
function deleteComment(int $id): void
{
  $pdo = getPdo();

  $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
  $query->execute(['id' => $id]);
}


/**
 * Inserer un commentaire liée à un article
 *
 * @param string $author
 * @param string $content
 * @param int $article_id
 * @return void
 */
function insertComment(string $author, string $content, int $article_id): void
{
  $pdo = getPdo();
  $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
  $query->execute(compact('author', 'content', 'article_id'));

}