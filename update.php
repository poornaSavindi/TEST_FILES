<?php
include __DIR__ . '/Includes/DataBaseConnection.php';
include __DIR__ . '/classes/DataBaseTable.php';
try {

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

  if (isset($_POST['joketext'])) {
    $jokesTable->save(['id' => $_POST['jokeid'],'joketext' => $_POST['joketext'],'date' => new DateTime(),'authorId' => 1]);

    header('location: jokes.php');
  } else {
    if (isset($_POST['id'])) {
      $joke = $jokesTable->findById($_POST['id']);
    }
    $title = 'Edit joke';
    ob_start();
    include __DIR__ . '/Templates/updatejoke.html.php';
    $output = ob_get_clean();
  }
} catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . 'in ' . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/Templates/layout.html.php';
