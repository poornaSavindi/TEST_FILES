<?php
$pdo =new PDO('mysql:hostname=localhost;dbname=ijokes','ijokesuser','mypassword');
$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="" method="post">
      name:<input type="text" name="name" required>
      email:<input type="email" name="email" required>
      password:<input type="password" name="password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>


<?php
if ($_POST) {

  var_dump($_POST);
  $authorname = $_POST['name'];
  $authoremail = $_POST['email'];
  $password = $_POST['password'];

  echo md5($password);
  $pdo->exec('INSERT into `authors` SET
  `authorname`="Poorna",
  `authoremail`="poorna@gmail.com",
  `password`="poorna"');
}


$hash_01 =  password_hash("password",PASSWORD_DEFAULT);
$hash_02 =  password_hash("password",PASSWORD_DEFAULT);
echo password_verify('password',$hash_01).'<br>';
echo $hash_01.'<br>';
echo $hash_02.'<br>';

if ( $hash_01===$hash_02) {
  echo 'equal';
}else{
  echo 'not';
}
 ?>
