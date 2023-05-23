<?php

//render('articles/show');
function render(string $path, array $variables = [])
{
  extract($variables);
  ob_start();
  require('templates/' . $path . '.html.php');
  $pageContent = ob_get_clean();

  require('templates/layout.html.php');
}

/**
 * Redirection de page
 *
 * @param string $url
 * @return void
 */
function redirect(string $url): void
{
  header("Location: $url");
}
