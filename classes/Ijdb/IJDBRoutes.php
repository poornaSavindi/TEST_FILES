<?php

namespace Ijdb;

class IJDBRoutes implements \Ninja\Routes{

  private $authorsTable;
  private $jokesTable;
  private $authentication;

  public function __construct(){
    include __DIR__ . '/../../Includes/DataBaseConnection.php';
    $this->jokesTable = new \Ninja\DataBaseTable($pdo, 'jokes', 'id');
    $this->authorsTable = new \Ninja\DataBaseTable($pdo, 'authors', 'authorid');
    $this->authentication = new \Ninja\Authentication($this->authorsTable,'authoremail','password');
  }
  public function getRoute():array{

    $jokeController = new \Ijdb\controllers\Joke($this->jokesTable,$this->authorsTable,$this->authentication);
    $authorController = new \Ijdb\controllers\Register($this->authorsTable);
    $loginController = new \Ijdb\controllers\Login($this->authentication);

    $routes = ['joke/edit' => ['POST' => ['controller' => $jokeController,'action' => 'saveEdit'],
                               'GET' => ['controller' => $jokeController,'action' => 'edit'],
                               'login'=>true],
               'joke/delete' => ['POST' => ['controller' => $jokeController,'action' => 'delete'],
                                 'login'=>true],
               'joke/list' => ['GET' => ['controller' => $jokeController,'action' => 'list']],
               '' => ['GET' => ['controller' => $jokeController,'action' => 'home']],
               'author/register'=>['POST'=>['controller' => $authorController,'action' => 'registerUser'],
                                    'GET'=>['controller' => $authorController,'action' => 'displayForm']],
               'author/success'=>['GET'=>['controller' => $authorController,'action' => 'success']],
               'login'=>['GET'=>['controller'=>$loginController,'action'=>'loginform'],
                         'POST'=>['controller'=>$loginController,'action'=>'processLogin']],
               'login/success'=>['GET'=>['controller'=>$loginController,'action'=>'success'],'login'=>true],
               'login/error'=>['GET' => ['controller' => $loginController,'action' => 'error']],
               'logout'=>['GET'=>['controller' => $loginController,'action' => 'logout']],
               'test' => ['GET'=>['controller' => $loginController,'action' => 'test']]
             ];
    return $routes;
  }

  public function getAuthentication(): \Ninja\Authentication{
    return $this->authentication;
  }

}
