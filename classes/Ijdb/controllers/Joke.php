<?php
namespace Ijdb\controllers;
use \Ninja\DataBaseTable;//because we dont mention the namespace for constructor parameters
use \Ninja\Authentication;

class Joke {
  private $authorsTable;
  private $jokesTable;
  private $authentication;

  public function __construct(DataBaseTable $jokesTable,DataBaseTable $authorsTable,Authentication $authentication) {
    $this->jokesTable = $jokesTable;
    $this->authorsTable = $authorsTable;
    $this->authentication = $authentication;
  }

  public function home() {
    $title = 'Internet Joke Database';
    return ['title' => $title,'template'=>'home.html.php'];
  }

  public function list() {
    $result = $this->jokesTable->findAll();
    $jokes = [];
    foreach ($result as $joke) {
      $author =$this->authorsTable->findById($joke['authorid']);
      $jokes[] = ['id' => $joke['id'],'joketext' => $joke['joketext'],'jokedate' => $joke['date'],'name' => $author['authorname'],
                  'email' => $author['authoremail'],'authorId' => $author['authorid']];
    }
    $title = 'Joke list';
    $totalJokes = $this->jokesTable->total();

    $user = $this->authentication->getUser();
    return ['title' => $title,'template'=>'jokes.html.php','variables'=>['jokes'=>$jokes,'totalJokes'=>$totalJokes,'userId'=>$user['authorid'] ?? null]];
  }

  public function delete() {//hiding a link is not secure, we need to stop accessing
    $author = $this->authentication->getUser();
    $joke = $this->jokesTable->findById($_POST['id']);
    if ($joke['authorId'] != $author['id']) {
      return;
    }

    $this->jokesTable->delete($_POST['id']);
    header('location: /joke/list');
  }

  public function saveEdit(){
    $user = $this->authentication->getUser();

    if (isset($_GET['id'])) {
      $joke = $this->jokesTable->findById($_GET['id']);
      if ($joke['authorId'] != $author['id']) {
        return;
      }
    }

    $joke = $_POST['joke'];
    $joke['date'] = new \DateTime();
    $joke['authorid'] = $user['authorid'];
    $this->jokesTable->save($joke);
    header('location: /joke/list');
  }

  public function edit() {

    $user = $this->authentication->getUser();

      if (isset($_GET['id'])) {
        $joke = $this->jokesTable->findById($_GET['id']);
      }

      if(isset($joke) && $joke['authorid'] != $user['authorid']){
        http_response_code(301);
        header('location:/joke/list');
      }
      $title = 'Edit joke';
      return ['title' => $title,'template'=>'edit.html.php','variables'=>['joke'=>$joke ?? null]];
  }
}
