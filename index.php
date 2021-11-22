<?php
    // this whole mechanism is called single entry point/front controller.
    // here the special fact of URL parameters hae been used. we have sent the action with the url and then call the relevant
    // function from the controller class.
    //every page is diverted through this page
    // the main reason that why we have used name 'action' here is a function in a controller is commonly called action.
  try {
    include __DIR__.'/Includes/AutoLoader.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $entryPoint = new \Ninja\EntryPoint($route,$_SERVER['REQUEST_METHOD'],new \Ijdb\IJDBRoutes());
    $entryPoint->run();

  } catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '. $e->getFile() . ':' . $e->getLine();

    include __DIR__ . '/Templates/layout.html.php';
  }
