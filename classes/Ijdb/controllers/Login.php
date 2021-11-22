<?php

namespace Ijdb\controllers;

class Login{

  private $authentication;

  public function __construct(\Ninja\Authentication $authentication){
    $this->authentication = $authentication;
  }


  public function error(){
    return ['template'=>'loginerror.html.php','title'=>'You are not logged in.'];
  }

  public function loginForm() {
    return ['template' => 'login.html.php','title' => 'Log In'];
  }

  public function success(){
    return ['template' => 'loginsuccess.html.php','title' => 'Successfully logged in.'];
  }

  public function processLogin(){
    if($this->authentication->login($_POST['email'],$_POST['password'])){
      header('location:/login/success');
    }else{
      return ['template' => 'login.html.php','title' => 'Log In','variables' => ['error' => 'Invalid username/password.']];
    }
  }

  public function logout() {
    session_destroy();
    return ['template' => 'logout.html.php','title' => 'You have been logged out'];
  }

  public function test(){
    return['template'=>'test.html.php','title'=>'tested','variables'=>['session'=>$_SESSION]];
  }
}
