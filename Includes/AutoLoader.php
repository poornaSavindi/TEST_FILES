<?php
function autoloader($classname){
  include __DIR__."/../classes/".str_replace('\\','/',$classname).".php";
}

spl_autoload_register("autoloader");
