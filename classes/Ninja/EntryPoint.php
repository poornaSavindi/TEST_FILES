<?php
namespace Ninja;

class EntryPoint{
  private $route;
  private $ijdbroutes;
  private $method;

  public function __construct(string $route,string $method,\Ninja\Routes $ijdbroutes){
    $this->route = $route;
    $this->method = $method;
    $this->ijdbroutes = $ijdbroutes;
    $this->checkUrl();
  }

  private function checkUrl(){
    if ($this->route !== strtolower($this->route)) {
      http_response_code(301);
      header('location: /' . strtolower($this->route));
      }
  }

  private function loadTemplate($templateFileName, $variables = []){
    extract($variables);
    ob_start();
    include __DIR__ . '/../../Templates/' . $templateFileName;
    return ob_get_clean();
  }

  public function run(){
    $authentication = $this->ijdbroutes->getAuthentication();
    $routes = $this->ijdbroutes->getRoute();
    if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
      http_response_code(301);
      header('location: /login/error');
    }else {
      $controller = $routes[$this->route][$this->method]['controller'];
      $action = $routes[$this->route][$this->method]['action'];

      $page = $controller->$action();

      $title = $page['title'];
      if (isset($page['variables'])) {
        $output = $this->loadTemplate($page['template'],$page['variables']);
      } else {
        $output = $this->loadTemplate($page['template']);
      }

      echo $this->loadTemplate('layout.html.php', ['loggedIn'=>$authentication->isLoggedIn(),'output' => $output,'title' => $title]);

    }

  }
}
