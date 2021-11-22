<?php
$pdo =new \PDO('mysql:hostname=localhost;dbname=ijokes','ijokesuser','mypassword');
$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
