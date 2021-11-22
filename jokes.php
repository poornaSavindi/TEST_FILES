<?php
  try {
    include __DIR__."/Includes/DataBaseConnection.php";
    $jokes = $pdo->query("SELECT `id`,`joketext`,`date`,`authorname`,`authoremail` FROM `jokes` inner join `authors` on `jokes`.`authorid`= `authors`.`authorid`");
  } catch (Exception $e) {
    $output = "error".$e->getMessage();
  }

include "Templates/jokes.html.php";
