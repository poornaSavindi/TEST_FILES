<?php
try {
  include __DIR__ . '/Includes/DatabaseConnection.php';
  include __DIR__ . '/classes/DatabaseTable.php';

  $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');

  $jokesTable->delete($_POST['id']);

  header("location:jokes.php");
} catch (Exception $e) {
  $output = "error".$e->getMessage();
  $title = "error occured";
  include __DIR__."/Templates/layout.html.php";
}
